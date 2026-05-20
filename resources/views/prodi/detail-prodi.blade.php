<x-layout>
    <h1>Detail Prodi</h1>

    <div class="card border mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($prodi->foto_kaprodi)
                        <img src="{{ asset('storage/' . $prodi->foto_kaprodi) }}" style="max-width: 200px;" class="img-fluid rounded mb-3" alt="Foto Kaprodi">
                    @else
                        <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded mb-3" style="height: 200px; width: 200px; margin: 0 auto;">
                            Tidak ada foto
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Nama Prodi</th>
                            <td>: {{ $prodi->nama_prodi }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kaprodi</th>
                            <td>: {{ $prodi->nama_kaprodi }}</td>
                        </tr>
                        <tr>
                            <th>Fakultas</th>
                            <td>: {{ $prodi->fakultas->name ?? 'Fakultas tidak ditemukan' }}</td>
                        </tr>
                        <tr>
                            <th>Dekan Fakultas</th>
                            <td>: {{ $prodi->fakultas->dekan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="/prodi" class="btn btn-secondary">Kembali</a>
</x-layout>
