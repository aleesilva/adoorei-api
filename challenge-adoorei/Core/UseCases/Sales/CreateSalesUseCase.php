<?php

namespace Core\UseCases\Sales;

use App\Models\Sale;
use Core\Repository\SaleRepository;
use Exception;

class CreateSalesUseCase
{
    public function __construct(private readonly SaleRepository $saleRepository)
    {
    }

    public function execute($sale): Exception|Sale
    {
        return $this->saleRepository->createSale($sale);
    }
}
