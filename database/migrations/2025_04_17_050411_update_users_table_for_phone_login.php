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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('name'); // no unique here yet
            $table->decimal('balance', 10, 2)->default(0.00)->after('phone');
        });

        // After adding the column, we can safely make it unique later
        DB::statement("UPDATE users SET phone = CONCAT('07', FLOOR(100000000 + RAND() * 899999999)) WHERE phone IS NULL OR phone = ''");
        
        Schema::table('users', function (Blueprint $table) {
            $table->unique('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('balance');
            $table->string('email')->unique()->after('name');
        });
    }
};
