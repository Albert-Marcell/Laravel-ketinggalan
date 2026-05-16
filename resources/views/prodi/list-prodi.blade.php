<x-layout>
    <h1>List Prodi</h1>
    
    <div class="card border">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Prodi</th>
                        <th>Nama Kaprodi</th>
                        <th>Foto Kaprodi</th>
                        <th>Nama Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prodi as $item)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-medium">{{ $item->nama_prodi }}</td>
                            <td>{{ $item->nama_kaprodi }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->foto_kaprodi) }}" style="max-width: 100px;" alt="Foto Kaprodi">
                            </td>
                            <td>{{ $item->fakultas->name ?? 'Fakultas tidak ditemukan' }}</td>
                            <td>
                                <a href="{{ route('prodi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('prodi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada data prodi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout>