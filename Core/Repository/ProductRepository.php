<?php

namespace Core\Repository;

use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements IProductRepository
{

    public function listProducts(): Collection
    {
        // TODO: Implement listProducts() method.
        return new Collection();
    }
}
