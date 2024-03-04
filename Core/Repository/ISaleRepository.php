<?php

namespace Core\Repository;
use App\Exceptions\SalesNotFound;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Sale;
use Exception;

interface ISaleRepository
{
    public function createSale(array $sale): Sale | Exception;

    public function listSales(): Collection | SalesNotFound;
}
