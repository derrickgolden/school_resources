<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('martials', function (Blueprint $table) {
        $table->decimal('price', 8, 2)->default(0); // Example: 999,999.99
    });
}

public function down(): void
{
    Schema::table('martials', function (Blueprint $table) {
        $table->dropColumn('price');
    });
}

};
