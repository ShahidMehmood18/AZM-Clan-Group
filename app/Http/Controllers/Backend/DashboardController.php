<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalBrands = Brand::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();

        $totalContactMessages = \App\Models\ContactMessage::count();
        $newContactMessages = \App\Models\ContactMessage::where('status', 'pending')->count();
        $totalInquiries = \App\Models\Inquiry::count();
        $newInquiries = \App\Models\Inquiry::where('status', 'pending')->count();

        return view('dashboard', compact(
            'totalCategories',
            'totalBrands',
            'totalProducts',
            'totalUsers',
            'totalContactMessages',
            'newContactMessages',
            'totalInquiries',
            'newInquiries'
        ));
    }
}
