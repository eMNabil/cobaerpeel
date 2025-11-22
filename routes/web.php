<?php
use App\Http\Controllers\Api\BeritaController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/berita/{slug}', function () {
    return Inertia::render('BeritaDetail2');
})->name('berita.show');
