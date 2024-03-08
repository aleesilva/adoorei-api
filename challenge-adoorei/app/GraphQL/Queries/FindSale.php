<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Core\UseCases\SalesUseCase;
use Exception;

final readonly class FindSale
{
    public function __construct(private SalesUseCase $salesUseCase)
    {
    }

    /** @param  array{}  $args */
    public function __invoke(null $_, array $args): array|Sale|SalesNotFound
    {
        try {
            if (empty($args['saleId'])) {
                return ['error' => 'Id is required'];
            }

            $sale = $this->salesUseCase->findSale($args['saleId']);

            if ($sale instanceof Exception) {
                return ['error' => $sale->getMessage()];
            }

            return $sale;
        } catch (Exception) {
            return ['error' => 'Internal server error'];
        }
    }
}
