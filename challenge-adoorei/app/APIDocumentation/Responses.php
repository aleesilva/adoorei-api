<?php
namespace App\APIDocumentation;

use OpenApi\Annotations as OA;

class Responses {

    /**
     * @OA\Response(
     *     response="listSales",
     *     description="List of sales",
     *     @OA\JsonContent(ref="#/components/schemas/ListSales")
     * )
     */
    public $ListSales;

}
