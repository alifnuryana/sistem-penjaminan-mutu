<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUnitRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:50', 'unique:units,code'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:units,email', 'ends_with:@widyatama.ac.id'],
            'degree' => ['required', 'string', 'max:5'],
            'decree' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'decree_number' => ['required', 'string', 'max:50'],
        ];
    }

    // TODO : tambahkan fungsi messages() untuk menampilkan pesan error sesuai dengan kostumisasi
}
