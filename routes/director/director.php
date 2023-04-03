<?php

use App\Http\Controllers\DirectorController;
use Illuminate\Support\Facades\Route;

Route::get('/dao-dien/{slug}', [DirectorController::class, 'show'])->name('dao-dien');