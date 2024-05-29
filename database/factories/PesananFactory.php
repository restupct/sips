<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pesanan>
 */
class PesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pelanggan_id' => $this->faker->numberBetween(1, 3),
            'no_transaksi' => 'INV-' . Str::random(2),
            'sub_total' => $this->faker->numberBetween(10000, 100000),
            'diskon' => 0,
            'total' => $this->faker->randomElement([30000, 45000, 60000, 80000, 100000, 200000]),
            'tanggal' => $this->faker->dateTimeBetween('2024-05-01', '2024-05-31'),
            'status' => 'Selesai'
        ];
    }
}
