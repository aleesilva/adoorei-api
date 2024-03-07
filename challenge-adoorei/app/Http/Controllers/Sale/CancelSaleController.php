<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CancelSaleController extends Controller
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
            $sale = $this->salesUseCase->cancelSale($id);

            if ($sale instanceof Exception) {
                return response()->json(['error' => $sale->getMessage()], Response::HTTP_NOT_FOUND);
            }

            return response()->json(
               new SaleOutput($sale),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
