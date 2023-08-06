<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => ['required'],
            "mname" => [''],
            "last_name" => ['required',],
            "birthday" => ['required'],
            "age" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobile_number" => ['required', Rule::unique('users', 'mobileno') ],
            "email" => ['required', 'email', Rule::unique('users', 'email') ],
            "username" => ['required', 'regex:/\w*$/', 'min:8', Rule::unique('users', 'username')],
            "password" => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'birthday.required' => 'Birthday is required',
            'age.required' => 'Age is required',
            'address.required' => 'Address is required',
            'gender.required' => 'gender is required',
            'mobile_number.required' => 'Mobile number is required',
            'email.required' => ' Email is required',
            'username.required' => 'Username name is required',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password did not match',
        ];
    }
}
