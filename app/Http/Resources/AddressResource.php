<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\AddressTypes;

class AddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->username,
            'city_id' => $this->city->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'address_type' => AddressTypes::from($this->address_type)->title(),
        ];
    }
}
