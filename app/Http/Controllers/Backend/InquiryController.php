<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = \App\Models\Inquiry::with('product')->latest()->paginate(15);
        return view('backend.inquiries.index', compact('inquiries'));
    }

    public function show($id)
    {
        $inquiry = \App\Models\Inquiry::with('product')->findOrFail($id);

        // Mark as responded if it's pending (we view it now)
        if ($inquiry->status == 'pending') {
            $inquiry->update(['status' => 'responded']);
        }

        return view('backend.inquiries.show', compact('inquiry'));
    }

    public function destroy($id)
    {
        $inquiry = \App\Models\Inquiry::findOrFail($id);
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }

    public function contactIndex()
    {
        $messages = \App\Models\ContactMessage::latest()->paginate(15);
        return view('backend.contact_messages.index', compact('messages'));
    }

    public function contactShow($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);

        if ($message->status == 'pending') {
            $message->update(['status' => 'read']);
        }

        return view('backend.contact_messages.show', compact('message'));
    }

    public function contactDestroy($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.inquiries.contact.index')->with('success', 'Message deleted successfully.');
    }
}
