<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'discount' => $this->regular_price - $this->sale_price,
            'image' => asset($this->image)
        ];
    }
}
