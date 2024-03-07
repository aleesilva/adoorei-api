<?php

namespace App\DTOs;

use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CreateSaleDTO extends ValidatedDTO
{

    public float $amount = 0;
    public array $products;

    protected function rules(): array
    {
        return [
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'integer', Rule::exists('products', 'id')],
            'products.*.quantity' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'products.required' => 'Product is required.',
            'products.array' => 'Products must be an array.',
            'products.*.id.required' => 'Product ID is required.',
            'products.*.id.integer' => 'Product ID must be an integer.',
            'products.*.id.exists' => 'Some products do not exist.',
            'products.*.quantity.required' => 'Product quantity is required.',
            'products.*.quantity.integer' => 'Product quantity must be an integer.',
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
