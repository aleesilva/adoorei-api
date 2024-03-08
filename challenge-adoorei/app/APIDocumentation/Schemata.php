<?php

namespace App\APIDocumentation;

use OpenApi\Annotations as OA;

class Schemata
{
    /**
     * @OA\Schema(
     *   schema="ListSales",
     *   type="object",
     *
     *   @OA\Property(property="sale_id", type="integer", description="Sale id", example="1",),
     *   @OA\Property(property="amount", type="number", description="Sale amount", example="100.00",),
     *   @OA\Property(property="products", type="array", description="List of products", @OA\Items(ref="#/components/schemas/ListSalesProducts"),),
     * )
     */
    public $ListSales;

    /**
     * @OA\Schema(
     *     schema="ListSalesProducts",
     *     type="object",
     *
     *     @OA\Property(property="product_id", type="integer", description="Product id", example="1",),
     *     @OA\Property(property="name", type="string", description="Product name", example="Product 1",),
     *     @OA\Property(property="price", type="number", description="Product price", example="100.00",),
     *     @OA\Property(property="quantity", type="integer", description="Product quantity", example="1",),
     *
     * )
     */
    public $products;

    /**
     * @OA\Schema(
     *     schema="CreateSaleInput",
     *     type="object",
     *     required={"products"},
     *
     *     @OA\Property(property="products", type="array", description="List of Products", @OA\Items(ref="#/components/schemas/CreateSaleInputProducts")),
     * ),
     */
    public $createSaleInput;

    /**
     * @OA\Schema(
     *     schema="CreateSaleInputProducts",
     *     type="object",
     *     required={"id"},
     *
     *     @OA\Property(property="id", type="integer", description="Product id", example="1",),
     *     @OA\Property(property="quantity", type="integer", description="Product quantity", example="1",),
     * ),
     */
    public $createSaleInputProducts;
}
