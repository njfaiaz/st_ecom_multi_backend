<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class OrderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|numeric|digits_between:1,15',
            'email' => 'nullable|email',
            'payment_option_id' => 'required|exists:payment_options,id',
            'delivery_place' => 'required|boolean',
        ];
    }
    public function failedValidation(Validator $validator){
        validationError($validator);
    }
}
