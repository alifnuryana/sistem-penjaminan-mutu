<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccreditationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules() : array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:accreditations,code'],
            'grade' => ['required', 'string'],
            'due_date' => ['required', 'date', 'after:today'],
            'unit_id' => ['required', 'exists:units,id', 'uuid'],
            'decree' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'decree_number' => ['required', 'string', 'max:255'],
        ];
    }

    /* TODO : tambahkan fungsi messages untuk validation */
}
