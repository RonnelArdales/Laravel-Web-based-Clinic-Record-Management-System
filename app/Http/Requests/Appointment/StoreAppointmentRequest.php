<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'userid' => 'required',
            'date' => 'required',
            'time' => 'required',
            'modeofpayment' => 'required',
        ];
    
        return $rules;
    }

    public function messages(){
        return [
            'userid.required'=>'Patient information is required',
            'date.required' => 'Appointment date is required',
            'time.required' => 'Appointment time is required',
            'modeofpayment.required' => 'Mode of payment is required', 
        ];
    }
}
