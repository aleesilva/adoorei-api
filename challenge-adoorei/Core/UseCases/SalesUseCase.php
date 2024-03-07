<?php

namespace Core\UseCases;

use App\Exceptions\SalesNotFound;
use App\Models\Sale;
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
        private CancelSaleUseCase  $cancelSaleUseCase
    )
    {
    }

    public function createSale($sale): Exception|Sale
    {
        return $this->createSalesUseCase->execute($sale);
    }

    public function listSales(): Collection|SalesNotFound
    {
        return $this->listSalesUseCase->execute();
    }

    public function findSale(int $id): Sale|SalesNotFound
    {
        return $this->findSaleUseCase->execute($id);
    }

    public function cancelSale(int $id): Sale|SalesNotFound
    {
        return $this->cancelSaleUseCase->execute($id);
    }
}
