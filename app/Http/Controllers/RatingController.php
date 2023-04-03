<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function ratingMovie(Request $request)
    {
        $data = $request->all();
        $ipAddress = $request->ip();
        $ratingCount = Rating::where('movie_id', $data['movie_id'])->where('ip_address', $ipAddress)->count();
        if ($ratingCount > 0) {
            echo 'Voted';
        } else {
            $newRating = new Rating();
            $newRating->rating_star = $data['value'];
            $newRating->movie_id = $data['movie_id'];
            $newRating->ip_address = $ipAddress;
            $newRating->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $newRating->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $newRating->save();
            echo 'Vote';
        }
    }
}