<?php

namespace Core\UseCases;

use Core\UseCases\Products\ListProductsUseCase;
use Illuminate\Database\Eloquent\Collection;

class ProductUseCase
{
    public function __construct(
        private readonly ListProductsUseCase $listProductsUseCase,
    ) {
    }

    public function listProducts(): Collection
    {
        return $this->listProductsUseCase->execute();
    }
}
