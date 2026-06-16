<?php

use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/fakultas',FakultasController::class);
Route::resource('/prodi',ProdiController::class);
Route::delete('/prodi/{prodi}/photo', [ProdiController::class, 'deletePhoto'])->name('prodi.delete-photo');

// Route::get('/list-fakultas', function () {
//     return view('fakultas.list-fakultas');
// });

// Route::get('/add-fakultas', function () {
//     return view('fakultas.add-fakultas');
// });

// Route::get('/edit-fakultas', function () {
//     return view('fakultas.edit-fakultas');
// });
