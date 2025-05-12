<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function stkPush(Request $request)
    {
        $phone = ltrim($request->input('phone'), '+'); // remove leading + if any
        $amount = $request->input('amount');
        dd($request->all());

        $timestamp = now()->format('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $timestamp);

        $accessToken = $this->getAccessToken();

        $response = Http::withOptions(['verify' => false])
        ->withToken($accessToken)->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
            "BusinessShortCode" => env('MPESA_SHORTCODE'),
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline", // Or "CustomerBuyGoodsOnline" for Till
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => env('MPESA_SHORTCODE'),
            "PhoneNumber" => $phone,
            "CallBackURL" => env('MPESA_CALLBACK_URL'),
            "AccountReference" => "Purchase",
            "TransactionDesc" => "Payment for purchase"
        ]);

        return response()->json($response->json());
    }

    private function getAccessToken()
    {
        $response = Http::withOptions(['verify' => false])
    ->withBasicAuth(env('MPESA_CONSUMER_KEY'), env('MPESA_CONSUMER_SECRET'))
    ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        // $response = Http::withBasicAuth(env('MPESA_CONSUMER_KEY'), env('MPESA_CONSUMER_SECRET'))
        //     ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        return $response['access_token'];
    }

    public function stkCallback(Request $request)
    {
        // Save results or update user balance here
        \Log::info($request->all());
    }
}
