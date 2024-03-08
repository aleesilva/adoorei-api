<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListSalesOutput extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sale_id'  => $this->id,
            'amount'   => $this->amount,
            'products' => ProductOutput::collection($this->products),
        ];
    }
}
