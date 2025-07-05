<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();
        $concert = \App\Models\Concert::inRandomOrder()->first();
        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $jumlah = rand(1, 3);
                $total_price = rand(100000, 300000) * $jumlah;
                Transaction::create([
                    'user_id' => $user->id,
                    'concert_id' => $concert ? $concert->id : 1,
                    'jumlah' => $jumlah,
                    'total_price' => $total_price,
                    'status' => 'pending',
                ]);
            }
        }
    }
}
