<?php

use App\Models\Product;
use App\Models\Sale;
use Core\Repository\ProductRepository;
use Core\Repository\SaleRepository;
use Core\UseCases\Sales\CreateSalesUseCase;
use Core\UseCases\SalesUseCase;

it('create a sale', function () {
    Product::factory(2)->create();
    $sale = [
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

    $saleUseCase = new CreateSalesUseCase(new SaleRepository(), new ProductRepository());
    $sales       = $saleUseCase->execute($sale);
    expect($sales)
        ->toBeInstanceOf(Sale::class)
        ->and($sale->amount)->toBe(300_00);
});
