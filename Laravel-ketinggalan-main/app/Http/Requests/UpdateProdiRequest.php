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
     * Foto Kaprodi bersifat OPSIONAL saat update.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fakultas_id'  => 'required|exists:fakultas,id',
            'nama_prodi'   => 'required|string|max:255',
            'nama_kaprodi' => 'required|string|max:255',
            // nullable: foto tidak wajib diisi saat edit (bisa tetap pakai foto lama)
            'foto_kaprodi' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    /**
     * Custom validation messages in Indonesian.
     */
    public function messages(): array
    {
        return [
            'fakultas_id.required'  => 'Fakultas wajib dipilih.',
            'fakultas_id.exists'    => 'Fakultas yang dipilih tidak valid.',
            'nama_prodi.required'   => 'Nama Prodi wajib diisi.',
            'nama_prodi.max'        => 'Nama Prodi maksimal 255 karakter.',
            'nama_kaprodi.required' => 'Nama Kaprodi wajib diisi.',
            'nama_kaprodi.max'      => 'Nama Kaprodi maksimal 255 karakter.',
            'foto_kaprodi.image'    => 'File harus berupa gambar.',
            'foto_kaprodi.mimes'    => 'Format gambar harus: jpeg, png, jpg, gif, atau webp.',
            'foto_kaprodi.max'      => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
