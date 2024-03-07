<?php

use App\Models\Product;
use App\Models\Sale;
use Core\Repository\SaleRepository;
use Core\UseCases\Sales\AddProductsToSaleUseCase;
use Core\UseCases\Sales\CancelSaleUseCase;
use Core\UseCases\Sales\CreateSalesUseCase;
use Core\UseCases\Sales\FindSaleUseCase;
use Core\UseCases\Sales\ListSalesUseCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

beforeEach(function () {
    $this->createSaleUseCase = new CreateSalesUseCase(new SaleRepository());
    $this->listSaleUseCase = new ListSalesUseCase(new SaleRepository());
    $this->findSaleUseCase = new FindSaleUseCase(new SaleRepository());
    $this->cancelSaleUseCase = new CancelSaleUseCase(new SaleRepository());
    $this->addProductsToSaleUseCase = new AddProductsToSaleUseCase(new SaleRepository());

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


describe('CreateSaleUseCase', function() {
    it('should be able create a sale', function () {
        $sales       = $this->createSaleUseCase->execute($this->sale);
        expect($sales)
            ->toBeInstanceOf(Sale::class);
    });

    it('should be able create a sale with products', function () {
        $sales       = $this->createSaleUseCase->execute($this->sale);
        expect($sales->products)
            ->toHaveCount(2);
    });

    it('should be not able create a sale with invalid product', function () {
        $this->sale['products'][0]['id'] = 100;
        $sales       = $this->createSaleUseCase->execute($this->sale);
        expect($sales)
            ->toBeInstanceOf(Exception::class)
            ->and($sales->getMessage())->toBe('Product not found');
    });
});

describe('ListSalesUseCase', function (){
    it('should be able list sales', function () {
        $this->createSaleUseCase->execute($this->sale);
        $sales = $this->listSaleUseCase->execute();
        expect($sales)
            ->toHaveCount(1);
    });

    it('should be able list sales with products', function () {
        $this->createSaleUseCase->execute($this->sale);
        $sales = $this->listSaleUseCase->execute();
        expect($sales[0]->products)
            ->toHaveCount(2);
    });

    it('should be not able list sales with invalid sale id', function () {
        $sales = $this->listSaleUseCase->execute(100);
        expect($sales)
            ->toBeEmpty();
    });
});

describe('FindSaleUseCase', function() {
    it('should be able find a sale', function () {
        $this->createSaleUseCase->execute($this->sale);
        $sales = $this->findSaleUseCase->execute(1);
        expect($sales)
            ->toBeInstanceOf(Sale::class);
    });

    it('should be able find a sale with products', function () {
        $this->createSaleUseCase->execute($this->sale);
        $sales = $this->findSaleUseCase->execute(1);
        expect($sales->products)
            ->toHaveCount(2);
    });

    it('should be not able find a sale with invalid sale id', function () {
        $sales = $this->findSaleUseCase->execute(100);
        expect($sales)
            ->toBeInstanceOf(Exception::class)
            ->and($sales->getMessage())->toBe('Sale not found !');
    });
});

describe('CancelSaleUseCase', function() {
    it('should be able cancel a sale', function () {
        $this->createSaleUseCase->execute($this->sale);
        $sales = $this->cancelSaleUseCase->execute(1);
        expect($sales->cancelled_at)
            ->not->toBeNull()
            ->and($sales->cancelled_at)
            ->toBeInstanceOf(Carbon::class);
    });

    it('should be not able cancel a sale with invalid sale id', function () {
        $sales = $this->cancelSaleUseCase->execute(100);
        expect($sales)
            ->toBeInstanceOf(Exception::class)
            ->and($sales->getMessage())->toBe('Sale not found');
    });
});

describe('AddProductsToSaleUseCase', function (){
    it('should be able add products to a sale', function () {
        $this->createSaleUseCase->execute($this->sale);
        $sales = $this->addProductsToSaleUseCase->execute(1, [
            [
                'id' => 3,
                'quantity' => 1,
            ],
        ]);
        expect($sales->products)
            ->toHaveCount(3);
    });

    it('should be not able add products to a sale with invalid sale id', function () {
        $sales = $this->addProductsToSaleUseCase->execute(100, [
            [
                'id' => 3,
                'quantity' => 1,
            ],
        ]);
        expect($sales)
            ->toBeInstanceOf(Exception::class)
            ->and($sales->getMessage())->toBe('Sale not found');
    });
});

