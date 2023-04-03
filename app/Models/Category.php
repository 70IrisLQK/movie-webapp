<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    use HasFactory;
}