<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\CreateSaleInput;
use Core\UseCases\SalesUseCase;
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
    public function __invoke(CreateSaleInput $request): JsonResponse
    {
        try {
            $sale = $this->salesUseCase->createSale($request->all());
            return response()->json($sale, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
