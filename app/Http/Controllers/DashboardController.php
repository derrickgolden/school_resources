<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('dashboard', compact('categories'));
    }
}
