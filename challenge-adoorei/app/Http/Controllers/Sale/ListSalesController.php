<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListSalesOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListSalesController extends Controller
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
            return response()->json(
                ListSalesOutput::collection($this->salesUseCase->listSales()),
            );
        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
