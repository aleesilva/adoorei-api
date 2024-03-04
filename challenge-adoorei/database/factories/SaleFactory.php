<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount'   => 300_00,
            'products' => [
                [
                    'id'     => 1,
                    'name'   => 'Celular 1',
                    'price'  => 100_00,
                    'amount' => 1,
                ],
                [
                    'id'     => 2,
                    'name'   => 'Celular 3',
                    'price'  => 200_00,
                    'amount' => 2,
                ],
            ],
        ];
    }
}
