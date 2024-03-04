<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => 'Celular '.$this->faker->randomNumber(1, 10),
            'price'       => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->text,
        ];
    }
}
