<?php

use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Route;

Route::get('/nam/{year}', [YearController::class, 'yearMovie'])->name('nam');