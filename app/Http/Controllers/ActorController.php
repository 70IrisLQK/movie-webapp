<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $actor = Actor::where('slug', $slug)->first();
        $name = $actor->name;

        $listMovies = Movie::with('countries', 'genres', 'actors')
            ->whereHas('actors', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->latest()
            ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
            ->paginate(24);

        $this->generateSeoTags($name, $request, $slug);

        return view('pages.actor', compact(
            'listMovies',
            'slug',
            'name'
        ));
    }

    public function generateSeoTags($name, $request, $slug)
    {

        $seo_title = 'Tổng hợp phim của ' . $name . ' hay nhất, ' . 'phim ' . $name . ' mới nhất năm ' . date("Y");
        $seo_des = 'Danh sách phim của diễn viên ' . $name . ' mới nhất, hot nhất ' . date("Y") . ': ';
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