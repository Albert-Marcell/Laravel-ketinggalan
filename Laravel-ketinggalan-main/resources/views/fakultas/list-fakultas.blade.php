<x-layout title="List Fakultas">

    {{-- ─── Header ──────────────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h4 fw-semibold mb-1">🏛️ Daftar Fakultas</h1>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                Kelola data seluruh Fakultas di sistem
            </p>
        </div>
        <a href="{{ route('fakultas.create') }}" class="btn btn-primary btn-sm" id="btnTambahFakultas">
            + Tambah Fakultas
        </a>
    </div>

    {{-- ─── Toolbar: Search ─────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <x-search-form
            placeholder="Cari nama fakultas atau dekan..."
            :action="route('fakultas.index')"
        />
        <x-pagination-info :paginator="$fakultas" />
    </div>

    {{-- ─── Tabel ───────────────────────────────────────────────────── --}}
    <div class="card border shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Nama Fakultas</th>
                        <th>Nama Dekan</th>
                        <th class="text-center" style="width: 90px;">Jumlah Prodi</th>
                        <th class="text-muted" style="font-size: 0.8rem; width: 130px;">Dibuat</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fakultas as $item)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($fakultas->currentPage() - 1) * $fakultas->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item->name }}</div>
                            </td>
                            <td class="text-muted">{{ $item->dekan }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill">
                                    {{ $item->prodis_count ?? 0 }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('fakultas.show', $item->id) }}"
                                       class="btn btn-outline-secondary btn-sm"
                                       id="btnDetailFakultas{{ $item->id }}">
                                        Detail
                                    </a>
                                    <a href="{{ route('fakultas.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm"
                                       id="btnEditFakultas{{ $item->id }}">
                                        Edit
                                    </a>
                                    <form action="{{ route('fakultas.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                id="btnHapusFakultas{{ $item->id }}"
                                                onclick="return confirm('Yakin ingin menghapus Fakultas \"{{ $item->name }}\"?\n\nFakultas yang masih memiliki Prodi tidak dapat dihapus.')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <div style="font-size: 2rem; margin-bottom: 8px;">🏛️</div>
                                    @if ($keyword)
                                        Tidak ada hasil untuk "<strong>{{ $keyword }}</strong>".
                                        <br><a href="{{ route('fakultas.index') }}" class="text-primary">Tampilkan semua</a>
                                    @else
                                        Belum ada data Fakultas.
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
    @if ($fakultas->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $fakultas->links() }}
        </div>
    @endif

</x-layout>
