<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

Route::get('about', function () {
    return view ('about');
});

Route::get('mahasiswa', function () {
    return view ('mahasiswa');
});

Route::get('profile', function () {
    $nama = 'Muhammad Faruqi Adri';
    return view ('profile', compact('nama'));
});




