<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Http\Requests\StoreFakultasRequest;
use App\Http\Requests\UpdateFakultasRequest;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource with pagination & search.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search', '');

        $fakultas = Fakultas::when($keyword, function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%')
                              ->orWhere('dekan', 'like', '%' . $keyword . '%');
                    })
                    ->withCount('prodis') // Hitung jumlah prodi tiap fakultas
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->withQueryString();

        return view('fakultas.list-fakultas', compact('fakultas', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fakultas.add-fakultas');
    }

    /**
     * Store a newly created resource in storage.
     * Menggunakan StoreFakultasRequest untuk validasi terpisah.
     */
    public function store(StoreFakultasRequest $request)
    {
        $validated = $request->validated();

        Fakultas::create([
            'name'  => $validated['name_fakultas'],
            'dekan' => $validated['name_dekan'],
        ]);

        return redirect()->route('fakultas.index')
                         ->with('success', '✅ Fakultas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * Eager load prodis untuk menampilkan daftar prodi dalam fakultas.
     */
    public function show(Fakultas $fakulta)
    {
        $fakulta->load('prodis');
        return view('fakultas.detail-fakultas', compact('fakulta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $fakulta)
    {
        return view('fakultas.edit-fakultas', [
            'fakultas' => $fakulta
        ]);
    }

    /**
     * Update the specified resource in storage.
     * Menggunakan UpdateFakultasRequest untuk validasi terpisah.
     */
    public function update(UpdateFakultasRequest $request, Fakultas $fakulta)
    {
        $validated = $request->validated();

        $fakulta->update([
            'name'  => $validated['name_fakultas'],
            'dekan' => $validated['name_dekan'],
        ]);

        return redirect()->route('fakultas.index')
                         ->with('success', '✅ Fakultas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fakultas $fakulta)
    {
        // Jika Fakultas masih memiliki Prodi, tidak bisa dihapus
        if ($fakulta->prodis()->count() > 0) {
            return redirect()->back()
                             ->with('error', '❌ Fakultas tidak dapat dihapus karena masih memiliki data Prodi.');
        }

        $fakulta->delete();

        return redirect()->route('fakultas.index')
                         ->with('success', '🗑️ Fakultas berhasil dihapus.');
    }
}
