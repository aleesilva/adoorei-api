<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Core\UseCases\ProductUseCase;

final readonly class ListProducts
{
    public function __construct(private ProductUseCase $productUseCase)
    {
    }

    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return $this->productUseCase->listProducts();
    }
}
