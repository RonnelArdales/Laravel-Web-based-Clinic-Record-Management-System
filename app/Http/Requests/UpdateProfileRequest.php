<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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

        $rules = [
            "first_name" => ['required'],
            "mname" => [''],
            "last_name" => ['required',],
            "birthday" => ['required'],
            "age" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobileno" => ['required', Rule::unique('users', 'mobileno')->ignore(Auth::user()->id), ],
            "email" => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id), 
                        // function ($attribute, $value, $fail) {
                        //     if ($value !== auth()->user()->email) {
                        //         $fail('The '.$attribute.' must match your current email.');
                        //     }
                        // },
                    ],
        ];

        return $rules;
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
            'mobileno.required' => 'Mobile number is required',
            'email.required' => ' Email is required',
        ];
    }
}
