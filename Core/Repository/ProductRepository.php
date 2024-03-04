<?php

namespace Core\Repository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements IProductRepository
{
    public function listProducts(): Collection
    {
        return Product::all();
    }
}
