<?php

namespace Core\UseCases\Sales;

use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Core\Repository\SaleRepository;

readonly class FindSaleUseCase
{
    public function __construct(private SaleRepository $saleRepository)
    {
    }

    public function execute(int $id): Sale | SalesNotFound
    {
        return $this->saleRepository->findSaleById($id);
    }
}
