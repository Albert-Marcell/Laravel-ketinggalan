{{--
    Komponen: x-search-form
    Form pencarian yang reusable.
    
    Props:
        - placeholder (string): placeholder text untuk input search
        - action (string): URL action form
    
    Penggunaan: <x-search-form placeholder="Cari prodi..." action="{{ route('prodi.index') }}" />
--}}

@props([
    'placeholder' => 'Cari data...',
    'action'      => '',
])

<form method="GET" action="{{ $action }}" class="search-form" id="searchForm">
    <div class="search-form__wrapper">
        <span class="search-form__icon">🔍</span>
        <input
            type="text"
            name="search"
            id="searchInput"
            class="search-form__input"
            placeholder="{{ $placeholder }}"
            value="{{ request('search') }}"
            autocomplete="off"
        >
        @if (request('search'))
            <a href="{{ $action }}" class="search-form__clear" title="Hapus pencarian">✕</a>
        @endif
        <button type="submit" class="search-form__btn">Cari</button>
    </div>
    {{-- Pertahankan query string lain (seperti fakultas_id) --}}
    @foreach (request()->except(['search', '_token', 'page']) as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>

<style>
.search-form { display: inline-flex; align-items: center; }

.search-form__wrapper {
    display: flex;
    align-items: center;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 6px 12px;
    gap: 8px;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.search-form__wrapper:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
}

.search-form__icon { font-size: 0.85rem; }

.search-form__input {
    border: none;
    outline: none;
    background: transparent;
    font-size: 0.875rem;
    color: #374151;
    min-width: 200px;
}

.search-form__clear {
    color: #9ca3af;
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: bold;
    padding: 2px 4px;
    border-radius: 4px;
    transition: all 0.15s;
}

.search-form__clear:hover {
    color: #ef4444;
    background: #fee2e2;
}

.search-form__btn {
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 4px 12px;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
    white-space: nowrap;
}

.search-form__btn:hover { background: #2563eb; }

[data-theme="dark"] .search-form__wrapper {
    background: #1e1e1e;
    border-color: #3a3a3a;
}

[data-theme="dark"] .search-form__input {
    color: #e5e7eb;
}
</style>
