<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentstatusController extends Controller
{
    //
    public function check(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'total' => 'required|numeric'
        ]);
        
        $phone = $request->query('phone');
        $total = $request->query('total');
                
        if (!$phone) {
            return response()->json(['paid' => false]);
        }
        
        $user = DB::table('users')
        ->where('phone', $phone)
        ->where('balance', '>=', $total)
        ->first();
        
        Log::info('Payment status check', (array) $user);
        if ($user) {
            return response()->json([
                'paid' => true,
            ]);
        }
        
        
        return response()->json(['paid' => false]);
    }
}

