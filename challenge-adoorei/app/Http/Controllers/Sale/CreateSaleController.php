<?php

namespace App\Http\Controllers\Sale;

use App\DTOs\CreateSaleDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class CreateSaleController extends Controller
{
    public function __construct(private readonly SalesUseCase $salesUseCase)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/sales",
     *     tags={"Sales"},
     *     summary="Create a new sale",
     *     description="Create a new sale",
     *
     *     @OA\RequestBody(
     *     required=true,
     *
     *     @OA\JsonContent(
     *     required={"products"},
     *
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
            $inputDTO = CreateSaleDTO::fromRequest($request);
            $sale     = $this->salesUseCase->createSale($inputDTO);

            return new SaleOutput($sale);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
