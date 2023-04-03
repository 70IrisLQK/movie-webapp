<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episodes';

    public $timestamps = false;

    protected $guarded = ['id'];


    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    use HasFactory;
}