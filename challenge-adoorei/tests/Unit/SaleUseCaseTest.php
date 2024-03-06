<?php

use App\Models\Product;
use App\Models\Sale;
use Core\Repository\ProductRepository;
use Core\Repository\SaleRepository;
use Core\UseCases\Sales\CreateSalesUseCase;
use Core\UseCases\SalesUseCase;
use Illuminate\Support\Arr;

it('create a sale', function () {
    $products = Product::factory(2)->create();
    $sale = [
        'amount'   => 0,
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

    $saleUseCase = new CreateSalesUseCase(new SaleRepository());
    $sales       = $saleUseCase->execute($sale);
    expect($sales)
        ->toBeInstanceOf(Sale::class);

});
