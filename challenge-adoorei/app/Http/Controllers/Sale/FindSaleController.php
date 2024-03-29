<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class FindSaleController extends Controller
{
    public function __construct(private readonly SalesUseCase $salesUseCase)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/sale/{id}",
     *     tags={"Sales"},
     *     summary="Find a sale",
     *     description="Find a sale by id",
     *
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Sale id",
     *     ),
     *
     *   @OA\Response(
     *     response=200,
     *     description="Sale found",
     *
     *     @OA\JsonContent(ref="#/components/schemas/ListSales",)
     *  ),
     * )
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            if (empty($id)) {
                return response()->json(['error' => 'Id is required'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $sale = $this->salesUseCase->findSale($id);

            if ($sale instanceof Exception) {
                return response()->json(['error' => $sale->getMessage()], Response::HTTP_NOT_FOUND);
            }

            return response()->json(
                new SaleOutput($sale));
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
