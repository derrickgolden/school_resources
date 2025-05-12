<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('payment');
    }

    public function checkPaymentStatus(Request $request)
    {
        // Get the currently authenticated user
        $user = auth()->user(); // Or get based on phone if needed

        // Check if balance has been updated after STK callback
        if ($user && $user->balance >= session('total')) {
            return response()->json([
                'success' => true,
                'message' => 'Payment confirmed.',
            ]);
        }

        // If balance is still 0 or payment hasn't been processed, return false
        return response()->json([
            'success' => false,
            'message' => 'Payment still processing.',
        ]);
    }

}
