<x-layout title="List Fakultas">
<style>
    /* Tabel mengikuti tema */
[data-theme="dark"] .table {
    --bs-table-color: #e0e0e0;
    --bs-table-bg: transparent;
    --bs-table-border-color: #2e2e2e;
    --bs-table-hover-bg: rgba(255, 255, 255, 0.05);
    --bs-table-striped-bg: rgba(255, 255, 255, 0.03);
}

[data-theme="dark"] .card {
    background-color: #1e1e1e;
    border-color: #2e2e2e !important;
    color: #e0e0e0;
}

[data-theme="dark"] thead {
    background-color: #252525;
    color: #aaa;
}

[data-theme="dark"] .alert-success {
    background-color: #1a3a2a;
    border-color: #2d6a4a;
    color: #6fcf97;
}

[data-theme="dark"] .btn-outline-secondary {
    color: #aaa;
    border-color: #555;
}

[data-theme="dark"] .btn-outline-secondary:hover {
    background-color: #333;
    color: #e0e0e0;
}
</style>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 fw-semibold mb-0">List Fakultas</h1>
        <a href="/fakultas/create" class="btn btn-primary btn-sm">+ Tambah Fakultas</a>
    </div>

    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endsession

    <div class="card border">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Fakultas</th>
                        <th>Nama Dekan</th>
                        <th style="width: 190px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fakultas as $item)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-medium">{{ $item->name }}</td>
                            <td>{{ $item->dekan }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="/fakultas/{{ $item->id }}" class="btn btn-outline-secondary btn-sm">Detail</a>
                                    <a href="/fakultas/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="/fakultas/{{ $item->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada data fakultas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
