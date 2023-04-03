<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        $data = $request->all();

        $newReport = new Report();
        $newReport->movie_id = $data['id_post'];
        $newReport->episode_id = $data['episode'];
        $newReport->server_name = $data['server'];
        $newReport->movie_name = $data['post_name'];
        $newReport->error_url = $data['halim_error_url'];
        $newReport->content = $data['content'];
        $newReport->username = $data['name'];
        $newReport->issues = $data['issues'];
        $newReport->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $newReport->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $newReport->save();
    }
}