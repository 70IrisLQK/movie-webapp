<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

use App\Models\Movie;

class YearController extends Controller
{
    public function yearMovie($year, Request $request)
    {
        $listMovies = Movie::with('genres', 'countries')
            ->where('year', $year)
            ->orderBy('name', 'DESC')
            ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
            ->paginate(24);

        $this->generateSeoTags($request, $year);

        return view('pages.year', compact(
            'listMovies',
            'year',
        ));
    }

    public function generateSeoTags($request, $year)
    {
        $seo_title = 'Phim Hay | Phim HD Vietsub | Xem Phim Online | Xem Phim Nhanh | Phim Chill Alone - PhimChilla năm ' . $year;
        $seo_des = 'Xem phim hay nhất ' . $year . ' cập nhật nhanh nhất, Xem Phim Online HD Vietsub - Thuyết Minh tốt trên nhiều thiết bị. ';
        $seo_key = 'PhimChilla.com năm ' . $year;
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