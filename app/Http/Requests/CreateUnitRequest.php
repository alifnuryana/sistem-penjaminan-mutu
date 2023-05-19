<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', 'unique:units,code'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:units,email', 'ends_with:@widyatama.ac.id'],
            'degree' => ['required', 'string', 'max:5'],
            'decree' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'decree_number' => ['required', 'string', 'max:50', 'unique:decrees,name'],
            'release_date' => ['required', 'date', 'before:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode harus di isi',
            'code.unique' => 'Kode sudah dimiliki unit lain',
            'code.max' => 'Kode maksimal 50 karakter',
            'name.required' => 'Nama harus di isi',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email harus di isi',
            'email.email' => 'Email harus format email',
            'email.max' => 'Email maksimal 100 karakter',
            'email.unique' => 'Email sudah dimiliki unit lain',
            'email.ends_with' => 'Email harus akun widyatama',
            'degree.required' => 'Jenjang harus di isi',
            'degree.max' => 'Jenjang maksimal 5 karakter',
            'decree.required' => 'SK Akreditasi harus di isi',
            'decree.file' => 'Input harus pdf',
            'decree.mimes' => 'Input harus pdf',
            'decree.max' => 'Maksimal ukuran file 2048KB',
            'decree_number.required' => 'Nomor SK harus di isi',
            'decree_number.max' => 'Nomor SK maksimal 50 karakter',
            'decree_number.unique' => 'Nomor SK sudah dimiliki unit lain',
            'release_date.required' => 'Tanggal penerbitan harus di isi',
            'release_date.date' => 'Input tanggal penerbitan harus dalam format tanggal',
            'release_date.before' => 'Input tanggal penerbitan harus sebelum hari ini',
        ];
    }
}
