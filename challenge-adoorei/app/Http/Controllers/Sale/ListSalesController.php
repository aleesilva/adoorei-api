<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListSalesOutput;
use Core\UseCases\SalesUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
