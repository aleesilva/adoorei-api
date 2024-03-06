<?php

namespace Core\UseCases\Sales;

use App\Models\Product;
use App\Models\Sale;
use Core\Repository\ProductRepository;
use Core\Repository\SaleRepository;
use Exception;

class CreateSalesUseCase
{
    public function __construct(private readonly SaleRepository $saleRepository, private readonly ProductRepository $productRepository)
    {
    }

    public function execute($sale): Exception|Sale
    {
        foreach ($sale['products'] as $product) {
            $product = Product::query()->find($product['id']);
            if (!$product) {
                return new Exception('Product not found');
            }
        }

        dd($sale);

        return $this->saleRepository->createSale($sale);
    }
}
