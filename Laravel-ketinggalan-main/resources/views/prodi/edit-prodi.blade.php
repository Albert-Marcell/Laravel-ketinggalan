<x-layout title="Edit Prodi">

    {{-- ─── Breadcrumb ──────────────────────────────────────────────── --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size: 0.85rem;">
            <li class="breadcrumb-item"><a href="{{ route('prodi.index') }}">Prodi</a></li>
            <li class="breadcrumb-item active">Edit Prodi</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border shadow-sm">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h1 class="h5 fw-semibold mb-0">✏️ Edit Program Studi</h1>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('prodi.update', $prodi->id) }}" method="POST" enctype="multipart/form-data" id="formEditProdi">
                        @csrf
                        @method('PUT')

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
                                    <option value="{{ $item->id }}"
                                        {{ old('fakultas_id', $prodi->fakultas_id) == $item->id ? 'selected' : '' }}>
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
                                value="{{ old('nama_prodi', $prodi->nama_prodi) }}"
                                placeholder="Contoh: Teknik Informatika"
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
                                value="{{ old('nama_kaprodi', $prodi->nama_kaprodi) }}"
                                placeholder="Contoh: Dr. Budi Santoso, M.Kom."
                            >
                            <x-form-error field="nama_kaprodi" />
                        </div>

                        {{-- Foto Kaprodi (Opsional saat edit) --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">Foto Kaprodi</label>

                            @if ($prodi->foto_kaprodi)
                                {{-- Foto saat ini --}}
                                <div class="mb-3 p-3 rounded border" style="background: rgba(0,0,0,0.02);">
                                    <p class="text-muted mb-2" style="font-size: 0.8rem;">📸 Foto saat ini:</p>
                                    <div class="d-flex align-items-end gap-3">
                                        <img src="{{ asset('storage/' . $prodi->foto_kaprodi) }}"
                                             style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #e5e7eb;"
                                             class="img-fluid"
                                             alt="Foto Kaprodi Saat Ini">
                                        <button type="button"
                                                class="btn btn-outline-danger btn-sm"
                                                id="btnHapusFoto"
                                                onclick="document.getElementById('deletePhotoForm').submit()">
                                            🗑️ Hapus Foto
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <input
                                type="file"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                class="form-control @error('foto_kaprodi') is-invalid @enderror"
                                id="foto_kaprodi"
                                name="foto_kaprodi"
                            >
                            <div class="form-text text-muted">
                                Opsional — kosongkan jika tidak ingin mengganti foto.
                                Format: JPG, PNG, GIF, WEBP. Maks. 2 MB.
                            </div>
                            <x-form-error field="foto_kaprodi" />

                            {{-- Preview baru --}}
                            <div id="previewWrapper" class="mt-2" style="display: none;">
                                <small class="text-muted">Preview foto baru:</small><br>
                                <img id="previewImg" src="" alt="Preview" style="max-width: 100px; border-radius: 8px; border: 2px solid #3b82f6; margin-top: 4px;">
                            </div>
                        </div>

                        {{-- Audit Info --}}
                        <div class="mb-4 p-3 rounded" style="background: rgba(0,0,0,0.03); font-size: 0.8rem;">
                            <span class="text-muted">
                                📅 Dibuat: {{ $prodi->created_at->format('d M Y, H:i') }}
                                &nbsp;·&nbsp;
                                🔄 Diperbarui: {{ $prodi->updated_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="btnUpdateProdi">
                                💾 Perbarui
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

    {{-- Form tersembunyi untuk hapus foto --}}
    <form action="{{ route('prodi.delete-photo', $prodi->id) }}" method="POST" id="deletePhotoForm">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Preview foto baru sebelum upload
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
