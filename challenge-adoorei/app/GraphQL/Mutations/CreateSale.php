<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Core\UseCases\SalesUseCase;
use Laravel\Octane\Exceptions\DdException;

final readonly class CreateSale
{
    public function __construct(private SalesUseCase $salesUseCase)
    {
    }

    /** @param  array{}  $args
     * @throws DdException
     */
    public function __invoke(null $_, array $args)
    {
        return $this->salesUseCase->createSale($args);
    }
}
