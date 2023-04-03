<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = \App::make('sitemap');

        // add home pages mặc định
        $sitemap->add(URL::to('/'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');

        $sitemap->add(env('APP_URL') . "/moi-cap-nhat", Carbon::now('Asia/Ho_Chi_Minh'), '0.9', 'daily');
        $sitemap->add(env('APP_URL') . "/xem-nhieu", Carbon::now('Asia/Ho_Chi_Minh'), '0.9', 'daily');

        $genres = Genre::latest()->get();
        foreach ($genres as $genre) {
            $sitemap->add(env('APP_URL') . "/the-loai/" . $genre->slug, Carbon::now('Asia/Ho_Chi_Minh'), '0.9', 'daily');
        }

        $categories = Category::latest()
            ->get();
        foreach ($categories as $category) {
            $sitemap->add(env('APP_URL') . "/loai-phim/" . $category->slug, Carbon::now('Asia/Ho_Chi_Minh'), '0.9', 'daily');
        }

        $countries = Country::latest()
            ->get();
        foreach ($countries as $country) {
            $sitemap->add(env('APP_URL') . "/quoc-gia/" . $country->slug, Carbon::now('Asia/Ho_Chi_Minh'), '0.9', 'daily');
        }

        for ($i = 2000; $i <= 2023; $i++) {
            $sitemap->add(env('APP_URL') . "/nam/" . $i, Carbon::now('Asia/Ho_Chi_Minh'), '0.9', 'daily');
        }

        $movies = Movie::latest()
            ->get();
        foreach ($movies as $movie) {
            $sitemap->add(env('APP_URL') . "/phim/" . $movie->slug, Carbon::now('Asia/Ho_Chi_Minh'), '0.8', 'daily');
        }

        //Get episode;
        $episodes = Episode::all();
        foreach ($movies as $movie) {
            foreach ($episodes as $episode) {
                if ($movie->id == $episode->movie_id) {
                    $sitemap->add(env('APP_URL') . "/xem-phim/" . $movie->slug . "/tap-" . $episode->slug . "/server-" . $episode->server_id, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
                }
            }
        }

        $sitemap->store('xml', 'sitemap');
        if (file_exists(public_path() . '/sitemap.xml')) {
            chmod(public_path() . '/sitemap.xml', 0777);
        }
    }
}