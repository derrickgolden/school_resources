<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->decimal('amount', 10, 2);
            $table->string('checkout_request_id')->nullable();
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('transaction_status')->default('Pending'); // e.g., Pending, Success, Failed
            $table->text('response_description')->nullable();
            $table->timestamp('payment_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
