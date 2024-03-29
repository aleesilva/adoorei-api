<?php

use App\Models\Product;
use Core\Repository\ProductRepository;

use function Pest\Laravel\assertDatabaseCount;

describe('Testing Product Repository', function () {
    it('should return all products', function () {
        Product::factory()->count(10)->create();

        $productRepository = new ProductRepository();

        $products = $productRepository->listProducts();

        assertDatabaseCount('products', 10);
    });

    it('should be return a empty collection of products', function () {
        $productRepository = new ProductRepository();
        $products          = $productRepository->listProducts();
        expect($products)->toBeEmpty();
    });
});
