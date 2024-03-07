<?php

namespace App\DTOs;

use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AddProductsToSaleDTO extends ValidatedDTO
{


    public int $sale_id;
    public array $products;

    protected function rules(): array
    {
        return [
            'sale_id' => ['required', 'integer', Rule::exists('sales', 'id')],
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'integer', Rule::exists('products', 'id')],
            'products.*.quantity' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'sale_id.required' => 'Sale ID is required.',
            'sale_id.integer' => 'Sale ID must be an integer.',
            'sale_id.exists' => 'Sale does not exist.',
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
