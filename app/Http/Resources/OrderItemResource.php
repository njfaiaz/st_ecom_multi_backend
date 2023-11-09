<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        $totalPrice = $this->sale_price * $this->quantity;

        return [
            'order_id' => $this->order_id,
            'product_name' => $this->product->name,
            'product_slug' => $this->product->slug,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'total_discount' => ($this->regular_price * $this->quantity) - ($totalPrice),
            'image' => getImageUrl($this->product->image),
            'variants' => OrderVariantResource::collection($this->variants),
            'total_price' => $this->getTotalPriceFromVariants($totalPrice, $this->variants)
        ];
    }

    private function getTotalPriceFromVariants($totalPrice, $variants=null)
    {
        if(is_null($variants)) return $totalPrice;

        foreach($variants as $variant) {
            $totalPrice += $variant->additional_price;
        }

        return $totalPrice;
    }
}
