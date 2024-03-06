<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\CreateSaleInput;
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
     *     @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *     mediaType="application/json",
     *     @OA\Schema(
     *     required={"product_id"},
     *      @OA\Property(
     *       property="product_id",
     *       type="integer",
     *       description="Product ID"
     *    ),
     *   ),
     *  ),
    * ),
     * @OA\Response(
     *     response=201,
     *     description="Sale created"
     * ),
     * )
     *
     *
     */
    public function __invoke(Request $request): SaleOutput | JsonResponse
    {
        try {
            $sale = $this->salesUseCase->createSale($request->all());
            return new SaleOutput($sale);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
