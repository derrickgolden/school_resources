<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Martial;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function add(Martial $martial)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$martial->id])) {
            $cart[$martial->id] = [
                'title' => $martial->title,
                'price' => $martial->price,
            ];
            session()->put('cart', $cart);
        }

        session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Martial added to cart!');
    }

    public function checkout()
    {
        // Get the cart from the session
        $cart = session()->get('cart', []);
        
        // Calculate the total price of the cart
        $total = array_sum(array_column($cart, 'price'));
        
        // Get the authenticated user's balance
        $userBalance = auth()->user()->balance;
        $phone = auth()->user()->phone;

        // Check if the user has enough balance
        if ($userBalance < $total) {
            // Redirect to the payment page if the balance is not enough
            session()->put('total', $total);
            session()->put('userBalance', $userBalance);  
            session()->put('phone', $phone);  
            return redirect()->route('payment.page');
        }

        foreach ($cart as $id => $item) {
            auth()->user()->paidMartials()->syncWithoutDetaching([$id]);
        }  
        
        // Subtract balance
        auth()->user()->balance -= $total;
        auth()->user()->save();

        // Clear cart
        session()->forget('cart');

        // Proceed with checkout if the balance is enough
        return view('checkout', compact('cart', 'total'));
    }

    public function download($id)
    {
        $martial = Martial::findOrFail($id);
        $path = public_path('storage/' . $martial->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }
        $filename = $martial->title . '.pdf';

        return response()->download($path, $filename);
    }

}

