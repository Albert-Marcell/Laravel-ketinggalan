<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource with pagination & search.
     * Menggunakan Eager Loading (with) untuk efisiensi query.
     */
    public function index(Request $request)
    {
        $keyword    = $request->input('search', '');
        $fakultasId = $request->input('fakultas_id', '');

        $prodi = Prodi::with('fakultas')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_prodi', 'like', '%' . $keyword . '%')
                      ->orWhere('nama_kaprodi', 'like', '%' . $keyword . '%');
            })
            ->when($fakultasId, function ($query) use ($fakultasId) {
                $query->where('fakultas_id', $fakultasId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $fakultasList = Fakultas::orderBy('name')->get();

        return view('prodi.list-prodi', compact('prodi', 'keyword', 'fakultasId', 'fakultasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::orderBy('name')->get();
        return view('prodi.add-prodi', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     * Menggunakan StoreProdiRequest untuk validasi terpisah.
     */
    public function store(StoreProdiRequest $request)
    {
        $validated = $request->validated();

        // Upload foto kaprodi ke storage/public/profile_kaprodi
        $filePath = Storage::disk('public')->putFile('profile_kaprodi', $request->file('foto_kaprodi'));

        Prodi::create([
            'fakultas_id'  => $validated['fakultas_id'],
            'nama_prodi'   => $validated['nama_prodi'],
            'nama_kaprodi' => $validated['nama_kaprodi'],
            'foto_kaprodi' => $filePath,
        ]);

        return redirect()->route('prodi.index')
                         ->with('success', '✅ Prodi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * Menggunakan Eager Loading untuk relasi Fakultas.
     */
    public function show(Prodi $prodi)
    {
        $prodi->load('fakultas');
        return view('prodi.detail-prodi', compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::orderBy('name')->get();
        return view('prodi.edit-prodi', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     * Foto bersifat opsional (nullable) saat update.
     * Menggunakan UpdateProdiRequest untuk validasi terpisah.
     */
    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto_kaprodi')) {
            // Hapus foto lama jika ada
            if ($prodi->foto_kaprodi) {
                Storage::disk('public')->delete($prodi->foto_kaprodi);
            }
            // Simpan foto baru
            $validated['foto_kaprodi'] = Storage::disk('public')
                ->putFile('profile_kaprodi', $request->file('foto_kaprodi'));
        } else {
            // Jika tidak ada foto baru, hapus key dari array agar foto lama tidak terhapus
            unset($validated['foto_kaprodi']);
        }

        $prodi->update($validated);

        return redirect()->route('prodi.index')
                         ->with('success', '✅ Prodi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     * Data tidak dihapus permanen, hanya ditandai deleted_at.
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete(); // Soft Delete — foto tetap disimpan

        return redirect()->route('prodi.index')
                         ->with('success', '🗑️ Prodi berhasil dihapus. Data dapat dipulihkan di halaman Arsip.');
    }

    /**
     * Display list of soft-deleted Prodi (Trash/Arsip).
     */
    public function trashed(Request $request)
    {
        $keyword = $request->input('search', '');

        $prodi = Prodi::onlyTrashed()
            ->with('fakultas')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_prodi', 'like', '%' . $keyword . '%')
                      ->orWhere('nama_kaprodi', 'like', '%' . $keyword . '%');
            })
            ->latest('deleted_at')
            ->paginate(10)
            ->withQueryString();

        return view('prodi.trashed', compact('prodi', 'keyword'));
    }

    /**
     * Restore a soft-deleted Prodi.
     */
    public function restore($id)
    {
        $prodi = Prodi::onlyTrashed()->findOrFail($id);
        $prodi->restore();

        return redirect()->route('prodi.trashed')
                         ->with('success', '♻️ Prodi "' . $prodi->nama_prodi . '" berhasil dipulihkan.');
    }

    /**
     * Permanently delete a soft-deleted Prodi.
     */
    public function forceDelete($id)
    {
        $prodi = Prodi::onlyTrashed()->findOrFail($id);

        // Hapus foto dari storage secara permanen
        if ($prodi->foto_kaprodi) {
            Storage::disk('public')->delete($prodi->foto_kaprodi);
        }

        $prodi->forceDelete();

        return redirect()->route('prodi.trashed')
                         ->with('success', '❌ Prodi berhasil dihapus secara permanen.');
    }

    /**
     * Remove the kaprodi photo from storage and database.
     */
    public function deletePhoto(Prodi $prodi)
    {
        if ($prodi->foto_kaprodi) {
            Storage::disk('public')->delete($prodi->foto_kaprodi);
            $prodi->update(['foto_kaprodi' => null]);
        }

        return redirect()->back()->with('success', '🖼️ Foto Kaprodi berhasil dihapus.');
    }
}
