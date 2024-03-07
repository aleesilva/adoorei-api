<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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

        $products = Product::factory(2)->create();

        return [
            'amount'   => array_sum(Arr::pluck($products, 'price')),
            'sale_products_id' => [
                [
                    'id'     => 1,
                    'quantity' => 1,
                ],
                [
                    'id'     => 2,
                    'quantity' => 1,
                ],
            ],
        ];
    }
}
