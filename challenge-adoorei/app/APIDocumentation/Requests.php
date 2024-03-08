<?php

namespace App\APIDocumentation;

use OpenApi\Annotations as OA;

class Requests
{

    /**
     * @OA\RequestBody(
     *     request="CreateSaleInput",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateSaleInput")
     * ),
     */
   public $createSale;

}
