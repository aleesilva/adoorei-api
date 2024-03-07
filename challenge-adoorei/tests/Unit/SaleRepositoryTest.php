<?php

use App\Exceptions\SaleCanceledError;
use App\Exceptions\SalesNotFound;
use App\Models\Product;
use App\Models\Sale;
use Core\Repository\ISaleRepository;
use Core\Repository\SaleRepository;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Arr;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->products = Product::factory(3)->create();
    $this->sale = [
        'amount' => array_sum(Arr::pluck($this->products, 'price')),
        'products' => [
            [
                'id' => 1,
                'quantity' => 1,
            ],
            [
                'id' => 2,
                'quantity' => 2,
            ],
        ],
    ];
});

describe('Testing a Sale Repository', function () {
    it('should be able create a new sale', function () {
        $saleRepository = new SaleRepository();
        $sale = $saleRepository->createSale($this->sale);
        expect($sale)
            ->toBeInstanceOf(Sale::class)
            ->and($sale->amount)->toBe($sale['amount']);
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
        $saleRepository = new SaleRepository();
        $sale = $saleRepository->createSale($this->sale);
        $sales = $saleRepository->listSales();

        assertDatabaseCount('sales', 1);

        expect($sales->pluck('amount')[0])->toBe($sale['amount'])
            ->and($sales)
            ->toBeInstanceOf(Collection::class)
            ->and($sales->count())->toBe(1)
            ->and($sales->first())->toBeInstanceOf(Sale::class);
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
        $saleRepository = new SaleRepository();
        $createdSale = $saleRepository->createSale($this->sale);
        $sale = $saleRepository->findSaleById($createdSale->id);

        expect($sale)
            ->toBeInstanceOf(Sale::class)
            ->and($sale->amount)->toBe($sale['amount'])
            ->and($sale->id)->toBe($createdSale->id)
            ->and($sale->products->count())->toBe(2);
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

        $saleRepository = new SaleRepository();
        $sale = $saleRepository->createSale($this->sale);
        $sale = $saleRepository->cancelSale($sale->first()->id);
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
        $saleRepository = new SaleRepository();
        $testSale = $saleRepository->createSale($this->sale);
        $sale = $saleRepository->addProductsToSale($testSale->id, [
            'products' =>
                [
                    'id' => 3,
                    'quantity' => 1,
                ],
        ], Product::query()->find(3)->first()->price);
        expect($sale)
            ->toBeInstanceOf(Sale::class)
            ->and($sale->products->count())->toBe(3)
            ->and($testSale->amount + Product::query()->find(3)->first()->price)->toBe($sale->amount);
    });

    it('should be not able add products to a sale', function () {
        $saleRepository = Mockery::mock(ISaleRepository::class);
        $saleRepository->shouldReceive('addProductsToSale')->andReturn(new SalesNotFound('Sale not found'));
        $sale = $saleRepository->addProductsToSale(1, ['products'], 0);
        expect($sale)
            ->toBeInstanceOf(SalesNotFound::class)
            ->and($sale->getMessage())->toBe('Sale not found');
    });
});
