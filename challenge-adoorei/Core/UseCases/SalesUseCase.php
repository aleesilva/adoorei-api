<?php

namespace Core\UseCases;

use App\Models\Sale;
use Core\UseCases\Sales\CreateSalesUseCase;
use Exception;

class SalesUseCase
{
    public function __construct(
        private readonly CreateSalesUseCase $createSalesUseCase,
    ) {
    }

    public function createSale($sale): Exception|Sale
    {
        return $this->createSalesUseCase->execute($sale);
    }
}
