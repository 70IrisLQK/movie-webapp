<?php

use App\Http\Controllers\WatchController;
use Illuminate\Support\Facades\Route;

Route::get('/xem-phim/{slug}/{episode}/{server}', [WatchController::class, 'watch'])->name('xem-phim');