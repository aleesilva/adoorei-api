<?php

namespace Core\UseCases\Products;

use Core\Repository\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class ListProductsUseCase
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function execute(): Collection
    {
        return $this->productRepository->listProducts();
    }
}
