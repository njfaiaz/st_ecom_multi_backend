<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'total_price' => ($this->price * $this->quantity),
            'product_name' => $this->product->name,
        ];
    }
}
