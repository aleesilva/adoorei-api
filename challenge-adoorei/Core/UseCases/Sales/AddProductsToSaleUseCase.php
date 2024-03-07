<?php

namespace Core\UseCases\Sales;

use App\Exceptions\SalesNotFound;
use App\Models\Product;
use App\Models\Sale;
use Core\Repository\SaleRepository;
use Exception;

class AddProductsToSaleUseCase
{

    public function __construct(private SaleRepository $saleRepository)
    {
    }


    /**
     * @throws SalesNotFound
     */
    public function execute($id, $products): Sale|SalesNotFound|Exception
    {

        $sale['amount'] = 0;

        foreach ($products as $product) {
            $p = Product::query()->find($product['id']);
            if (!$p) {
                return new Exception('Product not found');
            }
            $sale['amount'] += $p->price * $product['quantity'];
        }

        return $this->saleRepository->addProductsToSale($id, $products, $sale['amount']);

    }
}
