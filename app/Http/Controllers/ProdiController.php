<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Models\Fakultas;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Time;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::all();
        return view('prodi.list-prodi', compact('prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all();
        return view('prodi.add-prodi', compact('fakultas'));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(StoreProdiRequest $request)
    {
        $validate = $request->safe();
        $filePath = Storage::disk("public")->putFile('profile_kaprodi', $validate->file('foto_kaprodi'));

        Prodi::create([
            'fakultas_id' => $validate['fakultas_id'],
            'nama_prodi' => $validate['nama_prodi'],
            'nama_kaprodi' => $validate['nama_kaprodi'],
            'foto_kaprodi' => $filePath
        ]);

        return redirect('/prodi')->with('success', 'Prodi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        return view('prodi.detail-prodi', compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::all();
        return view('prodi.edit-prodi', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        $validate = $request->validated();

        if ($request->hasFile('foto_kaprodi')) {
            // Hapus file foto lama jika ada
            if ($prodi->foto_kaprodi) {
                Storage::disk('public')->delete($prodi->foto_kaprodi);
            }
            // Simpan file foto baru
            $filePath = Storage::disk("public")->putFile('profile_kaprodi', $request->file('foto_kaprodi'));
            $validate['foto_kaprodi'] = $filePath;
        }

        $prodi->update($validate);

        return redirect('/prodi')->with('success', 'Prodi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        // Hapus file foto jika ada
        if ($prodi->foto_kaprodi) {
            Storage::disk('public')->delete($prodi->foto_kaprodi);
        }
        
        $prodi->delete();

        return redirect('/prodi')->with('success', 'Prodi berhasil dihapus.');
    }

    /**
     * Remove the kaprodi photo from storage and database.
     */
    public function deletePhoto(Prodi $prodi)
    {
        if ($prodi->foto_kaprodi) {
            Storage::disk('public')->delete($prodi->foto_kaprodi);
            $prodi->update(['foto_kaprodi' => '']);
        }

        return redirect()->back()->with('success', 'Foto Kaprodi berhasil dihapus.');
    }
}
