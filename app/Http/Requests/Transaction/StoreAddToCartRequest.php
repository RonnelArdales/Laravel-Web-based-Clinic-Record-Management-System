<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname'=>'required',
            'servicecode'=>'required',
            'price'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required'=>'Please select user',
            'servicecode.required'=>'Service is required',
            'price.required'=>'Price is required',
        ];
    }
}
