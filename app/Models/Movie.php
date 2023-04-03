<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'slug', 'title', 'origin_name', 'description', 'country_id', 'genre_id',
        'category_id', 'actor', 'director', 'year', 'time', 'view', 'status', 'status_movie', 'most_view', 'lang', 'episode_total', 'episode_current', 'image', 'link_image', 'tags',
        'created_at', 'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'movie_country');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class);
    }
}