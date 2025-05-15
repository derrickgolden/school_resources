<?php

// app/Http/Controllers/MartialsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Grade;
use App\Models\Martial;
use Illuminate\Http\Request;

class MartialsController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $martials = Martial::with('grade')
        ->where('category_id', $id)
        ->orderByDesc('created_at')
        ->get();

        return view('admin.martials.index', compact('category', 'martials'));
    }

    public function create($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $grades = Grade::all();
        return view('admin.martials.create', compact('category', 'grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:20480',
            'category_id' => 'required|exists:categories,id',
            'grade_id' => 'required|exists:grades,id',
            'term_no' => 'required',
            'price' => 'required|numeric|min:0',
        ]);
        
        $filePath = $request->file('file')->store('martials', 'public');
        
        Martial::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'category_id' => $request->category_id,
            'grade_id' => $request->grade_id,
            'term_no' => $request->term_no,
            'price' => $request->price,
        ]);

        return redirect()->route('martials.index', $request->category_id)->with('success', 'Martial uploaded successfully.');
    }

    public function destroy(Martial $martial)
    {
        // Delete the file from storage
    if ($martial->file_path && Storage::disk('public')->exists($martial->file_path)) {
        Storage::disk('public')->delete($martial->file_path);
    }

        $martial->delete();
        return back()->with('success', 'Material deleted.');
    }
}
