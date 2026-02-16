<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductImportController extends Controller
{
    public function index()
    {
        return view('backend.products.import');
    }

    public function template()
    {
        $filename = "product-import-template.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = [
            'name',
            'category',
            'brand',
            'price',
            'short_description',
            'description',
            'thumbnail',
            'images',
            'is_active'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Sample data
            fputcsv($file, [
                'Sample Product',
                'Electronics',
                'Sony',
                '199.99',
                'Analysis of product features...',
                'Full details about the product...',
                'product-thumb.jpg',
                'img1.jpg,img2.jpg',
                '1'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,zip|max:20480', // Max 20MB
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $extractionPath = null;
        $csvPath = null;

        try {
            if ($extension === 'zip') {
                $zip = new \ZipArchive;
                if ($zip->open($file->getPathname()) === TRUE) {
                    $extractionPath = storage_path('app/temp/import/' . uniqid());
                    if (!File::exists($extractionPath)) {
                        File::makeDirectory($extractionPath, 0755, true);
                    }
                    $zip->extractTo($extractionPath);
                    $zip->close();

                    // Find CSV in the extracted folder
                    $csvFiles = glob($extractionPath . '/*.csv');
                    if (empty($csvFiles)) {
                        throw new \Exception("No CSV file found in the root of the ZIP archive.");
                    }
                    $csvPath = $csvFiles[0];

                    // Process and move images
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
                    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($extractionPath));

                    if (!file_exists(storage_path('app/public/uploads/products'))) {
                        mkdir(storage_path('app/public/uploads/products'), 0755, true);
                    }

                    foreach ($iterator as $fileInfo) {
                        if ($fileInfo->isFile()) {
                            $ext = strtolower($fileInfo->getExtension());
                            if (in_array($ext, $imageExtensions)) {
                                // Keep original filename as specified in CSV
                                $filename = $fileInfo->getFilename();
                                copy($fileInfo->getPathname(), storage_path('app/public/uploads/products/' . $filename));
                            }
                        }
                    }
                } else {
                    throw new \Exception("Failed to open ZIP file.");
                }
            } else {
                $csvPath = $file->getPathname();
            }

            DB::beginTransaction();

            $handle = fopen($csvPath, 'r');
            // Skip header row
            fgetcsv($handle);

            $imported = 0;
            $skipped = 0;

            while (($row = fgetcsv($handle)) !== false) {
                // Ensure row has enough columns
                if (count($row) < 3) {
                    continue;
                }

                $name = $row[0] ?? null;
                $categoryName = $row[1] ?? 'Uncategorized';
                $brandName = $row[2] ?? null;
                $price = $row[3] ?? 0;
                $shortDesc = $row[4] ?? null;
                $description = $row[5] ?? null;
                $thumbnail = $row[6] ?? null;
                $imagesString = $row[7] ?? null;
                $isActive = $row[8] ?? 1;

                // Mandatory Check
                if (empty($name)) { // We allow empty thumbnail/desc if user really wants, but recommended otherwise. User asked for mandatory.
                    // Strict mandatory check as requested
                }
                if (empty($name) || empty($thumbnail) || empty($description)) {
                    $skipped++;
                    continue;
                }

                // Prefix thumbnail with products/ if it's just a filename (and not a URL)
                if ($thumbnail && !Str::startsWith($thumbnail, ['http://', 'https://'])) {
                    $thumbnail = 'uploads/products/' . $thumbnail;
                }

                // Handle Category
                $category = Category::firstOrCreate(
                    ['name' => $categoryName],
                    ['slug' => Str::slug($categoryName), 'is_active' => true]
                );

                // Handle Brand
                $brandId = null;
                if (!empty($brandName)) {
                    $brand = Brand::firstOrCreate(
                        ['name' => $brandName],
                        ['slug' => Str::slug($brandName), 'is_active' => true]
                    );
                    $brandId = $brand->id;
                }

                // Generate Unique Slug
                $slug = Str::slug($name);
                $originalSlug = $slug;
                $count = 1;
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }

                // Parse Images
                $images = [];
                if (!empty($imagesString)) {
                    $rawImages = array_map('trim', explode(',', $imagesString));
                    foreach ($rawImages as $img) {
                        if (!Str::startsWith($img, ['http://', 'https://'])) {
                            $images[] = 'uploads/products/' . $img;
                        } else {
                            $images[] = $img;
                        }
                    }
                }

                // Create Product
                Product::create([
                    'name' => $name,
                    'slug' => $slug,
                    'category_id' => $category->id,
                    'brand_id' => $brandId,
                    'price' => is_numeric($price) ? $price : 0,
                    'short_description' => $shortDesc,
                    'description' => $description,
                    'thumbnail' => $thumbnail,
                    'images' => $images,
                    'is_active' => (bool) $isActive,
                ]);

                $imported++;
            }

            fclose($handle);
            DB::commit();

            // Clean up extraction
            if ($extractionPath) {
                File::deleteDirectory($extractionPath);
            }

            return redirect()->back()->with('success', "Imported $imported products successfully. Skipped $skipped rows due to missing mandatory fields.");

        } catch (\Exception $e) {
            DB::rollBack();
            if ($extractionPath) {
                File::deleteDirectory($extractionPath);
            }
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
