{{--
    Komponen: x-pagination-info
    Menampilkan informasi pagination: "Menampilkan X - Y dari Z data"
    
    Props:
        - paginator: instance Laravel Paginator
    
    Penggunaan: <x-pagination-info :paginator="$prodi" />
--}}

@props(['paginator'])

@if ($paginator->total() > 0)
    <div class="pagination-info">
        Menampilkan
        <strong>{{ $paginator->firstItem() }}</strong>
        –
        <strong>{{ $paginator->lastItem() }}</strong>
        dari
        <strong>{{ $paginator->total() }}</strong>
        data
    </div>
@endif

<style>
.pagination-info {
    color: #6b7280;
    font-size: 0.85rem;
    padding: 4px 0;
}

[data-theme="dark"] .pagination-info {
    color: #9ca3af;
}
</style>
