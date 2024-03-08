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
        // Generate Faker price

        return [
            'name'        => 'Celular - '.$this->faker->randomNumber(1, 10),
            'price'       => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->text,
        ];
    }
}
