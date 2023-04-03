<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Movie;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  slug : string
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $director = Director::where('slug', $slug)->first();
        $name = $director->name;
        $listMovies = Movie::with('countries', 'genres', 'directors')
            ->whereHas('directors', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->latest()
            ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
            ->paginate(24);

        $this->generateSeoTags($request, $name);

        return view('pages.director', compact(
            'listMovies',
            'slug','name'
        ));
    }

    public function generateSeoTags($request, $name)
    {
        $seo_title = 'Tổng hợp phim của ' . $name . ' hay nhất, ' . 'phim ' . $name . ' mới nhất năm ' . date("Y");
        $seo_des = 'Danh sách phim của đạo diễn ' . $name . ' mới nhất, hot nhất ' . date("Y") . ': ';
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