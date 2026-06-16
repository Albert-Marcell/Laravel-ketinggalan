<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFakultasRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_fakultas' => 'required|string|max:255',
            'name_dekan'    => 'required|string|max:255',
        ];
    }

    /**
     * Custom validation messages in Indonesian.
     */
    public function messages(): array
    {
        return [
            'name_fakultas.required' => 'Nama Fakultas wajib diisi.',
            'name_fakultas.max'      => 'Nama Fakultas maksimal 255 karakter.',
            'name_dekan.required'    => 'Nama Dekan wajib diisi.',
            'name_dekan.max'         => 'Nama Dekan maksimal 255 karakter.',
        ];
    }
}
