<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

final readonly class AddProductsToSale
{
    public function __construct(private SalesUseCase $salesUseCase)
    {
    }


    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {

        try {

            $sale = $this->salesUseCase->addProductsToSale(
                $args['saleId'],
                $args['input'][0]
            );

            if ($sale instanceof Exception) {
                return ['error' => $sale->getMessage()];
            }

            return $sale;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
