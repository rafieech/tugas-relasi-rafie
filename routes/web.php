<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('berita.index');
});

// ---- Login: hanya untuk tamu (belum login) ----
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// ---- Wajib login ----
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('berita', BeritaController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->parameters(['berita' => 'berita']);

    // Hapus: wajib login DAN admin
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])
        ->middleware('admin')
        ->name('berita.destroy');
});

// ---- Publik (HARUS di paling bawah) ----
Route::resource('berita', BeritaController::class)
    ->only(['index', 'show'])
    ->parameters(['berita' => 'berita']);

// Komentar boleh dikirim pengunjung tanpa login
Route::post('berita/{berita}/komentar', [BeritaController::class, 'komentar'])
    ->name('berita.komentar');
