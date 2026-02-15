<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->name);
        $count = Brand::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('backend.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('backend.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->name);
        if ($slug !== $brand->slug) {
            $count = Brand::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $brand->id)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
        } else {
            $slug = $brand->slug;
        }

        $imagePath = $brand->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        $brand->update([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->image && Storage::disk('public')->exists($brand->image)) {
            Storage::disk('public')->delete($brand->image);
        }
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
