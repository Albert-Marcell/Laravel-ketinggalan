<x-layout title="List Prodi">

    {{-- ─── Header ──────────────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h4 fw-semibold mb-1">📚 Daftar Program Studi</h1>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">Kelola data seluruh Prodi beserta Kaprodi-nya</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('prodi.trashed') }}" class="btn btn-outline-secondary btn-sm" id="btnArsip">
                🗑️ Arsip
            </a>
            <a href="{{ route('prodi.create') }}" class="btn btn-primary btn-sm" id="btnTambahProdi">
                + Tambah Prodi
            </a>
        </div>
    </div>

    {{-- ─── Toolbar: Search & Filter ────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <form method="GET" action="{{ route('prodi.index') }}" class="d-flex gap-2 align-items-center flex-wrap" id="filterForm">
            {{-- Search --}}
            <div style="position:relative;">
                <span style="position:absolute; left:10px; top:50%; transform:translateY(-50%); font-size:0.85rem;">🔍</span>
                <input
                    type="text"
                    name="search"
                    id="searchProdi"
                    class="form-control form-control-sm"
                    style="padding-left: 30px; min-width: 200px; border-radius: 8px;"
                    placeholder="Cari prodi atau kaprodi..."
                    value="{{ $keyword }}"
                    autocomplete="off"
                >
            </div>

            {{-- Filter Fakultas --}}
            <select name="fakultas_id" id="filterFakultas" class="form-select form-select-sm" style="min-width: 180px; border-radius: 8px;">
                <option value="">Semua Fakultas</option>
                @foreach ($fakultasList as $fak)
                    <option value="{{ $fak->id }}" {{ $fakultasId == $fak->id ? 'selected' : '' }}>
                        {{ $fak->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary btn-sm" id="btnCariProdi">Cari</button>

            @if ($keyword || $fakultasId)
                <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary btn-sm">
                    Reset
                </a>
            @endif
        </form>

        <x-pagination-info :paginator="$prodi" />
    </div>

    {{-- ─── Tabel ───────────────────────────────────────────────────── --}}
    <div class="card border shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Nama Prodi</th>
                        <th>Kaprodi</th>
                        <th class="text-center" style="width: 90px;">Foto</th>
                        <th>Fakultas</th>
                        <th class="text-muted" style="font-size: 0.8rem; width: 120px;">Dibuat</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prodi as $item)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($prodi->currentPage() - 1) * $prodi->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item->nama_prodi }}</div>
                            </td>
                            <td class="text-muted" style="font-size: 0.875rem;">{{ $item->nama_kaprodi }}</td>
                            <td class="text-center">
                                @if ($item->foto_kaprodi)
                                    <img src="{{ asset('storage/' . $item->foto_kaprodi) }}"
                                         style="width: 44px; height: 44px; object-fit: cover; border-radius: 50%; border: 2px solid #e5e7eb;"
                                         alt="Foto {{ $item->nama_kaprodi }}"
                                         loading="lazy">
                                @else
                                    <div style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 0.7rem; color: #6366f1;">
                                        {{ substr($item->nama_kaprodi, 0, 1) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge" style="background: rgba(59,130,246,0.1); color: #1d4ed8; font-weight: 500; font-size: 0.75rem;">
                                    {{ $item->fakultas->name ?? 'Tidak ada' }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('prodi.show', $item->id) }}"
                                       class="btn btn-outline-secondary btn-sm"
                                       id="btnDetailProdi{{ $item->id }}">
                                        Detail
                                    </a>
                                    <a href="{{ route('prodi.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm"
                                       id="btnEditProdi{{ $item->id }}">
                                        Edit
                                    </a>
                                    <form action="{{ route('prodi.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                id="btnHapusProdi{{ $item->id }}"
                                                onclick="return confirm('Yakin ingin menghapus Prodi \"{{ $item->nama_prodi }}\"?\n\nData akan dipindah ke Arsip dan dapat dipulihkan.')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <div style="font-size: 2rem; margin-bottom: 8px;">📭</div>
                                    @if ($keyword || $fakultasId)
                                        Tidak ada hasil untuk filter yang dipilih.
                                        <br><a href="{{ route('prodi.index') }}" class="text-primary">Tampilkan semua</a>
                                    @else
                                        Belum ada data Prodi.
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ─── Pagination ──────────────────────────────────────────────── --}}
    @if ($prodi->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $prodi->links() }}
        </div>
    @endif

</x-layout>