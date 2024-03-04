<?php

namespace Core\Repository;

use Illuminate\Database\Eloquent\Collection;

interface IProductRepository
{
    public function listProducts(): Collection;
}
