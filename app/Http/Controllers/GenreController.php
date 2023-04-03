<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function genreMovie($slug, Request $request)
    {
        $listGenreBySlug = Genre::where('slug', $slug)->first();

        $page = request()->has('page') ? request()->get('page') : 1;

        $listMovies = Cache::remember('listMoviesByGenre' . '_page_' . $page, config('constants.time_cache.time'), function () use ($listGenreBySlug) {
            return Movie::with('genres')->whereHas('genres', function ($q) use ($listGenreBySlug) {
                $q->where('genre_id', $listGenreBySlug->id);
            })
                ->latest()
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')

                ->paginate(24);
        });

        $this->generateSeoTags($listGenreBySlug, $request);

        return view('pages.genre', compact(
            'listMovies',
            'listGenreBySlug',
        ));
    }


    public function generateSeoTags($listGenreBySlug, $request)
    {
        $name = $listGenreBySlug->name;

        $seo_title = 'Danh sách ' . $name . ' mới nhất năm ' . date('Y') . ', ' . $name . ' hay nhất năm ' . date('Y') . '';
        $seo_des = 'Tuyển tập phim ' . $name . ' mới nhất ' . date('Y') . ', phim ' . $name . ' hay nhất, phim ' . $name . ' hot nhất, phim ' . $name . ' chọn lọc, cực hay và hấp dẫn nhất...';
        $seo_key = $name;
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