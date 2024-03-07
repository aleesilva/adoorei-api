<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SaleOutput extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
           'sale_id' => $this->id,
           'amount' => $this->amount,
           'cancelled_at' => $this->when($this->cancelled_at,
               Carbon::parse($this->cancelled_at)->format('Y-m-d H:i:s'),
               null),
           'products' => ProductOutput::collection($this->products)
       ];
    }
}
