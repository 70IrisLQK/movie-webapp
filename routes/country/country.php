<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/quoc-gia/{slug}', [CountryController::class, 'countryMovie'])->name('quoc-gia');


// Route::prefix('countries')->group(function () {
//   Route::post('status', [CountryController::class, 'updateStatus']);
//   Route::get('delete/{id}', [CountryController::class, 'destroy']);
// });

// Route::resource('country', CountryController::class);