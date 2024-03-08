<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListSalesOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class ListSalesController extends Controller
{
    public function __construct(private readonly SalesUseCase $salesUseCase)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/sales",
     *     tags={"Sales"},
     *     summary="List all sales",
     *     description="List all sales",
     *     @OA\Response(
     *      response=200,
     *      description="List of sales",
     *     @OA\JsonContent(ref="#/components/schemas/ListSales",)
     *   ),
     *  ),
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {

            $sales = $this->salesUseCase->listSales();

            if ($sales instanceof Exception) {
                return response()->json(['error' => $sales->getMessage()], Response::HTTP_NOT_FOUND);
            }

            return response()->json(ListSalesOutput::collection($sales));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
