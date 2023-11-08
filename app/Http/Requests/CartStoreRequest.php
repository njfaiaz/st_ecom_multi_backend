<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ];
    }

    public function failedValidation(Validator $validator){
        validationError($validator);
    }
}
