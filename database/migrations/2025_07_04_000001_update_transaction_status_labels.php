<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update status values in transactions table
        DB::table('transactions')->where('status', 'paid')->update(['status' => 'sudah bayar']);
        DB::table('transactions')->where('status', 'cancelled')->update(['status' => 'dibatalkan']);
    }

    public function down(): void
    {
        // Revert status values to original
        DB::table('transactions')->where('status', 'sudah bayar')->update(['status' => 'paid']);
        DB::table('transactions')->where('status', 'dibatalkan')->update(['status' => 'cancelled']);
    }
};
