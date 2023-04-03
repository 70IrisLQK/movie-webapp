<?php

use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('/the-loai/{slug}', [GenreController::class, 'genreMovie'])->name('the-loai');

// Route::prefix('genres')->group(function () {
//   Route::post('status', [GenreController::class, 'updateStatus']);
//   Route::get('delete/{id}', [GenreController::class, 'destroy']);
// });
// Route::resource('genre', GenreController::class);