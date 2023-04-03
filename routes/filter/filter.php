<?php

use App\Http\Controllers\FilterController;
use Illuminate\Support\Facades\Route;

Route::get('az-list/{az}', [FilterController::class, 'azList'])->name('az-list');
Route::get('loc-phim', [FilterController::class, 'filter'])->name('loc-phim');
Route::get('tim-kiem', [FilterController::class, 'searchMovie'])->name('tim-kiem');
Route::post('live-search', [FilterController::class, 'liveSearchMovie'])->name('live-search');