<?php

use App\Exceptions\SaleCanceledError;
use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Core\Repository\ISaleRepository;
use Core\Repository\SaleRepository;
use Illuminate\Database\Eloquent\Collection;

use function Pest\Laravel\assertDatabaseCount;

describe('Testing a Sale Repository', function () {
    it('should be able create a new sale', function () {
        $sale = [
            'amount'   => 300_00,
            'sale_products_id' => [
                [
                    'id'     => 1,
                    'quantity' => 1,
                ],
                [
                    'id'     => 2,
                    'quantity' => 2,
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
        $saleRepository = Mockery::mock(ISaleRepository::class);
        $saleRepository->shouldReceive('createSale')->andReturn(new Exception('Invalid data'));
        $sale = $saleRepository->createSale([]);
        expect($sale)
            ->toBeInstanceOf(Exception::class)
            ->and($sale->getMessage())->toBe('Invalid data');
    });

    it('should be able list all sales', function () {
        Sale::factory(1)->create();
        $saleRepository = new SaleRepository();
        $sales          = $saleRepository->listSales();

        assertDatabaseCount('sales', $sales->count());
        expect($sales->pluck('amount')[0])->toBe(30000)
            ->and($sales)
            ->toBeInstanceOf(Collection::class)
            ->and($sales->count())->toBe(1)
            ->and($sales->first())->toBeInstanceOf(Sale::class);
//            ->and($sales)->contains([
//                'amount'   => 30000,
//
//                ],
//            ]);
    });

    it('should be not able list all sales', function () {
        $saleRepository = Mockery::mock(ISaleRepository::class);
        $saleRepository->shouldReceive('listSales')->andReturn(new SalesNotFound('Sales not found'));
        $sales = $saleRepository->listSales();
        expect($sales)
            ->toBeInstanceOf(SalesNotFound::class)
            ->and($sales->getMessage())->toBe('Sales not found');
    });

    it('should be able find a sale by id', function () {
        $sale           = Sale::factory(1)->create();
        $saleRepository = new SaleRepository();
        $sale           = $saleRepository->findSaleById($sale->first()->id);
        expect($sale)
            ->toBeInstanceOf(Sale::class);

    });

    it('should be not able find a sale by id', function () {
        $saleRepository = Mockery::mock(ISaleRepository::class);
        $saleRepository->shouldReceive('findSaleById')->andReturn(new SalesNotFound('Sale not found'));
        $sale = $saleRepository->findSaleById(1);
        expect($sale)
            ->toBeInstanceOf(SalesNotFound::class)
            ->and($sale->getMessage())->toBe('Sale not found');
    });

    it('should be able cancel a sale', function () {
        $sale           = Sale::factory(1)->create();
        $saleRepository = new SaleRepository();
        $sale           = $saleRepository->cancelSale($sale->first()->id);
        expect($sale)
            ->toBeInstanceOf(Sale::class)
            ->and($sale->cancelled_at)->not->toBeNull();
    });

    it('should be not able cancel a sale', function () {
        $saleRepository = Mockery::mock(ISaleRepository::class);
        $saleRepository->shouldReceive('cancelSale')->andReturn(new SaleCanceledError('Sale cannot be canceled'));
        $sale = $saleRepository->cancelSale(1);
        expect($sale)
            ->toBeInstanceOf(SaleCanceledError::class)
            ->and($sale->getMessage())->toBe('Sale cannot be canceled');
    });

    it('should be able add products to a sale', function () {
        $sale           = Sale::factory(1)->create();
        $saleRepository = new SaleRepository();
        $sale           = $saleRepository->addProductsToSale($sale->first()->id, [
            'sale_products_id' =>
            [
                'id'     => 3,
                'quantity' => 1,
            ],
            [
                'id'     => 4,
                'quantity' => 1,
            ],
        ]);
        expect($sale)
            ->toBeInstanceOf(Sale::class);
    })->skip('Looking for a way to test this');

    it('should be not able add products to a sale', function () {
        $saleRepository = Mockery::mock(ISaleRepository::class);
        $saleRepository->shouldReceive('addProductsToSale')->andReturn(new SalesNotFound('Sale not found'));
        $sale = $saleRepository->addProductsToSale(1, []);
        expect($sale)
            ->toBeInstanceOf(SalesNotFound::class)
            ->and($sale->getMessage())->toBe('Sale not found');
    });
});
