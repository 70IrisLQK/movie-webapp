<?php

use App\Http\Controllers\EpisodeController;
use Illuminate\Support\Facades\Route;

Route::prefix('episode')->group(function () {
  Route::get('movie', [EpisodeController::class, 'getMovie']);
});

Route::resource('episode', EpisodeController::class);