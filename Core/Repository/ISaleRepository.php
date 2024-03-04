<?php

namespace Core\Repository;

use App\Models\Sale;
use Exception;

interface ISaleRepository
{
    public function createSale(array $sale): Sale | Exception;
}
