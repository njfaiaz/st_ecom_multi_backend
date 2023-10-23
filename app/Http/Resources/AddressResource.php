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
            'city_id' => CityResource::make($this->whenLoaded('city')),
            'user_id' => UserResource::make($this->whenLoaded('user')),
            'address' => $this->address,
            'phone' => $this->phone,
            'is_default' => AddressTypes::from($this->is_default)->title(),
        ];
    }
}
