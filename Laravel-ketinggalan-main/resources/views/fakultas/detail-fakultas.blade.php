<x-layout title="Detail Fakultas">

    {{-- ─── Breadcrumb ──────────────────────────────────────────────── --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size: 0.85rem;">
            <li class="breadcrumb-item"><a href="{{ route('fakultas.index') }}">Fakultas</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>

    <div class="row g-4">
        {{-- ── Info Fakultas ──────────────────────────────────────────── --}}
        <div class="col-lg-5">
            <div class="card border shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h1 class="h5 fw-semibold mb-0">🏛️ Informasi Fakultas</h1>
                </div>
                <div class="card-body p-4">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th style="width: 130px; font-size: 0.875rem;" class="text-muted fw-medium ps-0">Nama Fakultas</th>
                                <td class="fw-semibold">{{ $fakulta->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">Nama Dekan</th>
                                <td>{{ $fakulta->dekan }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">Jumlah Prodi</th>
                                <td>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $fakulta->prodis->count() }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">Dibuat</th>
                                <td><small class="text-muted">{{ $fakulta->created_at->format('d M Y, H:i') }}</small></td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-medium ps-0" style="font-size: 0.875rem;">Diperbarui</th>
                                <td><small class="text-muted">{{ $fakulta->updated_at->format('d M Y, H:i') }}</small></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex gap-2 mt-3 pt-3 border-top">
                        <a href="{{ route('fakultas.edit', $fakulta->id) }}" class="btn btn-warning btn-sm" id="btnEditDetail">
                            ✏️ Edit
                        </a>
                        <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary btn-sm">
                            ← Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Daftar Prodi ───────────────────────────────────────────── --}}
        <div class="col-lg-7">
            <div class="card border shadow-sm">
                <div class="card-header bg-transparent border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h2 class="h5 fw-semibold mb-0">📚 Program Studi</h2>
                    <a href="{{ route('prodi.create') }}" class="btn btn-primary btn-sm">+ Tambah Prodi</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 45px;">No</th>
                                <th>Nama Prodi</th>
                                <th>Nama Kaprodi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fakulta->prodis as $prodi)
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $prodi->nama_prodi }}</td>
                                    <td class="text-muted" style="font-size: 0.875rem;">{{ $prodi->nama_kaprodi }}</td>
                                    <td>
                                        <a href="{{ route('prodi.show', $prodi->id) }}"
                                           class="btn btn-outline-secondary btn-sm"
                                           id="btnDetailProdi{{ $prodi->id }}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <div>📭 Belum ada Prodi untuk fakultas ini.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layout>