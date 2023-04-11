<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryMovie($slug, Request $request)
    {
        $listCategoryBySlug = Category::where('slug', $slug)->first(['id', 'name']);

        $page = request()->has('page') ? request()->get('page') : 1;

        $listMovieByCategory = Cache::remember('listMovieByCategory_' . $slug . '_page_' . $page, config('constants.time_cache.time'), function () use ($listCategoryBySlug) {
            return Movie::with('genres', 'countries')
                ->where('category_id', $listCategoryBySlug->id)
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->paginate(24);
        });

        $this->generateSeoTags($listCategoryBySlug, $request, $slug);

        return view('pages.category', compact(
            'listMovieByCategory',
            'listCategoryBySlug',
        ));
    }

    public function generateSeoTags($listCategoryBySlug, $request, $slug)
    {
        $name = $listCategoryBySlug->name;

        $seo_title = 'Danh sách ' . $name . ' mới nhất năm ' . date('Y') . ', ' . $name . ' hay nhất năm ' . date('Y') . '';
        $seo_des = 'Tuyển tập phim ' . $name . ' mới nhất ' . date('Y') . ', phim ' . $name . ' Mỹ, phim ' . $name . ' Trung Quốc,  phim ' . $name . ' Hàn Quốc, phim ' . $name . ' chọn lọc, cực hay và hấp dẫn nhất...';
        $seo_key = $name;
        $seo_image = url('assets/images/seo_image');

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
