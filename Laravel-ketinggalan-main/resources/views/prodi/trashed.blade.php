<x-layout title="Arsip Prodi (Soft Delete)">

    {{-- ─── Header ──────────────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h4 fw-semibold mb-1">🗑️ Arsip Prodi</h1>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                Data Prodi yang telah dihapus — dapat dipulihkan atau dihapus permanen
            </p>
        </div>
        <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary btn-sm" id="btnKembaliProdi">
            ← Kembali ke Prodi
        </a>
    </div>

    {{-- ─── Toolbar: Search ─────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <x-search-form
            placeholder="Cari di arsip..."
            :action="route('prodi.trashed')"
        />
        <x-pagination-info :paginator="$prodi" />
    </div>

    {{-- ─── Info Banner ─────────────────────────────────────────────── --}}
    <div class="alert mb-4" style="background: #fffbeb; border: 1px solid #fcd34d; border-radius: 10px; font-size: 0.875rem; color: #92400e;">
        <strong>⚠️ Informasi:</strong>
        Data di halaman ini telah di-<em>soft delete</em>. Klik <strong>Restore</strong> untuk memulihkan,
        atau <strong>Hapus Permanen</strong> untuk menghapus selamanya (termasuk foto).
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
                        <th>Fakultas</th>
                        <th style="width: 130px;">Dihapus Pada</th>
                        <th style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prodi as $item)
                        <tr style="opacity: 0.85;">
                            <td class="text-center text-muted">
                                {{ ($prodi->currentPage() - 1) * $prodi->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="fw-semibold text-muted" style="text-decoration: line-through;">
                                    {{ $item->nama_prodi }}
                                </div>
                            </td>
                            <td class="text-muted" style="font-size: 0.875rem;">{{ $item->nama_kaprodi }}</td>
                            <td>
                                <small class="text-muted">{{ $item->fakultas->name ?? '—' }}</small>
                            </td>
                            <td>
                                <small class="text-danger">
                                    {{ $item->deleted_at->format('d M Y, H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    {{-- Restore --}}
                                    <form action="{{ route('prodi.restore', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-success btn-sm"
                                                id="btnRestore{{ $item->id }}"
                                                onclick="return confirm('Pulihkan Prodi \"{{ $item->nama_prodi }}\"?')">
                                            ♻️ Restore
                                        </button>
                                    </form>

                                    {{-- Hapus Permanen --}}
                                    <form action="{{ route('prodi.force-delete', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                id="btnForceDelete{{ $item->id }}"
                                                onclick="return confirm('⚠️ HAPUS PERMANEN Prodi \"{{ $item->nama_prodi }}\"?\n\nData dan foto akan dihapus selamanya dan TIDAK bisa dikembalikan!')">
                                            🗑️ Hapus Permanen
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <div style="font-size: 2rem; margin-bottom: 8px;">✨</div>
                                    @if ($keyword)
                                        Tidak ada hasil untuk "<strong>{{ $keyword }}</strong>".
                                        <br><a href="{{ route('prodi.trashed') }}" class="text-primary">Tampilkan semua</a>
                                    @else
                                        Tidak ada data di arsip. Semua Prodi aktif! 🎉
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
