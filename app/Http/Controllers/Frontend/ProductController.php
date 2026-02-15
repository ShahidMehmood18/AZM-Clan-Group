<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // Filter by Category
        if ($request->has('category') && $request->category != '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search Keyword
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by Brand
        if ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->first();
            if ($brand) {
                $query->where('brand_id', $brand->id);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        if ($sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $brands = Brand::where('is_active', true)->withCount('products')->get();

        $viewMode = $request->get('view', 'grid');

        return view('frontend.products.index', compact('products', 'categories', 'brands', 'viewMode'));
    }

    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = Product::where('is_active', true)->where('category_id', $category->id);

        // Search Keyword
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by Brand
        if ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->first();
            if ($brand) {
                $query->where('brand_id', $brand->id);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        if ($sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $brands = Brand::where('is_active', true)->withCount('products')->get();

        $viewMode = $request->get('view', 'grid');

        return view('frontend.products.index', compact('products', 'categories', 'brands', 'category', 'viewMode'));
    }

    public function brand($slug, Request $request)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $query = Product::where('is_active', true)->where('brand_id', $brand->id);

        // Search Keyword
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by Category
        if ($request->has('category') && $request->category != '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        if ($sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $brands = Brand::where('is_active', true)->withCount('products')->get();

        $viewMode = $request->get('view', 'grid');

        return view('frontend.products.index', compact('products', 'categories', 'brands', 'brand', 'viewMode'));
    }

    public function quickView($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return view('frontend.products.partials.quickview', compact('product'))->render();
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->with(['category', 'brand'])->firstOrFail();

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('is_active', true)
            ->where(function ($query) use ($product) {
                $query->where('category_id', $product->category_id);
                if ($product->brand_id) {
                    $query->orWhere('brand_id', $product->brand_id);
                }
            })
            ->take(8)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
}
