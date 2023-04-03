<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class FilterController extends Controller
{

    public function liveSearchMovie(Request $request)
    {
        $data = $request->all();
        $output = '';
        $search = $data['search'];

        if (isset($search)) {
            $listMovieBySearch = Movie::with('category', 'genres', 'countries', 'episodes')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('origin_name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('actors', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('directors', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->latest()
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->take(10)->get();

            $output = '<li>Kết quả tìm kiếm: <strong style="color: red;">' . $search . '</strong></li>';

            foreach ($listMovieBySearch as $movie) {
                $output .= '
            <li class="exact_result"><a href="' . route('phim', [$movie->slug]) . '">
                                <div class="halim_list_item">
                                <div class="image"><img src="' . asset('uploads/movie/' . $movie->image) . '" alt="' . $movie->name . '"></div>
                                <span class="label"> ' . $movie->name . '</span>
                                <span class="enName">' . $movie->origin_name . '</span>
                                <span class="date">' . $movie->year . '</span>
                                </div>
                            </a></li>';
            };
        } else {
            $output = '<li>Vui lòng nhập một từ khóa</li>';
        }
        return $output;
    }

    public function azList($az, Request $request)
    {
        $this->generateSeoTags($request);

        if ($az == 'all') {
            $listMovieBySearch = Movie::with('category', 'countries', 'genres', 'episodes')
                ->latest()
                ->paginate(28);

            return view('pages.az-list', compact('listMovieBySearch', 'az'));
        } else {
            $listMovieBySearch = Movie::with('category', 'countries', 'genres', 'episodes')
                ->where('name', 'LIKE', $az . '%')
                ->latest()
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->paginate(28);

            return view('pages.az-list', compact(
                'listMovieBySearch',
                'az',
            ));
        }
    }

    public function filter(Request $request)
    {

        $order = $_GET['sort'];
        $genre = $_GET['category'];
        $category = $_GET['formality'];
        $country = $_GET['country'];
        $year = $_GET['release'];

        if (empty($order) && empty($genre) && empty($country) && empty($year)) {
            return redirect()->back();
        } else {
            $listMovies = Movie::with('genres', 'countries');

            if ($genre) {
                $listMovies = $listMovies->whereHas('genres', function ($q) use ($genre) {
                    $q->where('genre_id', $genre);
                });
            }
            if ($country) {
                $listMovies = $listMovies->whereHas('countries', function ($q) use ($country) {
                    $q->where('country_id', $country);
                });
            }
            if ($category) {
                $listMovies = $listMovies->where('category_id', $category);
            }
            if ($year) {
                $listMovies = $listMovies->where('year', intval($year));
            }
            if ($order) {
                switch ($order) {
                    case 'date':
                        $listMovies = $listMovies->latest();
                        break;
                    case 'year_release':
                        $listMovies = $listMovies->orderBy('year', 'DESC');
                        break;
                    case 'name_a_z':
                        $listMovies = $listMovies->orderBy('name', 'DESC');
                        break;
                    case 'watch_views':
                        $listMovies = $listMovies->orderBy('view', 'DESC');
                        break;
                    default:
                        break;
                }
            }

            $listMovies = $listMovies
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->paginate(24);
            $this->generateSeoTags($request);

            return view('pages.filter', compact(
                'listMovies',
            ));
        }
    }

    public function searchMovie(Request $request)
    {
        if (isset($_GET['s'])) {
            $search = $_GET['s'];

            $listMovieBySearch = Movie::with('category', 'countries', 'genres', 'episodes')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('origin_name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('actors', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('directors', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->latest()
                ->select('id', 'time', 'year', 'description', 'slug', 'name', 'image', 'origin_name', 'quality', 'language', 'episode_current')
                ->paginate(24);
            $this->generateSeoTags($request);
            return view('pages.search', compact(
                'listMovieBySearch',
                'search',
            ));
        } else {
            return redirect()->to('/');
        }
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