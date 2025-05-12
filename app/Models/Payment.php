<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'amount',
        'checkout_request_id',
        'mpesa_receipt_number',
        'transaction_status',
        'response_description',
        'payment_time',
    ];

    protected $casts = [
        'payment_time' => 'datetime',
    ];
}
