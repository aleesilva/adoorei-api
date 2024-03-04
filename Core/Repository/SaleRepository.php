<?php

namespace Core\Repository;

use App\Models\Sale;
use Exception;

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
}
