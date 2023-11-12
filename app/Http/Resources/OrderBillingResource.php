<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderBillingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'first_name'=> $this->first_name,
            'last_name'=> $this->last_name,
            'phone'=> $this->phone,
            'address'=> $this->order_address->address,
            'email'=> $this->email,
        ];
    }
}
