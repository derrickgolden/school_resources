<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class PayheroPaymentController extends Controller
{
    //
    private $apiUsername;
    private $apiPassword;
    private $baseUrl = 'https://backend.payhero.co.ke/api/v2/payments';
    
    public function __construct(){
        $this->apiUsername = env('API_USERNAME');
        $this->apiPassword = env('API_PASSWORD');
    }

    private function getBasicAuthToken()
    {
        $credentials = $this->apiUsername . ':' . $this->apiPassword;
        return 'Basic ' . base64_encode($credentials);
    }

    public function stkPush(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        try {
            $response =  Http::withOptions([
                'verify' => true, // <- ignore SSL verification
            ])->withHeaders([
                'Authorization' => $this->getBasicAuthToken(),
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl, [
                'amount' => floatval($request->input('amount')),
                'phone_number' => $request->phone,
                'channel_id' => env('CHANNEL_ID'),
                'provider' => 'm-pesa',
                'external_reference' => 'INV-' . now()->timestamp,
                'callback_url' => 'https://easytech.africa/api/stk/callback',
            ]);

            if ($response->successful()) {
                session(['session-details' => $request->phone]);
                Log::info("stk msg" . $response);

                Payment::create([
                    'phone' => $request->phone,
                    'amount' => $request->amount,
                    'checkout_request_id' => $response['CheckoutRequestID'],
                    'transaction_status' => 'Pending',
                ]);

                return redirect()->back()->with('success', 'USSD sent to your mobile phone. Enter PIN to continue.');
            } else {
                Log::error('STK Push error: ' . $response);
                return redirect()->back()->with('error', 'Failed to initiate STK push.');
            }
        } catch (\Exception $e) {
            Log::error('STK Push error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Server Error: ' . $e->getMessage());
        }
    }

    public function stkCallback(Request $request)
    {
        Log::info('Callback Resuest: ', $request->all());
        $status = $request->input('status');
        $response = $request->input('response');

        if ($status && ($response['ResultCode'] ?? 1) == 0) {
            $amount = $response['Amount'] ?? null;
            $phone = $response['Phone'] ?? null;

            if ($amount && $phone) {
                // Update user's balance
                $user = \DB::table('users')->where('phone', $phone)->first();

                if ($user) {
                    // Assuming your 'balance' column is numeric (e.g., decimal(10,2))
                    \DB::table('users')
                        ->where('id', $user->id)
                        ->update([
                            'balance' => $user->balance + $amount,
                            'updated_at' => now(),
                    ]);

                    $checkoutId = $response['CheckoutRequestID'];

                    Payment::where('checkout_request_id', $checkoutId)->update([
                        'transaction_status' => 'Success',
                        'mpesa_receipt_number' => $response['MpesaReceiptNumber'],
                        'payment_time' => now(),
                    ]);

                }
                return response()->json(['success' => true]);
            }
        }else{
            Payment::where('checkout_request_id', $checkoutId)->update([
                'transaction_status' => 'Failed',
                'mpesa_receipt_number' => $response['MpesaReceiptNumber'],
                'payment_time' => now(),
            ]);
        }

        // Log failed or incomplete transactions
        Log::info('Failed STK callback: ', $request->all());

        return response()->json(['success' => false]);
    }

}
