<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    use HasFactory;
}