<?php

namespace Core\Repository;
use App\Exceptions\SaleCanceledError;
use App\Exceptions\SalesNotFound;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Sale;
use Exception;

interface ISaleRepository
{
    public function createSale(array $sale): Sale | Exception;

    public function listSales(): Collection | SalesNotFound;

    public function findSaleById(int $id): Sale | SalesNotFound;

    public function cancelSale(int $id): Sale |  SaleCanceledError;

    public function addProductsToSale(int $id, array $products): Sale | SalesNotFound;
}
