<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Exceptions\SalesNotFound;
use App\Http\Resources\ListSalesOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Database\Eloquent\Collection;

final readonly class ListSales
{
    public function __construct(private SalesUseCase $salesUseCase)
    {
    }

    /** @param  array{}  $args */
    public function __invoke(null $_, array $args): Collection|array|SalesNotFound
    {
        try {

            $sales = $this->salesUseCase->listSales();

            if ($sales instanceof Exception) {
               return ['error' => $sales->getMessage()];
            }

            return $sales;
        } catch (Exception $e) {
          return ['error' => $e->getMessage()];
        }
    }
}
