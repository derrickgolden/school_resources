<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Martial;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalMartials = Martial::count();

        // Assuming you use a pivot table called martial_user with 'price' column
        $totalRevenue = DB::table('martial_user')
        ->join('martials', 'martial_user.martial_id', '=', 'martials.id')
        ->sum('martials.price');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCategories',
            'totalMartials',
            'totalRevenue'
        ));
    }
}
