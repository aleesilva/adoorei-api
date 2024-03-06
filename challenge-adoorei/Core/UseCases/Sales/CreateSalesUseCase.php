<?php

namespace Core\UseCases\Sales;

use App\Models\Product;
use App\Models\Sale;
use Core\Repository\ProductRepository;
use Core\Repository\SaleRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

readonly class CreateSalesUseCase
{
    public function __construct(private SaleRepository $saleRepository)
    {
    }

    public function execute($sale): Exception|Sale
    {

        $sale['amount'] = 0;

        foreach ($sale['products'] as $product) {
            $p = Product::query()->find($product['id']);
            if (!$p) {
                return new Exception('Product not found');
            }
            $sale['amount'] += $p->price * $product['quantity'];
        }
//    $sale['amount'] = 100;
        return $this->saleRepository->createSale($sale);
    }
}
