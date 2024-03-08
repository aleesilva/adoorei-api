<?php

use App\Models\Product;
use Core\Repository\ProductRepository;
use Core\UseCases\Products\ListProductsUseCase;

beforeEach(function() {
    $this->listProductsUseCase = new ListProductsUseCase(new ProductRepository());
});


describe('ListProductsUseCase', function (){
    it('should be able list of products', function () {
        Product::factory(3)->create();
        $products = $this->listProductsUseCase->execute();
        expect($products)
            ->toHaveCount(3);
    });

    it('should be able list of products with empty database', function () {
        $products = $this->listProductsUseCase->execute();
        expect($products)
            ->toHaveCount(0);
    });
});
