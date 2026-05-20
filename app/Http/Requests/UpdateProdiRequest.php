<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProdiRequest extends FormRequest
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
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'nama_kaprodi' => 'required|string|max:255',
            'foto_kaprodi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
