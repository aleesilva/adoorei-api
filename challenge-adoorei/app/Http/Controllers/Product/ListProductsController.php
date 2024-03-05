<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Core\UseCases\ProductUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ListProductsController extends Controller
{
    public function __construct(private readonly ProductUseCase $productUseCase)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Product"},
     *     summary="List all products",
     *     description="List all products",
     *     @OA\Response(
     *     response=200,
     *     description="List of products",
     *   ),
     * )
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            return response()->json($this->productUseCase->listProducts(), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
