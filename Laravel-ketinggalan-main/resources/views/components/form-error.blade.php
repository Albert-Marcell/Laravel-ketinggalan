{{--
    Komponen: x-form-error
    Menampilkan pesan error validasi untuk field tertentu.
    
    Props:
        - field (string): nama field yang ingin ditampilkan error-nya
    
    Penggunaan: <x-form-error field="nama_prodi" />
--}}

@props(['field'])

@error($field)
    <div class="form-field-error">
        <span class="form-field-error__icon">⚠</span>
        {{ $message }}
    </div>
@enderror

<style>
.form-field-error {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #dc2626;
    font-size: 0.8rem;
    margin-top: 4px;
    font-weight: 500;
}

.form-field-error__icon {
    font-size: 0.75rem;
    flex-shrink: 0;
}

[data-theme="dark"] .form-field-error {
    color: #fca5a5;
}
</style>
