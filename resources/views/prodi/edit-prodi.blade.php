<x-layout>
    <h1>Edit Prodi</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('prodi.update', $prodi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="fakultas_id" class="form-label">Fakultas</label>
            <select class="form-select" id="fakultas_id" name="fakultas_id" required>
                <option value="">Pilih Fakultas</option>
                @foreach($fakultas as $item)
                    <option value="{{ $item->id }}" {{ $prodi->fakultas_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_prodi" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_kaprodi" class="form-label">Nama Kaprodi</label>
            <input type="text" class="form-control" id="nama_kaprodi" name="nama_kaprodi" value="{{ old('nama_kaprodi', $prodi->nama_kaprodi) }}" required>
        </div>
        <div class="mb-3">
            <label for="foto_kaprodi" class="form-label">Foto Kaprodi</label>
            @if ($prodi->foto_kaprodi)
                <div class="mb-2 d-flex align-items-end gap-2">
                    <div>
                        <img src="{{ asset('storage/' . $prodi->foto_kaprodi) }}" style="max-width: 150px; display: block;" class="img-thumbnail" alt="Foto Kaprodi Saat Ini">
                    </div>
                    <button type="submit" form="deletePhotoForm" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Yakin ingin menghapus foto kaprodi?')">Hapus Foto</button>
                </div>
            @endif
            <input type="file" accept="image/*" class="form-control" id="foto_kaprodi" name="foto_kaprodi" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="/prodi" class="btn btn-secondary">Batal</a>
    </form>

    <form action="{{ route('prodi.delete-photo', $prodi->id) }}" method="POST" id="deletePhotoForm" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
