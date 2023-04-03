<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/loai-phim/{slug}', [CategoryController::class, 'categoryMovie'])->name('loai-phim');

// Route::prefix('categories')->group(function () {
//   Route::get('delete/{id}', [CategoryController::class, 'destroy']);
//   Route::post('status', [CategoryController::class, 'updateStatus']);
// });

// Route::resource('categories', CategoryController::class);