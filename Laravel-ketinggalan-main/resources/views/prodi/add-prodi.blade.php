<x-layout title="Tambah Prodi">

    {{-- ─── Breadcrumb ──────────────────────────────────────────────── --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size: 0.85rem;">
            <li class="breadcrumb-item"><a href="{{ route('prodi.index') }}">Prodi</a></li>
            <li class="breadcrumb-item active">Tambah Prodi</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border shadow-sm">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h1 class="h5 fw-semibold mb-0">📚 Tambah Program Studi Baru</h1>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('prodi.store') }}" method="POST" enctype="multipart/form-data" id="formTambahProdi">
                        @csrf

                        {{-- Pilih Fakultas --}}
                        <div class="mb-4">
                            <label for="fakultas_id" class="form-label fw-medium">
                                Fakultas <span class="text-danger">*</span>
                            </label>
                            <select
                                class="form-select @error('fakultas_id') is-invalid @enderror"
                                id="fakultas_id"
                                name="fakultas_id"
                            >
                                <option value="">— Pilih Fakultas —</option>
                                @foreach ($fakultas as $item)
                                    <option value="{{ $item->id }}" {{ old('fakultas_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-form-error field="fakultas_id" />
                        </div>

                        {{-- Nama Prodi --}}
                        <div class="mb-4">
                            <label for="nama_prodi" class="form-label fw-medium">
                                Nama Prodi <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control @error('nama_prodi') is-invalid @enderror"
                                id="nama_prodi"
                                name="nama_prodi"
                                value="{{ old('nama_prodi') }}"
                                placeholder="Contoh: Teknik Informatika"
                                autocomplete="off"
                            >
                            <x-form-error field="nama_prodi" />
                        </div>

                        {{-- Nama Kaprodi --}}
                        <div class="mb-4">
                            <label for="nama_kaprodi" class="form-label fw-medium">
                                Nama Kaprodi <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control @error('nama_kaprodi') is-invalid @enderror"
                                id="nama_kaprodi"
                                name="nama_kaprodi"
                                value="{{ old('nama_kaprodi') }}"
                                placeholder="Contoh: Dr. Budi Santoso, M.Kom."
                                autocomplete="off"
                            >
                            <x-form-error field="nama_kaprodi" />
                        </div>

                        {{-- Foto Kaprodi --}}
                        <div class="mb-4">
                            <label for="foto_kaprodi" class="form-label fw-medium">
                                Foto Kaprodi <span class="text-danger">*</span>
                            </label>
                            <input
                                type="file"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                class="form-control @error('foto_kaprodi') is-invalid @enderror"
                                id="foto_kaprodi"
                                name="foto_kaprodi"
                            >
                            <div class="form-text text-muted">Format: JPG, PNG, GIF, WEBP. Maks. 2 MB.</div>
                            <x-form-error field="foto_kaprodi" />

                            {{-- Preview Foto sebelum upload --}}
                            <div id="previewWrapper" class="mt-2" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" style="max-width: 120px; border-radius: 8px; border: 2px solid #e5e7eb;">
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="btnSimpanProdi">
                                💾 Simpan
                            </button>
                            <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview foto sebelum upload
        document.getElementById('foto_kaprodi').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    document.getElementById('previewImg').src = ev.target.result;
                    document.getElementById('previewWrapper').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</x-layout>