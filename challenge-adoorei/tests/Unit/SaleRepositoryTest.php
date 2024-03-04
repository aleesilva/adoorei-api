<?php

use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Core\Repository\ISaleRepository;
use Core\Repository\SaleRepository;
use function Pest\Laravel\assertDatabaseCount;

describe('Testing a Sale Repository', function () {
    it('should be able create a new sale', function () {
        $sale = [
            'amount' => 300_00,
            'products' => [
                [
                    'id' => 1,
                    'name' => 'Celular 1',
                    'price' => 100_00,
                    'amount' => 1,
                ],
                [
                    'id' => 2,
                    'name' => 'Celular 3',
                    'price' => 200_00,
                    'amount' => 2,
                ],
            ],

        ];

        $saleRepository = new SaleRepository();
        $sale           = $saleRepository->createSale($sale);
        expect($sale)
            ->toBeInstanceOf(Sale::class)
            ->and($sale->amount)->toBe(300_00);
    });

    it('should be not able create a new sale with invalid data', function () {
       $saleRepository =  Mockery::mock(ISaleRepository::class);
       $saleRepository->shouldReceive('createSale')->andReturn(new Exception('Invalid data'));
       $sale = $saleRepository->createSale([]);
        expect($sale)
            ->toBeInstanceOf(Exception::class)
            ->and($sale->getMessage())->toBe('Invalid data');
    });

    it('should be able list all sales', function () {
       Sale::factory(1)->create();
        $saleRepository = new SaleRepository();
        $sales = $saleRepository->listSales();
       assertDatabaseCount('sales', $sales->count());
    });

    it('should be not able list all sales', function () {
        $saleRepository =  Mockery::mock(ISaleRepository::class);
        $saleRepository->shouldReceive('listSales')->andReturn(new SalesNotFound ('Sales not found'));
        $sales = $saleRepository->listSales();
        expect($sales)
            ->toBeInstanceOf(SalesNotFound::class)
            ->and($sales->getMessage())->toBe('Sales not found');
    });
});
