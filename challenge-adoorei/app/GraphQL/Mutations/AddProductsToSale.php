<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\DTOs\AddProductsToSaleDTO;
use Core\UseCases\SalesUseCase;
use Exception;

final readonly class AddProductsToSale
{
    public function __construct(private SalesUseCase $salesUseCase)
    {
    }


    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {

        try {
            $input['sale_id'] = $args['saleId'];
            $input['products'] = $args['input'][0]['products'];

            $inputDTO = AddProductsToSaleDTO::fromArray($input);
            return $this->salesUseCase->addProductsToSale($inputDTO);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
