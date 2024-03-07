<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddProductsToSaleController extends Controller
{
    public function __construct(private readonly SalesUseCase $salesUseCase)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $sale = $this->salesUseCase->addProductsToSale(
                $request->input('id'),
                $request->input('products')
            );

            if ($sale instanceof Exception) {
                return response()->json(['error' => $sale->getMessage()], Response::HTTP_NOT_FOUND);
            }

            return response()->json($sale, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
