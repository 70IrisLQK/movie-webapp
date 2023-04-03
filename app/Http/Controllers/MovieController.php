<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class MovieController extends Controller
{
    public function movie($slug, Request $request)
    {
        $listMovieBySlug = Movie::with('category', 'countries', 'genres', 'episodes', 'actors', 'directors')
            ->where('slug', $slug)
            ->first();

        //Get 3 episode
        $listEpisode = Episode::with('movie')
            ->where('movie_id', $listMovieBySlug->id)
            ->where('server_id', 1)
            ->orderByRaw("CAST(name as UNSIGNED) DESC")
            ->take(3)
            ->get();

        // List movie relate
        $listMovieRelate = Cache::remember('listMovieRelate', config('constants.time_cache.time'), function () use ($listMovieBySlug, $slug) {
            return Movie::with('category', 'genres', 'countries')
                ->where('category_id', $listMovieBySlug->category->id)
                ->whereNotIn('slug', [$slug])
                ->orderBy(DB::raw('RAND()'))
                ->take(20)
                ->get(['id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current']);
        });
        // FirstEpisode
        $firstEpisode = Episode::with('movie')->where('movie_id', $listMovieBySlug->id)->first();

        $listServer = Server::orderBy('id', 'ASC')->get();

        $listEpisodeServer = Episode::where('movie_id', $listMovieBySlug->id)
            ->orderBy('id', 'ASC')->get()->unique('server_id');

        $listEpisodeMovie = Episode::where('movie_id', $listMovieBySlug->id)
            ->orderBy('id', 'ASC')->get();

        // Rating
        $rating = Rating::where('movie_id', $listMovieBySlug->id)->avg('rating_star');
        $rating = round($rating, 1);
        $countTotal = Rating::where('movie_id', $listMovieBySlug->id)->count();

        $this->generateSeoTagsMovie($request, $listMovieBySlug);

        return view('pages.movie', compact(
            'listMovieBySlug',
            'listMovieRelate',
            'countTotal',
            'firstEpisode',
            'listEpisode',
            'rating',
            'listServer',
            'listEpisodeServer',
            'listEpisodeMovie',
        ));
    }

    public function generateSeoTagsMovie($request, $listMovieBySlug)
    {
        $seo_title = '' . $listMovieBySlug->name . ' HD VietSub - Thuyết Minh - ' . $listMovieBySlug->origin_name . '';
        $seo_des = Str::limit($listMovieBySlug->description, 150, '...');
        $seo_key = $listMovieBySlug->name;
        $seo_image = url('uploads/movie' . $listMovieBySlug->image);

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

    public function mostMovie(Request $request)
    {
        $page = request()->has('page') ? request()->get('page') : 1;

        $listMostMovie = Cache::remember('listMostMovie' . '_page_' . $page, config('constants.time_cache.time'), function () {
            return Movie::with('genres', 'countries')
                ->orderBy('view', 'DESC')
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->paginate(24);
        });

        $this->generateSeoTags($request);

        return view('pages.most-movie', compact(
            'listMostMovie',
        ));
    }

    public function newMovie(Request $request)
    {
        $page = request()->has('page') ? request()->get('page') : 1;

        $listNewMovie = Cache::remember('listNewMovie' . '_page_' . $page, config('constants.time_cache.time'), function () {
            return Movie::with('genres', 'countries')
                ->latest()
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->paginate(24);
        });

        $this->generateSeoTags($request);

        return view('pages.new-movie', compact(
            'listNewMovie',
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
}