<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Http\Resources\SaleOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Symfony\Component\HttpFoundation\Response;

final readonly class CancelSale
{

    public function __construct(private readonly SalesUseCase $salesUseCase)
    {
    }

    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        try {
            $sale = $this->salesUseCase->cancelSale($args['saleId']);

            if ($sale instanceof Exception) {
                return ['error' => $sale->getMessage()];
            }

            return $sale;
        } catch (Exception $e) {
            return ['error' => 'Internal Server Error'];
        }
    }
}
