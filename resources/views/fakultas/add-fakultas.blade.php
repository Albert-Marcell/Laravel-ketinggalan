<x-layout title="Add">

  <div>
    <h1>Add Fakultas</h1>

    {{--  --}}
    @if ($errors->any())
        <div class="alert alert-danger">

          <ul>
              @foreach ($errors->all() as $error)
                <li>
                  {{ $error }}
                </li>
              @endforeach
          </ul>
          
        </div>
    @endif



    {{-- Buat Form dengan pilihan form post --}}
    <form action="/fakultas" method="post">
      {{-- Keamanan csrf --}}
      @csrf 

      <div class="form-group">
        <input 
              name= "name_fakultas"
              type="text"
              class="form-control"
              value = "{{ old('name_fakultas') }}" {{-- tambah value agar waktu kita hanya mengisi 1 data, dia tidak terhpus --}}
              placeholder="Nama Fakultas">
      </div>

      <div class="form-group">
        <input 
              name= "name_dekan"
              type="text"
              class="form-control"
              value = "{{ old('name_fakultas') }}"              
              placeholder="Nama dekan">
      </div>

      <button type="submit" class="btn btn-primary">
        Simpan
      </button>

    </form>
  </div>
  
</x-layout>