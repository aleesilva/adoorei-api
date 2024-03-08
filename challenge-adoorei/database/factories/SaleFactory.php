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
            'amount'           => 0,
            'sale_products_id' => [
                [
                    'id'       => 1,
                    'quantity' => 1,
                ],
                [
                    'id'       => 2,
                    'quantity' => 1,
                ],
            ],
        ];
    }
}
