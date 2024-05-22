<?php

namespace App\Http\Requests\Backend\PenghuniRumah;

use Illuminate\Foundation\Http\FormRequest;

class PenghuniRumahCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'penghuni_id' => ['required', 'numeric' ,'max:200'],
            'rumah_id' => ['required', 'numeric', 'max:200'],
            'tanggal_mulai_menempati' => ['required','date'],
            'tanggal_selesai_menempati' => ['required', 'date'],
        ];
    }
}
