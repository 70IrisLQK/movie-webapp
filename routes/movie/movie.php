<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/phim/{slug}', [MovieController::class, 'movie'])->name('phim');
Route::get('/xem-nhieu', [MovieController::class, 'mostMovie'])->name('xem-nhieu');
Route::get('/moi-cap-nhat', [MovieController::class, 'newMovie'])->name('moi-cap-nhat');

// Route::post('movie/select-year', [MovieController::class, 'selectYear'])->name('select-year');
// Route::post('movie/select-season', [MovieController::class, 'selectSeason'])->name('select-season');
// Route::post('movie/select-top-view', [MovieController::class, 'selectTopView'])->name('select-top-view');
// Route::post('movie/category-choose', [MovieController::class, 'categoryChoose'])->name('category-choose');
// Route::post('movie/country-choose', [MovieController::class, 'countryChoose'])->name('country-choose');
// Route::post('movie/status-choose', [MovieController::class, 'statusChoose'])->name('status-choose');
// Route::post('movie/resolution-choose', [MovieController::class, 'resolutionChoose'])->name('resolution-choose');
// Route::post('movie/hot-choose', [MovieController::class, 'hotChoose'])->name('hot-choose');
// Route::post('movie/subtitle-choose', [MovieController::class, 'subtitleChoose'])->name('subtitle-choose');
// Route::post('movie/belong-movie-choose', [MovieController::class, 'belongMovieChoose'])->name('belong-movie-choose');
// Route::post('filter-top-view', [MovieController::class, 'filterTopView'])->name('filter-top-view');
// Route::post('filter-top-view-default', [MovieController::class, 'filterTopViewDefault'])->name('filter-top-view-default');
// Route::get('movie/delete/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');