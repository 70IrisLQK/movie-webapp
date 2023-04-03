<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    protected $table = 'countries';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
    use HasFactory;
}