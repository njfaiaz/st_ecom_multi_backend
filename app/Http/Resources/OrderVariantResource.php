<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderVariantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'variant_id' => $this->id,
            'variant_name' => $this->name,
            'variant_value' => $this->value,
            'variant_additional_price' => $this->additional_price,
        ];
    }
}
