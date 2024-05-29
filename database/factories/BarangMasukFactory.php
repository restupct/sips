<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangMasuk>
 */
class BarangMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'barang_id' => $this->faker->numberBetween(1, 4),
            'tanggal' => $this->faker->dateTimeBetween('2024-05-01', '2024-05-31'),
            // 'harga_beli' => $this->faker->numberBetween(100000, 320000),
            'harga_beli' => $this->faker->randomElement(['100000', '150000', '200000']),
            'stok' => $this->faker->numberBetween(10, 20)
        ];
    }
}
