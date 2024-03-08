<?php

namespace App\Http\Controllers\Sale;

use App\DTOs\AddProductsToSaleDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class AddProductsToSaleController extends Controller
{
    public function __construct(private readonly SalesUseCase $salesUseCase)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/sale/add-products",
     *     tags={"Sales"},
     *     summary="Create a new sale",
     *     description="Add products to a existing sale",
     *
     *     @OA\RequestBody(
     *     required=true,
     *
     *     @OA\JsonContent(
     *     required={"products, sale_id"},
     *
     *     @OA\Property(property="sale_id", type="integer", example="1"),
     *     @OA\Property(property="products", type="array", @OA\Items(ref="#/components/schemas/CreateSaleInputProducts")),
     *     )
     *    ),
     *
     *     @OA\Response(
     *     response=200,
     *     description="Sale created",
     *
     *     @OA\JsonContent(ref="#/components/schemas/ListSales"),
     *     ),
     *   ),
     */
    public function __invoke(Request $request): SaleOutput|JsonResponse
    {
        try {
            $inputDTO = AddProductsToSaleDTO::fromRequest($request);
            $sale     = $this->salesUseCase->addProductsToSale($inputDTO);

            return new SaleOutput($sale);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
