<?php

namespace App\Http\Resources;

use App\Enums\OrderStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->username,
            'invoice_no' => $this->invoice_no,
            'shop_id' => $this->shop->username,
            'payment_type' => $this->payment_type,
            'payment_option_id' => $this->payment_option->name,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
            'delivery_fee' => $this->delivery_fee,
            'payable' => $this->payable,
            'paid' => $this->paid,
            'due' => $this->due,
            'status' => OrderStatus::from($this->status)->title(),
            'billing_address' => OrderBillingResource::make($this->orderDetail),
            'user_details' => UserResource::make($this->user),
            'product_details' => OrderItemResource::collection($this->items),
            'created_at' => $this->created_at->format('d-m-Y')
        ];
    }
}
