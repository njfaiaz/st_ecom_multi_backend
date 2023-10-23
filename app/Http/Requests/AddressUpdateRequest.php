<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'city_id' => ['required','string'],
            'address' => ['required','string'],
            'phone' => ['required','numeric'],
            'is_default' => ['required','numeric'],
        ];
    }
}
