<?php

namespace App\Http\Requests\Backend\Rumah;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RumahUpdateRequest extends FormRequest
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
            'nomor_rumah' => ['required', 'numeric', 'unique:rumahs,nomor_rumah'],
            'status_rumah' => ['required', Rule::in(['Kontrak', 'Tetap'])]
        ];
    }
}
