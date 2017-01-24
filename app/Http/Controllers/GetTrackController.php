<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class getTrackController extends Controller
{
    public function indexTrack()
    {
        return view('getTrack');
    }

    public function showTrack()
    {
        $data = $_POST;
        $track = $data['track'];
        $location = DB::table('orders_accepted')
            ->select('location')
            ->where('trackcode', '=', $track)
            ->first();
        if ($location != NULL) {
            $ex_location = explode("#", $location->location);
            return view('getTrack', ['location' => $ex_location]);
        }
        return $this->indexTrack();
    }
}
