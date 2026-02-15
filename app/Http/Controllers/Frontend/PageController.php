<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'business_type' => 'required|string|in:Brand,Reseller',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create(array_merge($request->all(), ['type' => 'contact']));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function partner()
    {
        return view('frontend.partner');
    }

    public function partnerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'business_type' => 'required|string|in:Brand,Reseller',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create(array_merge($request->all(), ['type' => 'partner']));

        return redirect()->back()->with('success', 'Your partnership inquiry has been sent successfully!');
    }

    public function paymentMethods()
    {
        return view('frontend.pages.payment-methods');
    }

    public function moneyBack()
    {
        return view('frontend.pages.money-back');
    }

    public function returns()
    {
        return view('frontend.pages.returns');
    }

    public function shipping()
    {
        return view('frontend.pages.shipping');
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }
}
