<x-layout>
    <h1>Tambah Prodi</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="/prodi" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="fakultas_id" class="form-label">Fakultas</label>
            <select class="form-select" id="fakultas_id" name="fakultas_id" required>
                <option value="">Pilih Fakultas</option>
                @foreach($fakultas as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_prodi" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
        </div>
        <div class="mb-3">
            <label for="nama_kaprodi" class="form-label">Nama Kaprodi</label>
            <input type="text" class="form-control" id="nama_kaprodi" name="nama_kaprodi" required>
        </div>
        <div class="mb-3">
            <label for="foto_kaprodi" class="form-label">Foto Kaprodi</label>
            <input type="file" accept="image/*" class="form-control" id="foto_kaprodi" name="foto_kaprodi">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</x-layout>