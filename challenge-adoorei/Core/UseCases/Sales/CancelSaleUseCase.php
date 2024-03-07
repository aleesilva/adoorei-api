<?php

namespace Core\UseCases\Sales;

use App\Exceptions\SaleCanceledError;
use App\Models\Sale;
use Core\Repository\SaleRepository;

readonly class CancelSaleUseCase
{
    public function __construct(private SaleRepository $saleRepository)
    {
    }


    public function execute($id): Sale | SaleCanceledError
    {
        return $this->saleRepository->cancelSale($id);
    }
}
