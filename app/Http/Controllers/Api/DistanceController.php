<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DistanceController extends Controller
{
    public function distance($origin, $destination)
    {
        $response = Http::post('https://maps.googleapis.com/maps/api/distancematrix/json?origins="'.$origin.'"&destinations="'.$destination.'"&key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&language=id-ID&mode=driving')->json();

        return $response;
    }

    public function getDistance(Request $request)
    {
        $gmaps = $this->distance($request->origin, $request->destination);

        $pisah_tujuan = explode("|", $request->destination);
        $tujuan_satu = $pisah_tujuan[0];
        $tujuan_dua = $pisah_tujuan[1];
        // print_r($pisah_tujuan);die();

        $getdistance = $gmaps['rows'][0]['elements'][0]['distance']['text'];
        $getduration = $gmaps['rows'][0]['elements'][0]['duration']['text'];

        // $summary = "Jarak dari ".$request->origin." ke ".$request->destination." adalah ".$getdistance." selama ".$getduration;

        // $jarak = new Jarak();
        // $jarak->asal = $request->origin;
        // $jarak->tujuan = $request->destination;
        // $jarak->jarak = $getdistance;
        // $jarak->durasi = $getduration;
        // $jarak->save();


        return response($gmaps);
    }
}
