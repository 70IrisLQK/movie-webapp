<?php

use App\Http\Controllers\ActorController;
use Illuminate\Support\Facades\Route;

Route::get('/dien-vien/{slug}', [ActorController::class, 'show'])->name('dien-vien');