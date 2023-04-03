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

class WatchController extends Controller
{
    public function watch($slug, $episode, $server, Request $request)
    {
        $listMovieBySlug = Movie::with('category', 'countries', 'genres')->where('slug', $slug)->first();

        // List movie relate9
        $listMovieRelate = Cache::remember('listMovieRelateEpisode', 5 * 60, function () use ($listMovieBySlug, $slug) {
            return Movie::with('category', 'genres', 'countries')
                ->where('category_id', $listMovieBySlug->category->id)
                ->whereNotIn('slug', [$slug])
                ->orderBy(DB::raw('RAND()'))
                ->take(24)->get();
        });

        if (isset($episode)) {
            $episode = $episode;
            $episode = substr($episode, 4, 20);
            $server = substr($server, 7, 20);
            $firstEpisode = Episode::with('movie')
                ->where('movie_id', $listMovieBySlug->id)
                ->where('slug', 'like', '%' . $episode . '%')
                ->where('server_id', $server)
                ->first();
            $lastEpisode = Episode::with('movie')
                ->where('movie_id', $listMovieBySlug->id)
                ->where('slug', 'like', '%' . $episode . '%')
                ->where('server_id', $server)
                ->orderBy('id', 'DESC')
                ->first();
        } else {
            $episode = strlen($episode) >= 4 ? substr($episode, 4, 20) : 1;
            $server = 1;
            $firstEpisode = Episode::with('movie')->where('movie_id', $listMovieBySlug->id)->where('name', $episode)->where('server_id', $server)->first();
            $lastEpisode = Episode::with('movie')->where('movie_id', $listMovieBySlug->id)->where('name', $episode)->orderBy('id', 'DESC')->first();
        }
        $serverActive = $server;
        // List server 
        $listServer = Server::orderBy('id', 'ASC')->get();
        $listEpisodeServer = Episode::where('movie_id', $listMovieBySlug->id)->orderBy('id', 'ASC')->get()->unique('server_id');
        $listEpisodeMovie = Episode::where('movie_id', $listMovieBySlug->id)->orderBy('id', 'ASC')->get();

        $listEpisode = Episode::where('movie_id', $listMovieBySlug->id)->where('slug', $episode)->where('server_id', $server)
            ->first();

        // Rating
        $rating = Rating::where('movie_id', $listMovieBySlug->id)->avg('rating_star');
        $rating = round($rating, 1);
        $countTotal = Rating::where('movie_id', $listMovieBySlug->id)->count();

        $listMovieBySlug->increment('view', 1);
        $listMovieBySlug->increment('view_day', 1);
        $listMovieBySlug->increment('view_week', 1);
        $listMovieBySlug->increment('view_month', 1);

        $this->generateSeoTagsMovie($request, $listMovieBySlug);

        return view('pages.watch', compact(
            'listMovieRelate',
            'listMovieBySlug',
            'listEpisode',
            'episode',
            'slug',
            'rating',
            'countTotal',
            'firstEpisode',
            'lastEpisode',
            'listServer',
            'listEpisodeServer',
            'listEpisodeMovie',
            'serverActive',
        ));
    }

    public function generateSeoTagsMovie($request, $listMovieBySlug)
    {
        $seo_title = 'Xem phim ' . $listMovieBySlug->name . ' HD VietSub - Thuyết Minh - ' . $listMovieBySlug->origin_name . '';
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
}