<?php

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::post('/rating', [RatingController::class, 'ratingMovie'])->name('rating');