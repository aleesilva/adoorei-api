<?php

namespace Core\Repository;

use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository implements ISaleRepository
{
    public function createSale($sale): Sale | Exception
    {
        try {
            Sale::query()->create($sale);

            return Sale::query()->get()->last();
        } catch (Exception $e) {
            return new Exception('Invalid data');
        }

    }

    public function listSales(): Collection|SalesNotFound
    {
        try {
            return Sale::all();
        } catch (Exception) {
            return new SalesNotFound('Sales not found');
        }
    }
}
