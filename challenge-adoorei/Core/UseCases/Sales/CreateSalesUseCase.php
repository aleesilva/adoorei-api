<?php

namespace Core\UseCases\Sales;

use App\DTOs\CreateSaleDTO;
use App\Models\Product;
use App\Models\Sale;
use Core\Repository\SaleRepository;
use Exception;

readonly class CreateSalesUseCase
{
    public function __construct(private SaleRepository $saleRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(CreateSaleDTO $sale): Exception|Sale
    {
        $sale->amount = 0;

        foreach ($sale->products as $product) {
            $p = Product::query()->find($product['id']);

            if (! $p) {
                return new Exception('Product not found');
            }
            $sale->amount += $p->price * $product['quantity'];
        }

        return $this->saleRepository->createSale((array)$sale);
    }
}
