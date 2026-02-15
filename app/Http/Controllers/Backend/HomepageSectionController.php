<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use App\Models\HomepageCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageSectionController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::with('cards')->orderBy('order_num')->get();
        return view('backend.homepage.sections.index', compact('sections'));
    }

    public function edit(HomepageSection $homepageSection)
    {
        $homepageSection->load('cards');
        return view('backend.homepage.sections.edit', ['section' => $homepageSection]);
    }

    public function update(Request $request, HomepageSection $homepageSection)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $homepageSection->update([
            'heading' => $request->heading,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.homepage-sections.index')->with('success', 'Section updated successfully.');
    }

    public function storeCard(Request $request, HomepageSection $homepageSection)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('homepage/cards', 'public');
        }

        $homepageSection->cards()->create([
            'heading' => $request->heading,
            'description' => $request->description,
            'image' => $imagePath,
            'order_num' => $homepageSection->cards()->count() + 1,
        ]);

        return redirect()->back()->with('success', 'Card added successfully.');
    }

    public function updateCard(Request $request, HomepageCard $card)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'heading' => $request->heading,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($card->image && Storage::disk('public')->exists($card->image)) {
                Storage::disk('public')->delete($card->image);
            }
            $data['image'] = $request->file('image')->store('homepage/cards', 'public');
        }

        $card->update($data);

        return redirect()->back()->with('success', 'Card updated successfully.');
    }

    public function destroyCard(HomepageCard $card)
    {
        if ($card->image && Storage::disk('public')->exists($card->image)) {
            Storage::disk('public')->delete($card->image);
        }
        $card->delete();

        return redirect()->back()->with('success', 'Card deleted successfully.');
    }
}
