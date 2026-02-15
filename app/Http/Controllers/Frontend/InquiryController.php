<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        \App\Models\Inquiry::create($request->all());

        return back()->with('success', 'Your inquiry has been submitted successfully. We will contact you soon.');
    }
}
