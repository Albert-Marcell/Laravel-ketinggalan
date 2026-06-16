<x-layout title="Edit Fakultas">

    {{-- ─── Breadcrumb ──────────────────────────────────────────────── --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size: 0.85rem;">
            <li class="breadcrumb-item"><a href="{{ route('fakultas.index') }}">Fakultas</a></li>
            <li class="breadcrumb-item active">Edit Fakultas</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border shadow-sm">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h1 class="h5 fw-semibold mb-0">✏️ Edit Fakultas</h1>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('fakultas.update', $fakultas->id) }}" method="POST" id="formEditFakultas">
                        @csrf
                        @method('PUT')

                        {{-- Nama Fakultas --}}
                        <div class="mb-4">
                            <label for="name_fakultas" class="form-label fw-medium">
                                Nama Fakultas <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control @error('name_fakultas') is-invalid @enderror"
                                id="name_fakultas"
                                name="name_fakultas"
                                value="{{ old('name_fakultas', $fakultas->name) }}"
                                placeholder="Contoh: Fakultas Teknik"
                            >
                            <x-form-error field="name_fakultas" />
                        </div>

                        {{-- Nama Dekan --}}
                        <div class="mb-4">
                            <label for="name_dekan" class="form-label fw-medium">
                                Nama Dekan <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control @error('name_dekan') is-invalid @enderror"
                                id="name_dekan"
                                name="name_dekan"
                                value="{{ old('name_dekan', $fakultas->dekan) }}"
                                placeholder="Contoh: Prof. Dr. Ahmad, M.T."
                            >
                            <x-form-error field="name_dekan" />
                        </div>

                        {{-- Audit Info --}}
                        <div class="mb-4 p-3 rounded" style="background: rgba(0,0,0,0.03); font-size: 0.8rem;">
                            <div class="text-muted">
                                📅 Dibuat: {{ $fakultas->created_at->format('d M Y, H:i') }}
                                &nbsp;·&nbsp;
                                🔄 Diperbarui: {{ $fakultas->updated_at->format('d M Y, H:i') }}
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="btnUpdateFakultas">
                                💾 Perbarui
                            </button>
                            <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-layout>