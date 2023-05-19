<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccreditationRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:255', 'unique:accreditations,code'],
            'grade' => ['required', 'string'],
            'due_date' => ['required', 'date', 'after:today', 'after:release_date'],
            'release_date' => ['required', 'date', 'before:due_date'],
            'unit_id' => ['required', 'exists:units,id', 'uuid'],
            'decree' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'decree_number' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Kode harus di isi',
            'code.unique' => 'Kode sudah dimiliki unit lain',
            'code.max' => 'Kode maksimal 255 karakter',
            'grade.string' => 'Hasil Akreditasi harus isian yang valid',
            'grade.required' => 'Hasil Akreditasi harus di isi',
            'due_date.required' => 'Masa berlaku harus di isi',
            'due_date.date' => 'Masa berlaku harus format tanggal',
            'due_date.after' => 'Masa berlaku harus melebihi tanggal penerbitan surat dan hari ini',
            'release_date.required' => 'Tanggal penerbitan harus di isi',
            'release_date.date' => 'Input tanggal penerbitan harus dalam format tanggl',
            'release_date.before' => 'Input tanggal penerbitan harus sebelum masa berlaku',
            'unit_id.required' => 'Unit harus di isi',
            'unit_id.exists' => 'Unit tidak ditemukan',
            'unit_id.uuid' => 'Unit harus berupa UUID',
            'decree.required' => 'SK Akreditasi harus di isi',
            'decree.file' => 'Input harus pdf',
            'decree.mimes' => 'Input harus pdf',
            'decree.max' => 'Maksimal ukuran file 2048KB',
            'decree_number.required' => 'Nomor SK harus di isi',
        ];
    }
}
