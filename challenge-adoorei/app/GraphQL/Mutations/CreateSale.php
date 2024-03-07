<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final readonly class CreateSale
{
    public function __construct(private SalesUseCase $salesUseCase)
    {
    }

    /** @param  array{}  $args
     */
    public function __invoke(null $_, array $args)
    {
        return $this->salesUseCase->createSale($args['input'][0]);
    }
}
