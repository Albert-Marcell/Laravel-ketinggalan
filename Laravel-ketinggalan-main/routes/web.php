<?php

use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;

// ─── Halaman Utama ─────────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('prodi.index');
});

// ─── Protected Routes (Middleware Auth) ─────────────────────────────────────
// Semua route di bawah ini hanya bisa diakses oleh pengguna yang sudah login.
// Jika belum login, otomatis diredirect ke /login (ditangani Fortify).
Route::middleware('auth')->group(function () {

    // ── Resource Routes Fakultas ───────────────────────────────────────────
    // Otomatis membuat: index, create, store, show, edit, update, destroy
    Route::resource('/fakultas', FakultasController::class);

    // ── Resource Routes Prodi ──────────────────────────────────────────────
    // Otomatis membuat: index, create, store, show, edit, update, destroy
    Route::resource('/prodi', ProdiController::class);

    // ── Extra Routes Prodi ────────────────────────────────────────────────

    // Hapus foto kaprodi
    Route::delete('/prodi/{prodi}/photo', [ProdiController::class, 'deletePhoto'])
        ->name('prodi.delete-photo');

    // Halaman Arsip / Trashed Prodi (Soft Delete)
    // PENTING: Route ini harus SEBELUM route resource /prodi/{prodi}
    // agar 'arsip' tidak diparsing sebagai {prodi} ID
    Route::get('/prodi/arsip/trashed', [ProdiController::class, 'trashed'])
        ->name('prodi.trashed');

    // Restore Prodi dari Trash
    Route::post('/prodi/{id}/restore', [ProdiController::class, 'restore'])
        ->name('prodi.restore');

    // Force Delete Prodi (Hapus Permanen)
    Route::delete('/prodi/{id}/force-delete', [ProdiController::class, 'forceDelete'])
        ->name('prodi.force-delete');
});
