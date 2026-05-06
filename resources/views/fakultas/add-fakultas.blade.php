<x-layout>
    <div> 
        <h1>Add Fakultas</h1>
        <form action="/fakultas" method = "post">
            @csrf
            <div class="form-group">
                <input 
                    name="nama_fakultas"
                    type="text"
                    class="form-control"
                    placeholder="Nama Fakultas">
            </div>
            <div class="form-group">
                <input 
                    name="nama_dekan"
                    type="text"
                    class="form-control"
                    placeholder="Nama Dekan">
            </div>
            <button type="submit" class="btn btn-primary">update</button>
        </form>
    </div>
</x-layout>
