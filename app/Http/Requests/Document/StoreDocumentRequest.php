<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'fullname'=>'required',
            'pdf' => 'mimes:pdf|max:3000|required',
            'doc_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pdf.mimes'=>'the file must be a pdf',
            'pdf.required' => 'pdf file is required',
            'fullname.required' => 'Please select an appointment',
            'doc_type.required' => 'File description is required',
        ];
    }
}
