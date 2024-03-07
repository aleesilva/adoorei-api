<?php

namespace Core\UseCases\Sales;

use App\Exceptions\SalesNotFound;
use Core\Repository\SaleRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class ListSalesUseCase
{
    public function __construct(private SaleRepository $saleRepository)
    {
    }


    /**
     * @throws SalesNotFound
     */
    public function execute(): Collection | SalesNotFound
    {
        return $this->saleRepository->listSales();
    }
}
