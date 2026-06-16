<x-layout title="Detail Prodi">

    {{-- ─── Breadcrumb ──────────────────────────────────────────────── --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size: 0.85rem;">
            <li class="breadcrumb-item"><a href="{{ route('prodi.index') }}">Prodi</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border shadow-sm">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h1 class="h5 fw-semibold mb-0">📋 Detail Program Studi</h1>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">

                        {{-- ── Foto Kaprodi ──────────────────────────────── --}}
                        <div class="col-md-4 text-center">
                            @if ($prodi->foto_kaprodi)
                                <img src="{{ asset('storage/' . $prodi->foto_kaprodi) }}"
                                     style="width: 160px; height: 160px; object-fit: cover; border-radius: 16px; border: 3px solid #e5e7eb; box-shadow: 0 4px 15px rgba(0,0,0,0.1);"
                                     class="img-fluid"
                                     alt="Foto {{ $prodi->nama_kaprodi }}">
                                <p class="text-muted mt-2 mb-0" style="font-size: 0.8rem;">Foto Kaprodi</p>
                            @else
                                <div style="width: 160px; height: 160px; border-radius: 16px; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 3rem;">
                                    👤
                                </div>
                                <p class="text-muted mt-2 mb-0" style="font-size: 0.8rem;">Belum ada foto</p>
                            @endif
                        </div>

                        {{-- ── Info Detail ────────────────────────────────── --}}
                        <div class="col-md-8">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 140px; font-size: 0.875rem;" class="text-muted fw-medium ps-0">Nama Prodi</th>
                                        <td>
                                            <span class="fw-semibold fs-6">{{ $prodi->nama_prodi }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">Nama Kaprodi</th>
                                        <td>{{ $prodi->nama_kaprodi }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">Fakultas</th>
                                        <td>
                                            <span class="badge" style="background: rgba(59,130,246,0.1); color: #1d4ed8; font-weight: 500;">
                                                🏛️ {{ $prodi->fakultas->name ?? 'Tidak ditemukan' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">Dekan Fakultas</th>
                                        <td class="text-muted">{{ $prodi->fakultas->dekan ?? '—' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr class="my-1" style="border-color: rgba(0,0,0,0.06);"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">📅 Dibuat</th>
                                        <td>
                                            <small class="text-muted">{{ $prodi->created_at->format('d M Y, H:i') }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">🔄 Diperbarui</th>
                                        <td>
                                            <small class="text-muted">{{ $prodi->updated_at->format('d M Y, H:i') }}</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex gap-2 mt-3 pt-3 border-top">
                                <a href="{{ route('prodi.edit', $prodi->id) }}"
                                   class="btn btn-warning btn-sm"
                                   id="btnEditDetail">
                                    ✏️ Edit
                                </a>
                                <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary btn-sm">
                                    ← Kembali
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
