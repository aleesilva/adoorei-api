<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            return response()->json(
               new SaleOutput($this->salesUseCase->cancelSale($id)),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
