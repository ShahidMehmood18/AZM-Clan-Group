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
            'images',
            'brand',
            'name',
            'price1',
            'price',
            'description',
            'category',
            'short_description',
            'is_active'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Sample data
            fputcsv($file, [
                'https://example.com/img1.jpg;https://example.com/img2.jpg',
                'Sony',
                'Sample Product',
                '249.99',
                '199.99',
                'Full details about the product...',
                'Electronics',
                'Short product summary',
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

            // Read header row and build column index map
            $headerRow = fgetcsv($handle);
            if ($headerRow === false) {
                throw new \Exception("CSV file is empty or unreadable.");
            }

            $headerMap = [];
            foreach ($headerRow as $index => $header) {
                $header = strtolower(trim($header));
                // Strip UTF-8 BOM from first column
                if ($index === 0) {
                    $header = preg_replace('/^\x{FEFF}/u', '', $header);
                }
                $headerMap[$header] = $index;
            }

            // Validate that 'name' column exists
            if (!isset($headerMap['name'])) {
                throw new \Exception("CSV must contain a 'name' column header. Found columns: " . implode(', ', array_keys($headerMap)));
            }

            // Helper to get column value by header name
            $getCol = function (array $row, string $columnName, $default = null) use ($headerMap) {
                if (!isset($headerMap[$columnName])) {
                    return $default;
                }
                $value = $row[$headerMap[$columnName]] ?? $default;
                return ($value === '' || $value === null) ? $default : trim($value);
            };

            // Preload existing slugs for fast uniqueness checking
            $existingSlugs = Product::pluck('slug')->flip()->toArray();

            $imported = 0;
            $skipped = 0;

            while (($row = fgetcsv($handle)) !== false) {
                // Skip empty rows
                if (count($row) < 2 || (count($row) === 1 && empty(trim($row[0])))) {
                    continue;
                }

                $name = $getCol($row, 'name');
                $categoryName = $getCol($row, 'category', 'Uncategorized');
                $brandName = $getCol($row, 'brand');
                $price = $getCol($row, 'price');
                $price1 = $getCol($row, 'price1');
                $shortDesc = $getCol($row, 'short_description');
                $description = $getCol($row, 'description');
                $thumbnail = $getCol($row, 'thumbnail');
                $imagesString = $getCol($row, 'images');
                $isActive = $getCol($row, 'is_active', 1);

                // Strip commas from prices (e.g. "1,319.00" -> "1319.00")
                if ($price) {
                    $price = str_replace(',', '', $price);
                }
                if ($price1) {
                    $price1 = str_replace(',', '', $price1);
                }

                // Fallback: use price1 if price is empty
                if ((empty($price) || !is_numeric($price)) && !empty($price1) && is_numeric($price1)) {
                    $price = $price1;
                }

                // Only name is mandatory
                if (empty($name)) {
                    $skipped++;
                    continue;
                }

                // Parse images - support both semicolon and comma separators
                $images = [];
                if (!empty($imagesString)) {
                    $separator = (str_contains($imagesString, ';')) ? ';' : ',';
                    $rawImages = array_filter(array_map('trim', explode($separator, $imagesString)));

                    foreach ($rawImages as $img) {
                        if (!empty($img)) {
                            if (!Str::startsWith($img, ['http://', 'https://'])) {
                                $images[] = 'uploads/products/' . $img;
                            } else {
                                $images[] = $img;
                            }
                        }
                    }
                }

                // If no explicit thumbnail column, use first image as thumbnail
                if (empty($thumbnail) && !empty($images)) {
                    $thumbnail = array_shift($images);
                } elseif (!empty($thumbnail) && !Str::startsWith($thumbnail, ['http://', 'https://'])) {
                    $thumbnail = 'uploads/products/' . $thumbnail;
                }

                // Handle Category
                $categorySlug = Str::slug($categoryName);
                if (empty($categorySlug)) {
                    $categorySlug = 'category-' . uniqid();
                }
                $category = Category::firstOrCreate(
                    ['name' => $categoryName],
                    ['slug' => $categorySlug, 'is_active' => true]
                );

                // Handle Brand
                $brandId = null;
                if (!empty($brandName)) {
                    $brandSlug = Str::slug($brandName);
                    if (empty($brandSlug)) {
                        $brandSlug = 'brand-' . uniqid();
                    }
                    $brand = Brand::firstOrCreate(
                        ['name' => $brandName],
                        ['slug' => $brandSlug, 'is_active' => true]
                    );
                    $brandId = $brand->id;
                }

                // Generate unique slug using in-memory lookup
                $slug = Str::slug($name);
                if (empty($slug)) {
                    $slug = 'product-' . uniqid();
                }
                $originalSlug = $slug;
                $count = 1;
                while (isset($existingSlugs[$slug])) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $existingSlugs[$slug] = true;

                // Create Product
                Product::create([
                    'name' => $name,
                    'slug' => $slug,
                    'category_id' => $category->id,
                    'brand_id' => $brandId,
                    'price' => is_numeric($price) ? $price : null,
                    'short_description' => $shortDesc,
                    'description' => $description,
                    'thumbnail' => $thumbnail,
                    'images' => $images,
                    'is_active' => ($isActive === null) ? true : (bool) (int) $isActive,
                ]);

                $imported++;
            }

            fclose($handle);
            DB::commit();

            // Clean up extraction
            if ($extractionPath) {
                File::deleteDirectory($extractionPath);
            }

            return redirect()->back()->with('success', "Imported $imported products successfully. Skipped $skipped rows.");

        } catch (\Exception $e) {
            DB::rollBack();
            if ($extractionPath) {
                File::deleteDirectory($extractionPath);
            }
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
