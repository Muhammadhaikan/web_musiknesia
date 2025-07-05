<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@musikid.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
            'is_admin' => 1,
            'nik' => '1234567890123456',
            'no_tlp' => '081234567890',
            'email_verified_at' => now(),
        ]);
    }
}
