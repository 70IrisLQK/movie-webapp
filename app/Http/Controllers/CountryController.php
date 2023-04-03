<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Movie;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CountryController extends Controller
{
    public function countryMovie($slug, Request $request)
    {
        $listCountryBySlug = Country::where('slug', $slug)->first();

        $page = request()->has('page') ? request()->get('page') : 1;

        $listMovieByCountry = Cache::remember('listMovieByCountry' . '_page_' . $page, config('constants.time_cache.time'), function () use ($listCountryBySlug) {
            return Movie::with('countries')->whereHas('countries', function ($q) use ($listCountryBySlug) {
                $q->where('country_id', $listCountryBySlug->id);
            })
                ->latest()
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->paginate(24);
        });

        $this->generateSeoTags($listCountryBySlug, $request, $slug);

        return view('pages.country', compact(
            'listMovieByCountry',
            'listCountryBySlug',
        ));
    }

    public function generateSeoTags($listCountryBySlug, $request, $slug)
    {
        $name = $listCountryBySlug->name;

        $seo_title = 'Danh sách ' . $name . ' mới nhất năm ' . date('Y') . ', ' . $name . ' hay nhất năm ' . date('Y') . '';
        $seo_des = 'Danh sách phim ' . $name . ' mới nhất, hay nhất, hot nhất ' . date('Y') . ':  ...';
        $seo_key = $name;
        $seo_image = url('assets/images/seo_image.png');

        SEOMeta::setTitle($seo_title, false)
            ->setDescription($seo_des)
            ->addKeyword([$seo_key, $slug])
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