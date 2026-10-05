<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('berita.index'));
Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);
Route::post('berita/{berita}/komentar', [BeritaController::class, 'komentar'])->name('berita.komentar');
