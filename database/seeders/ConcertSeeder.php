<?php

namespace Database\Seeders;

use App\Models\Concert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Concert::factory()->create([
            'nama_band' => 'NDX',
            'lokasi' => 'GRAND CITY MALL, SURABAYA',
            'tanggal' => '2025-02-02',
            'poster' => 'ndx.jpg',
            'harga' => 150000,
            'stok_tiket' => 500,
        ]);

        Concert::factory()->create([
            'nama_band' => 'Kahitna',
            'lokasi' => 'Sumarecon Mall Bandung, BANDUNG',
            'tanggal' => '2025-05-02',
            'poster' => 'kahitna.jpg',
            'harga' => 150000,
            'stok_tiket' => 300,
        ]);

        Concert::factory()->create([
            'nama_band' => 'Noah',
            'lokasi' => 'Sarinah, JAKARTA',
            'tanggal' => '2025-06-15',
            'poster' => 'noah.jpg',
            'harga' => 150000,
            'stok_tiket' => 400,
        ]);
    }
}
