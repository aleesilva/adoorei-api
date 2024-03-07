<?php

namespace Core\UseCases;

use App\DTOs\AddProductsToSaleDTO;
use App\DTOs\CreateSaleDTO;
use App\Exceptions\SaleCanceledError;
use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Core\UseCases\Sales\AddProductsToSaleUseCase;
use Core\UseCases\Sales\CancelSaleUseCase;
use Core\UseCases\Sales\CreateSalesUseCase;
use Core\UseCases\Sales\FindSaleUseCase;
use Core\UseCases\Sales\ListSalesUseCase;
use Exception;
use Illuminate\Database\Eloquent\Collection;

readonly class SalesUseCase
{
    public function __construct(
        private CreateSalesUseCase $createSalesUseCase,
        private ListSalesUseCase   $listSalesUseCase,
        private FindSaleUseCase    $findSaleUseCase,
        private CancelSaleUseCase  $cancelSaleUseCase,
        private AddProductsToSaleUseCase $addProductsToSaleUseCase
    )
    {
    }

    /**
     * @throws Exception
     */
    public function createSale(CreateSaleDTO $sale): Exception|Sale
    {
        return $this->createSalesUseCase->execute($sale);
    }

    /**
     * @throws SalesNotFound
     */
    public function listSales(): Collection|SalesNotFound
    {
        return $this->listSalesUseCase->execute();
    }

    /**
     * @throws SalesNotFound
     */
    public function findSale(int $id): Sale|SalesNotFound
    {
            return $this->findSaleUseCase->execute($id);
    }

    /**
     * @throws SaleCanceledError
     */
    public function cancelSale(int $id): Sale|SaleCanceledError
    {
        return $this->cancelSaleUseCase->execute($id);
    }

    /**
     * @throws SalesNotFound
     */
    public function addProductsToSale(int $id, array $products): Sale|SalesNotFound
    {
        return $this->addProductsToSaleUseCase->execute($id, $products);
    }
}
