<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $listCategories = Category::orderBy('name', 'ASC')->get();
        $listGenres = Genre::orderBy('name', 'ASC')->get();
        $listCountries = Country::orderBy('name', 'ASC')->get();

        // Top movie series
        $listSingleTopMovies = Movie::latest()
            ->where('category_id', config('constants.category_ids.single'))->orderBy('view', 'DESC')
            ->take(5)->get();
        // top movie single
        $listSeriesTopMovies = Movie::latest()
            ->where('category_id', config('constants.category_ids.series'))->orderBy('view', 'DESC')
            ->take(5)->get();

        View::share('listCategories', $listCategories);
        View::share('listGenres', $listGenres);
        View::share('listCountries', $listCountries);

        View::share('listSingleTopMovies', $listSingleTopMovies);
        View::share('listSeriesTopMovies', $listSeriesTopMovies);
    }
}