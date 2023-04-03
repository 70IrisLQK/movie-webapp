<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        //Cartoon
        $listCartoonMovies = Cache::remember('listCartoonMovies', config('constants.time_cache.time'), function () {
            return  Movie::with('countries', 'genres')
                ->latest()
                ->where('category_id', config('constants.category_ids.cartoon'))
                ->take(12)
                ->get(['id', 'time', 'year', 'episode_current', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
        });

        $this->generateSeoTags($request);

        return view('pages.home', compact(
            'listCartoonMovies',
        ));
    }

    public function generateSeoTags($request)
    {
        $seo_title = 'Phim Hay | Phim HD Vietsub | Xem Phim Online | Xem Phim Nhanh | Phim Chill Alone - PhimChilla';
        $seo_des = 'Xem phim hay nhất ' . date('Y') . ' cập nhật nhanh nhất, Xem Phim Online HD Vietsub - Thuyết Minh tốt trên nhiều thiết bị. ';
        $seo_key = 'PhimChilla.com';
        $seo_image = url('assets/images/seo_image.png');

        SEOMeta::setTitle($seo_title, false)
            ->setDescription($seo_des)
            ->addKeyword([$seo_key])
            ->setCanonical($request->url())
            ->setPrev(request()->root())
            ->setPrev(request()->root());

        OpenGraph::setTitle($seo_title, false)
            ->addProperty('type', 'movie')
            ->addProperty('locale', 'vi-VN')
            ->addProperty('url', $request->url())
            ->setDescription($seo_des)
            ->addImages([$seo_image]);

        TwitterCard::setTitle($seo_title, false)
            ->setType('movie')
            ->setImage($seo_image)
            ->setDescription($seo_des)
            ->setUrl($request->url());

        JsonLdMulti::newJsonLd()
            ->setTitle($seo_title, false)
            ->setType('movie')
            ->setDescription($seo_des)
            ->setUrl($request->url());
    }

    public function verticalMovie(Request $request)
    {
        $data = $request->all();

        switch ($data['sortby']) {
            case 'latest':
                if ($data['type'] == 'movie') {
                    $listMovies = Movie::with('countries')->latest()->where('category_id', '=', config('constants.category_ids.single'))
                        ->take(3)
                        ->get(['id', 'slug', 'name', 'origin_name', 'image', 'time', 'view']);
                } else {
                    $listMovies = Movie::with('countries')->latest()->where('category_id', '=', config('constants.category_ids.series'))
                        ->take(3)
                        ->get(['id', 'slug', 'name', 'origin_name', 'image', 'time', 'view']);
                }
                break;
            case 'mostview':
                if ($data['type'] == 'movie') {
                    $listMovies = Movie::with('countries')->orderBy('view', 'DESC')->where('category_id', '=', config('constants.category_ids.single'))
                        ->take(3)
                        ->get(['id', 'slug', 'name', 'origin_name', 'image', 'time', 'view']);
                } else {
                    $listMovies = Movie::with('countries')->orderBy('view', 'DESC')->where('category_id', '=', config('constants.category_ids.series'))
                        ->take(3)
                        ->get(['id', 'slug', 'name', 'origin_name', 'image', 'time', 'view']);
                }
                break;
            default:
                break;
        }

        $output = '';
        foreach ($listMovies as $movie) {
            $output .= '
            <div class="item post-53456">
            <a href="' . route('phim', [$movie->slug]) . '"
                title="' . $movie->name . '">
                <div class="item-link">
                    <img src="' . asset('uploads/movie/' . $movie->image) . '"
                        class="lazyload blur-up post-thumb" alt="' . $movie->name . '"
                        title="' . $movie->name . '" />
                </div>
                <h3 class="title">' . $movie->name . '</h3>
                <p class="original_title">' . $movie->origin_name . '</p>
            </a>
            <div class="viewsCount">' . $this->thousandsCurrencyFormat($movie->view) . ' lượt xem</div>
            <span class="post_meta">' . $movie->time . '</span>
            </div>
            ';
        }
        echo $output;
    }
    public function singleMovieDefault()
    {
        $listSingleMovies = Cache::remember('listSingleMovies', config('constants.time_cache.time'), function () {
            return Movie::with('countries')->latest()->where('category_id', config('constants.category_ids.single'))
                ->take(3)
                ->get(['id', 'slug', 'name', 'origin_name', 'image', 'time', 'view', 'quality', 'language']);
        });

        $output = '';

        foreach ($listSingleMovies as $singleMovie) {
            $output .= '
            <div class="item post-53456">
            <a href="' . route('phim', [$singleMovie->slug]) . '"
                title="' . $singleMovie->name . '">
                <div class="item-link">
                    <img src="' . asset('uploads/movie/' . $singleMovie->image) . '"
                        class="lazyload blur-up post-thumb" alt="' . $singleMovie->name . '"
                        title="' . $singleMovie->name . '" />
                </div>
                <h3 class="title">' . $singleMovie->name . '</h3>
                <p class="original_title">' . $singleMovie->origin_name . '</p>
            </a>
            <div class="viewsCount">' . $this->thousandsCurrencyFormat($singleMovie->view) . ' lượt xem</div>
            <span class="post_meta">' . $singleMovie->time . '</span>
            </div>
            ';
        }
        echo $output;
    }
    public function seriesMovieHomeDefault()
    {

        $listSeriesMovies = Cache::remember('listSeriesMovies', config('constants.time_cache.time'), function () {
            return Movie::with('countries')->orderBy('view', 'DESC')->where('category_id', '=', config('constants.category_ids.series'))
                ->take(3)
                ->get(['id', 'slug', 'name', 'origin_name', 'image', 'time', 'view', 'quality', 'language']);
        });

        $outputSeries = '';

        foreach ($listSeriesMovies as $seriesMovie) {
            $outputSeries .= '
            <div class="item post-53456">
            <a href="' . route('phim', [$seriesMovie->slug]) . '"
                title="' . $seriesMovie->name . '">
                <div class="item-link">
                    <img src="' . asset('uploads/movie/' . $seriesMovie->image) . '"
                        class="lazyload blur-up post-thumb" alt="' . $seriesMovie->name . '"
                        title="' . $seriesMovie->name . '" />
                </div>
                <h3 class="title">' . $seriesMovie->name . '</h3>
                <p class="original_title">' . $seriesMovie->origin_name . '</p>
            </a>
            <div class="viewsCount">' . $this->thousandsCurrencyFormat($seriesMovie->view) . ' lượt xem</div>
            <span class="post_meta">' . $seriesMovie->time . '</span>
            </div>
            ';
        }
        echo $outputSeries;
    }

    public function newMovieHome(Request $request)
    {
        $data = $request->all();
        switch ($data['sortby']) {
            case 'mostview':
                $listMovies = Movie::with('countries', 'genres')
                    ->orderBy('view', 'DESC')
                    ->take(12)
                    ->get(['id', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
                break;
            case 'lastupdate':
                $listMovies = Movie::with('countries', 'genres')
                    ->latest()
                    ->take(12)
                    ->get(['id', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
                break;
            default:
                break;
        }
        $output = '';

        foreach ($listMovies as $newMovie) {
            $description = Str::limit($newMovie->description, 150, '...');
            $language = $newMovie->language;
            $quality = $newMovie->quality;
            $time = $newMovie->time;

            $genreString = '';
            foreach ($newMovie->genres as $genre) {
                $genreString .= $genre->name . ', ';
            }
            $countryString = '';
            foreach ($newMovie->countries as $country) {
                $countryString .= $country->name . ', ';
            }
            $strCountry = rtrim($countryString, ", ");
            $strGenre = rtrim($genreString, ", ");

            $output .= '
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-53456">
            <div class="halim-item">
                <a class="halim-thumb" href="' . route('phim', [$newMovie->slug]) . '" title="Quái Vật Tám Chân">
                                        <figure><img class="blur-up img-responsive lazyautosizes lazyloaded" data-sizes="auto" data-src="' . asset('uploads/movie/' . $newMovie->image) . '" alt="' . $newMovie->name . '" title="' . $newMovie->name . '" sizes="203px" src="' . asset('uploads/movie/' . $newMovie->image) . '"></figure>
                                        <span class="status">' . $language . '-' . $quality . '</span><span class="episode">' . $newMovie->episode_current . '</span>
                    <div class="icon_overlay" data-html="true" data-toggle="halim-popover" data-placement="top" data-trigger="hover" title="" data-content="<div class=org-title>' . $newMovie->name . '</div>                            <div class=film-meta>
                                <div class=text-center>
                                    <span class=released><i class=hl-calendar></i> ' . $newMovie->year . '</span>                                    <span class=runtime><i class=hl-clock></i> ' . $time . '</span>                                </div>
                                <div class=film-content>' .  $description . '</div>
                                <p class=category>Quốc gia: <span class=category-name>' . $strCountry . '</span></p>                                <p class=category>Thể loại: <span class=category-name>' . $strGenre . '</span></p>
                            </div>" data-original-title="<span class=film-title>' . $newMovie->origin_name . '</span>">
                    </div>

                    <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                            <h2 class="entry-title">' . $newMovie->name . '</h2><p class="original_title">' . $newMovie->origin_name . '</p>                        </div>
                    </div>
                </a>
            </div>
        </article>
            ';
        }
        echo $output;
    }
    public function newMovieHomeDefault()
    {
        $listMovies = Cache::remember('listNewMovies', config('constants.time_cache.time'), function () {
            return  Movie::with('countries', 'genres')
                ->latest()
                ->take(12)
                ->get(['id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current']);
        });

        $output = '';

        foreach ($listMovies as $newMovie) {
            $description = Str::limit($newMovie->description, 70, '...');
            $time = $newMovie->time;
            $language = $newMovie->language;
            $quality = $newMovie->quality;

            $genreString = '';
            foreach ($newMovie->genres as $genre) {
                $genreString .= $genre->name . ', ';
            }
            $countryString = '';
            foreach ($newMovie->countries as $country) {
                $countryString .= $country->name . ', ';
            }
            $strCountry = rtrim($countryString, ", ");
            $strGenre = rtrim($genreString, ", ");
            $output .= '
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-53456">
            <div class="halim-item">
                <a class="halim-thumb" href="' . route('phim', [$newMovie->slug]) . '" title="Quái Vật Tám Chân">
                                        <figure><img class="blur-up img-responsive lazyautosizes lazyloaded" data-sizes="auto" data-src="' . asset('uploads/movie/' . $newMovie->image) . '" alt="' . $newMovie->name . '" title="' . $newMovie->name . '" sizes="203px" src="' . asset('uploads/movie/' . $newMovie->image) . '"></figure>
                                        <span class="status">' . $language . '-' . $quality . '</span><span class="episode">' . $newMovie->episode_current . '</span>
                    <div class="icon_overlay" data-html="true" data-toggle="halim-popover" data-placement="top" data-trigger="hover" title="" data-content="<div class=org-title>' . $newMovie->origin_name . '</div>                            <div class=film-meta>
                                <div class=text-center>
                                    <span class=released><i class=hl-calendar></i> ' . $newMovie->year . '</span>                                    <span class=runtime><i class=hl-clock></i> ' . $time . '</span>                                </div>
                                <div class=film-content>' . $description . '</div>
                                <p class=category>Quốc gia: <span class=category-name>' .  $strCountry  . '</span></p>                                <p class=category>Thể loại: <span class=category-name>' . $strGenre . '</span></p>
                            </div>" data-original-title="<span class=film-title>' . $newMovie->name . '</span>">
                    </div>

                    <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                            <h2 class="entry-title">' . $newMovie->name . '</h2><p class="original_title">' . $newMovie->origin_name . '</p>                        </div>
                    </div>
                </a>
            </div>
        </article>
            ';
        }
        echo $output;
    }

    public function asideTrending(Request $request)
    {
        $data = $request->all();
        switch ($data['type']) {
            case 'day':
                $listMovies = Movie::orderBy('view_day', 'DESC')
                    ->latest()
                    ->take(7)
                    ->get(['id', 'slug', 'name', 'image', 'origin_name', 'view_day']);
                break;
            case 'week':
                $listMovies = Movie::orderBy('view_week', 'DESC')
                    ->latest()
                    ->take(7)
                    ->get(['id', 'slug', 'name', 'image', 'origin_name', 'view_week']);
                break;
            case 'month':
                $listMovies = Movie::orderBy('view_month', 'DESC')
                    ->latest()
                    ->take(7)
                    ->get(['id', 'slug', 'name', 'image', 'origin_name', 'view_month']);
                break;
            default:
                $listMovies = Movie::orderBy('view', 'DESC')
                    ->latest()
                    ->take(7)
                    ->get(['id', 'slug', 'name', 'image', 'origin_name', 'view']);
                break;
        }

        $output = '';
        foreach ($listMovies as  $movie) {
            switch ($data['type']) {
                case 'day':
                    $view = $movie->view_day;
                    break;
                case 'week':
                    $view = $movie->view_week;
                    break;
                case 'month':
                    $view = $movie->view_month;
                    break;
                default:
                    $view = $movie->view;
                    break;
            }
            $output .= '
            <div class="item post-' . $movie->id . '">
                        <a href="' . route('phim', [$movie->slug]) . '"
                            title="' .  $movie->name . '">
                            <div class="item-link">
                                <img src="' . asset('uploads/movie/' . $movie->image) . '"
                                    
                                    class="lazyload blur-up post-thumb" alt="' .  $movie->name . '"
                                    title="' .  $movie->name . '" />
                            </div>
                            <h3 class="title">' .  $movie->name . '</h3>
                            <p class="original_title">' . $movie->origin_name . '</p>
                        </a>
                        <div class="viewsCount">' . $this->thousandsCurrencyFormat($view) . ' lượt xem</div>
                    </div>
            ';
        }
        echo $output;
    }
    public function asideTrendingDefault()
    {

        $listMovies = Cache::remember('listMovieTrending', config('constants.time_cache.time'), function () {
            return Movie::orderBy('view_day', 'DESC')
                ->take(7)
                ->get(['id', 'slug', 'name', 'image', 'origin_name', 'view_day']);
        });

        $output = '';

        foreach ($listMovies as  $movie) {
            $output .= '
            <div class="item post-' . $movie->id . '">
                        <a href="' . route('phim', [$movie->slug]) . '"
                            title="' . $movie->name . '">
                            <div class="item-link">
                                <img src="' . asset('uploads/movie/' . $movie->image) . '"
                                    
                                    class="lazyload blur-up post-thumb" alt="' . $movie->name . '"
                                    title="' .  $movie->name . '" />
                            </div>
                            <h3 class="title">' . $movie->name . '</h3>
                            <p class="original_title">' . $movie->origin_name . '</p>
                        </a>
                        <div class="viewsCount">' . $this->thousandsCurrencyFormat($movie->view_day) . ' lượt xem</div>
                    </div>
            ';
        }
        echo $output;
    }

    public function filterCategoryMovie(Request $request)
    {
        $data = $request->all();
        $category = $data['category'];
        $type = $data['type'];
        if ($type == 'movie' && $category == '55') {
            $listMovies = Movie::with('genres')->whereHas('genres', function ($q) {
                $q->where('genre_id', config('constants.genre_ids.action'));
            })
                ->latest()
                ->where('category_id', config('constants.category_ids.single'))

                ->take(8)
                ->get(['id', 'episode_current', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
        } else if ($type == 'tv_series' && $category == '55') {
            $listMovies = Movie::with('genres')->whereHas('genres', function ($q) {
                $q->where('genre_id', config('constants.genre_ids.action'));
            })
                ->latest()
                ->where('category_id', config('constants.category_ids.series'))
                ->take(8)
                ->get(['id', 'episode_current', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
        } else if ($type == 'tv_series' && $category == '7') {
            $listMovies = Movie::with('genres')->whereHas('genres', function ($q) {
                $q->where('genre_id', config('constants.genre_ids.horrible'));
            })
                ->latest()
                ->where('category_id', config('constants.category_ids.series'))
                ->take(8)
                ->get(['id', 'episode_current', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
        } else {
            $listMovies = Movie::with('genres')->whereHas('genres', function ($q) {
                $q->where('genre_id', config('constants.genre_ids.horrible'));
            })
                ->latest()
                ->where('category_id', config('constants.category_ids.single'))
                ->take(8)
                ->get(['id', 'episode_current', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
        }

        $output = '';

        foreach ($listMovies as $newMovie) {
            $description = Str::limit($newMovie->description, 70, '...');
            $time = $newMovie->time;

            $language = $newMovie->language;
            $quality = $newMovie->quality;

            $genreString = '';
            foreach ($newMovie->genres as $genre) {
                $genreString .= $genre->name . ', ';
            }
            $countryString = '';
            foreach ($newMovie->countries as $country) {
                $countryString .= $country->name . ', ';
            }
            $strCountry = rtrim($countryString, ", ");
            $strGenre = rtrim($genreString, ", ");
            $output .= '
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-' . $newMovie->id . '">
                            <div class="halim-item">
                                <a class="halim-thumb" href="' . route('phim', [$newMovie->slug]) . '"
                                    title="' . $newMovie->name . '">
                                    <figure>
                                        <img class="lazyload blur-up img-responsive" data-sizes="auto"
                                            data-src="' . asset('uploads/movie/' . $newMovie->image) . '"
                                            alt="' . $newMovie->name . ' " title="' . $newMovie->name . '" />
                                    </figure>
                                    <span class="status">
                                       ' . $language . '-' . $quality . '
                                    </span><span class="episode">
                                        ' . $newMovie->episode_current . '
                                    </span>
                                    <div class="icon_overlay" data-html="true" data-toggle="halim-popover"
                                        data-placement="top" data-trigger="hover"
                                        title="<span class=film-title>' . $newMovie->name . '</span>"
                                        data-content="<div class=org-title>' . $newMovie->origin_name . '</div>                            <div class=film-meta>
                      <div class=text-center>
                          <span class=released><i class=hl-calendar></i> ' . $newMovie->year . '</span>                                    <span class=runtime><i class=hl-clock></i> ' . $time . '</span>                                </div>
                      <div class=film-content>
                          ' . $description . '
                      </div>
                      <p class=category>Quốc gia: <span class=category-name>' . $strCountry . '</span></p>                                <p class=category>Thể loại: <span class=category-name>
                        ' . $strGenre . '
                    </span></p>
                  </div>">
                                    </div>

                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title">
                                            <h2 class="entry-title">' . $newMovie->name . '</h2>
                                            <p class="original_title">' . $newMovie->origin_name . '</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
            ';
        }
        echo $output;
    }
    public function actionMovie()
    {
        $listMovies = Cache::remember('listMoviesAction', config('constants.time_cache.time'), function () {
            return Movie::with('genres')->whereHas('genres', function ($q) {
                $q->where('genre_id', config('constants.genre_ids.action'));
            })
                ->latest()
                ->where('category_id', config('constants.category_ids.series'))
                ->take(8)
                ->get(['id', 'episode_current', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
        });

        $output = '';

        foreach ($listMovies as $newMovie) {
            $description = Str::limit($newMovie->description, 70, '...');

            $language = $newMovie->language;
            $quality = $newMovie->quality;

            $genreString = '';
            foreach ($newMovie->genres as $genre) {
                $genreString .= $genre->name . ', ';
            }
            $countryString = '';
            foreach ($newMovie->countries as $country) {
                $countryString .= $country->name . ', ';
            }
            $strCountry = rtrim($countryString, ", ");
            $strGenre = rtrim($genreString, ", ");
            $output .= '
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-' . $newMovie->id . '">
                            <div class="halim-item">
                                <a class="halim-thumb" href="' . route('phim', [$newMovie->slug]) . '"
                                    title="' . $newMovie->name . '">
                                    <figure>
                                        <img class="lazyload blur-up img-responsive" data-sizes="auto"
                                            data-src="' . asset('uploads/movie/' . $newMovie->image) . '"
                                            alt="' . $newMovie->name . ' " title="' . $newMovie->name . '" />
                                    </figure>
                                    <span class="status">
                                       ' . $language . '-' . $quality . '
                                    </span><span class="episode">
                                        ' . $newMovie->episode_current . '
                                    </span>
                                    <div class="icon_overlay" data-html="true" data-toggle="halim-popover"
                                        data-placement="top" data-trigger="hover"
                                        title="<span class=film-title>' . $newMovie->name . '</span>"
                                        data-content="<div class=org-title>' . $newMovie->origin_name . '</div>                            <div class=film-meta>
                      <div class=text-center>
                          <span class=released><i class=hl-calendar></i> ' . $newMovie->year . '</span>                                    <span class=runtime><i class=hl-clock></i> ' . $newMovie->time . '</span>                                </div>
                      <div class=film-content>
                          ' . $description . '
                      </div>
                      <p class=category>Quốc gia: <span class=category-name>' . $strCountry . '</span></p>                                <p class=category>Thể loại: <span class=category-name>
                        ' . $strGenre . '
                    </span></p>
                  </div>">
                                    </div>

                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title">
                                            <h2 class="entry-title">' . $newMovie->name . '</h2>
                                            <p class="original_title">' . $newMovie->origin_name . '</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
            ';
        }
        echo $output;
    }

    public function horribleMovie()
    {
        $listMovies = Cache::remember('listMoviesHorrible', config('constants.time_cache.time'), function () {
            return Movie::with('genres')->whereHas('genres', function ($q) {
                $q->where('genre_id', config('constants.genre_ids.horrible'));
            })
                ->latest()
                ->where('category_id', config('constants.category_ids.single'))
                ->take(8)
                ->get(['id', 'episode_current', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language']);
        });

        $output = '';

        foreach ($listMovies as $newMovie) {
            $description = Str::limit($newMovie->description, 70, '...');

            $language = $newMovie->language;
            $quality = $newMovie->quality;

            $genreString = '';
            foreach ($newMovie->genres as $genre) {
                $genreString .= $genre->name . ', ';
            }
            $countryString = '';
            foreach ($newMovie->countries as $country) {
                $countryString .= $country->name . ', ';
            }
            $strCountry = rtrim($countryString, ", ");
            $strGenre = rtrim($genreString, ", ");
            $output .= '
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-' . $newMovie->id . '">
                            <div class="halim-item">
                                <a class="halim-thumb" href="' . route('phim', [$newMovie->slug]) . '"
                                    title="' . $newMovie->name . '">
                                    <figure>
                                        <img class="lazyload blur-up img-responsive" data-sizes="auto"
                                            data-src="' . asset('uploads/movie/' . $newMovie->image) . '"
                                            alt="' . $newMovie->name . ' " title="' . $newMovie->name . '" />
                                    </figure>
                                    <span class="status">
                                       ' . $language . '-' . $quality . '
                                    </span><span class="episode">
                                        ' . $newMovie->episode_current . '
                                    </span>
                                    <div class="icon_overlay" data-html="true" data-toggle="halim-popover"
                                        data-placement="top" data-trigger="hover"
                                        title="<span class=film-title>' . $newMovie->name . '</span>"
                                        data-content="<div class=org-title>' . $newMovie->origin_name . '</div>                            <div class=film-meta>
                      <div class=text-center>
                          <span class=released><i class=hl-calendar></i> ' . $newMovie->year . '</span>                                    <span class=runtime><i class=hl-clock></i> ' . $newMovie->time . '</span>                                </div>
                      <div class=film-content>
                          ' . $description . '
                      </div>
                      <p class=category>Quốc gia: <span class=category-name>' . $strCountry . '</span></p>                                <p class=category>Thể loại: <span class=category-name>
                        ' . $strGenre . '
                    </span></p>
                  </div>">
                                    </div>

                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title">
                                            <h2 class="entry-title">' . $newMovie->name . '</h2>
                                            <p class="original_title">' . $newMovie->origin_name . '</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
            ';
        }
        echo $output;
    }






    public function thousandsCurrencyFormat($num)
    {

        if ($num > 1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            return $x_display;
        }
        return $num;
    }
}