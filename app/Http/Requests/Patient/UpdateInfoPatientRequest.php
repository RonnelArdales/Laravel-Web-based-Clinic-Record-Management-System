<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateInfoPatientRequest extends FormRequest
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
            "fname" => ['required', 'min:4'],
            "mname" => '',
            "lname" => ['required', 'min:4'],
            "birthday" => ['required'],
            "address" => ['required', 'min:4'],
            "gender" => ['required'],
            "mobileno" => ['required', Rule::unique('users', 'mobileno')->ignore(Auth::user()->id), ],
            "email" =>  ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'old_password' => "",
            "password" => "",
            "password_confirmation" => "",
        ];
    }
}
