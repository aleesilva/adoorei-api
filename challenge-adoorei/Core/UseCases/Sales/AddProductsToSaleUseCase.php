<?php

namespace Core\UseCases\Sales;

use App\DTOs\AddProductsToSaleDTO;
use App\Exceptions\SalesNotFound;
use App\Models\Product;
use App\Models\Sale;
use Core\Repository\SaleRepository;
use Exception;
use Illuminate\Support\Facades\Log;

readonly class AddProductsToSaleUseCase
{

    public function __construct(private SaleRepository $saleRepository)
    {
    }


    /**
     * @throws SalesNotFound
     */
    public function execute( AddProductsToSaleDTO $input): Sale|SalesNotFound|Exception
    {
        $sale['amount'] = 0;

        foreach ($input->products as $product) {
            $p = Product::query()->find($product['id']);
            if (!$p) {
                return new Exception('Product not found');
            }
            $sale['amount'] += $p->price * $product['quantity'];
        }
        return $this->saleRepository->addProductsToSale($input->sale_id, $input->products, $sale['amount']);

    }
}
