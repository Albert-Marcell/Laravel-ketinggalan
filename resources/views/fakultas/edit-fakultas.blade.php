<x-layout>
    <div> 
        <h1>edit Fakultas</h1>
        <form action="/fakultas/{{ $fakultas->id }}" method = "post">
            @csrf
            @method('put')
            <div class="form-group">
                <input 
                    name="nama_fakultas"
                    type="text"
                    value="{{ $fakultas->name }}"
                    class="form-control"
                    placeholder="Nama Fakultas">
            </div>
            <div class="form-group">
                <input 
                    name="nama_dekan"
                    type="text"
                    value="{{ $fakultas->dekan }}"
                    class="form-control"
                    placeholder="Nama Dekan">
            </div>
            <button type="submit" class="btn btn-primary">update</button>
        </form>
    </div>
</x-layout>