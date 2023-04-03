<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// aside
Route::post('/aside-trending', [HomeController::class, 'asideTrending'])->name('aside-trending');
Route::post('/aside-trending-default', [HomeController::class, 'asideTrendingDefault'])->name('aside-trending-default');

// new movie
Route::post('/new-movie', [HomeController::class, 'newMovieHome'])->name('new-movie');
Route::post('/new-movie-default', [HomeController::class, 'newMovieHomeDefault'])->name('new-movie-default');

// movie vertical single series
Route::post('/vertical-movie', [HomeController::class, 'verticalMovie'])->name('vertical-movie');
Route::post('/single-movie-default', [HomeController::class, 'singleMovieDefault'])->name('single-movie-default');
Route::post('/series-movie-default', [HomeController::class, 'seriesMovieHomeDefault'])->name('series-movie-default');

// movie category action genre
Route::post('/filter-category-movie', [HomeController::class, 'filterCategoryMovie'])->name('filter-category-movie');
Route::post('/action-movie-default', [HomeController::class, 'actionMovie'])->name('action-movie-default');
Route::post('/horrible-movie-default', [HomeController::class, 'horribleMovie'])->name('horrible-movie-default');