<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
            'role' => $this->role,
            'address' => AddressResource::collection($this->addresses ?? []),
        ];
    }
}
