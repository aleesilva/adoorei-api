<?php

namespace Core\UseCases\Products;

use Core\Repository\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class ListProductsUseCase
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function execute(): Collection
    {
        return $this->productRepository->listProducts();
    }
}
