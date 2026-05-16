<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdiRequest extends FormRequest
{
    /** user is authorized to make this request.
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
            'fakultas_id' => 'required',
            'nama_prodi' => 'required',
            'nama_kaprodi' => 'required',
            'foto_kaprodi' => 'required',
        ];
    }
}
