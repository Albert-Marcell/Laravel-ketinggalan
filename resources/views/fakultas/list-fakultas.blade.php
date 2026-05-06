<x-layout>
   <h1>List Fakultas</h1>

   <a href="/fakultas/create">Tambah Fakultas</a>

   <table class="table">
      <thead>
         <tr>
            <th>NO</th>
            <th>Nama Fakultas</th>
            <th>Nama Dekan</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($fakultas as $item)
         <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->dekan }}</td>
            <td>
               <a href="/fakultas/{{ $item->id }}">Detail</a>
               <a href="/fakultas/{{ $item->id }}/edit" class="btn btn-warning">
               Edit
            </a>
               <form action="/fakultas/{{ $item->id }}" method="POST" style="display:inline;">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="btn btn-danger">Hapus</button>
               </form>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</x-layout>