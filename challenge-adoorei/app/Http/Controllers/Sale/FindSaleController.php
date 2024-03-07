<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindSaleController extends Controller
{
    public function __construct(private readonly SalesUseCase $salesUseCase)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            if (empty($id)) {
                return response()->json(['error' => 'Id is required'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            return response()->json(
                new SaleOutput($this->salesUseCase->findSale($id))
                , 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
