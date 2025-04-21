<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Martial;

class MartialsController extends Controller
{
    public function index($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $martials = Martial::with('grade')
            ->where('category_id', $categoryId)
            ->orderByDesc('created_at')
            ->get();
        $paidMartialIds = auth()->check()
            ? auth()->user()->paidMartials->pluck('id')->toArray()
            : [];
        return view('public.martials.index', compact('category', 'martials', 'paidMartialIds'));
    }

    public function show($martialId)
    {
        $martial = Martial::findOrFail($martialId);
        return view('public.martials.show', compact('martial'));
    }
}
