<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\DTOs\CreateSaleDTO;
use Core\UseCases\SalesUseCase;

final readonly class CreateSale
{
    public function __construct(private SalesUseCase $salesUseCase)
    {
    }

    /** @param  array{}  $args
     */
    public function __invoke(null $_, array $args)
    {
        $inputDTO = CreateSaleDTO::fromArray($args['input'][0]);
        return $this->salesUseCase->createSale($inputDTO);
    }
}
