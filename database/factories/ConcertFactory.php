<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concert>
 */
class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_band' => $this->faker->randomElement(['NDX', 'Kahitna', 'Noah']),
            'lokasi' => $this->faker->city(),
            'tanggal' => $this->faker->date(),
            'harga' => $this->faker->numberBetween(100000, 300000),
            'poster' => $this->faker->imageUrl(),
            'stok_tiket' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
