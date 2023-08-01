<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
    public function rules($user)
    {
        $password = request()->input('password');

        $rules = [  "first_name" => ['required'],
                    "last_name" => ['required'],
                    "birthday" => ['required'],
                    "age" => ['required'],
                    "address" => ['required'],
                    "gender" => ['required'],
                    "mobile_number" => ['required', Rule::unique('users', 'mobileno')->ignore($user['id']),],
                    "email" => ['required', 'email',  Rule::unique('users', 'email')->ignore($user['id']), ],
                    "password" => ['confirmed'],
                    "status" => ['required']
                ];

        if(Auth::user()->usertype == "admin"){
            $rules['usertype'] = ['required'];
        }
 
        return $rules;
    }

    public function messages(){
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
                    'password.confirmed' => 'Password did not match',
                    'usertype.required' => 'Usertype is required',
                    'status.required' => 'status is required',
                    'password.confirmed' => 'Password did not match',
        ];
    }
}
