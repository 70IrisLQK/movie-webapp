<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Route
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

require __DIR__ . '/actor/actor.php';
require __DIR__ . '/category/category.php';
require __DIR__ . '/country/country.php';
require __DIR__ . '/director/director.php';
require __DIR__ . '/episode/episode.php';
require __DIR__ . '/filter/filter.php';
require __DIR__ . '/genre/genre.php';
require __DIR__ . '/home/home.php';
require __DIR__ . '/movie/movie.php';
require __DIR__ . '/rating/rating.php';
require __DIR__ . '/report/report.php';
require __DIR__ . '/watch/watch.php';
require __DIR__ . '/year/year.php';