<x-layout>
    @foreach ($fakultas as $item)
    <ul>
        <li>{{ $item->id}}</li>
        <li>{{ $item->name}}</li>
        <li>{{ $item->dekan}}</li>
    </ul>
    @endforeach
   <a href="/fakultas/create">
      <h1>List Fakultas</h1>
   </a>
   <a href="/edit-fakultas">
      <h1>Edit Fakultas</h1>
   </a>
</x-layout>
