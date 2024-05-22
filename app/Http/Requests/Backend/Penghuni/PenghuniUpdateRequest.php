<?php

namespace App\Http\Requests\Backend\Penghuni;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenghuniUpdateRequest extends FormRequest
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
            // 'nama_lengkap' => ['required', 'string' ,'max:200'],
            // 'status_penghuni' => ['required', Rule::in(['Kontrak', 'Tetap'])],
            // 'nomor_telepon' => ['required','max:100'],
            // 'sudah_menikah' => ['required', 'boolean'],
        ];
    }
}
