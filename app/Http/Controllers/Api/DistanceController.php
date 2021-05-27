<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Estimation;

class DistanceController extends Controller
{
    public function distance($origin, $destination)
    {
        $response = Http::post('https://maps.googleapis.com/maps/api/distancematrix/json?origins="'.$origin.'"&destinations="'.$destination.'"&key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&language=id-ID&mode=driving')->json();
        
        return $response;
    }

    public function getDistance(Request $request)
    {
        // print_r($request->all());die();
        if ($request->destination1 == "" && $request->destination2 == "") {
            $gmaps = $this->distance($request->origin, $request->destination);

            $getdistance = $gmaps['rows'][0]['elements'][0]['distance']['text'];
            $getdistanceval = $gmaps['rows'][0]['elements'][0]['distance']['value'];
            $getduration = $gmaps['rows'][0]['elements'][0]['duration']['text'];
            $getdurationval = $gmaps['rows'][0]['elements'][0]['duration']['value'];

            $res = [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'distance' => $getdistance,
                'distance_value' => $getdistanceval,
                'duration' => $getduration,
                'duration_value' => $getdurationval,
            ];

            $dataCreate = Estimation::create($res);
            $response_data_res = $dataCreate;
        } elseif ($request->destination2 == "") {
            $gmaps = $this->distance($request->origin, $request->destination);
            $gmaps1 = $this->distance($request->destination, $request->destination1);
            
            $getdistance = $gmaps['rows'][0]['elements'][0]['distance']['text'];
            $getdistanceval = $gmaps['rows'][0]['elements'][0]['distance']['value'];
            $getduration = $gmaps['rows'][0]['elements'][0]['duration']['text'];
            $getdurationval = $gmaps['rows'][0]['elements'][0]['duration']['value'];
            
            $getdistance1 = $gmaps1['rows'][0]['elements'][0]['distance']['text'];
            $getdistanceval1 = $gmaps1['rows'][0]['elements'][0]['distance']['value'];
            $getduration1 = $gmaps1['rows'][0]['elements'][0]['duration']['text'];
            $getdurationval1 = $gmaps1['rows'][0]['elements'][0]['duration']['value'];

            $res = [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'distance' => $getdistance,
                'distance_value' => $getdistanceval,
                'duration' => $getduration,
                'duration_value' => $getdurationval,
            ];

            $res1 = [
                'origin' => $request->destination,
                'destination' => $request->destination1,
                'distance' => $getdistance1,
                'distance_value' => $getdistanceval1,
                'duration' => $getduration1,
                'duration_value' => $getdurationval1,
            ];

            $dataCreate = Estimation::create($res);
            $dataCreate1 = Estimation::create($res1);
            
            $response_data_res = [
                $dataCreate,
                $dataCreate1
            ];
        }
        
        // $gmaps = $this->distance($request->origin, $request->destination, $request->destination1);
        // // print_r($gmaps['destination_addresses'][0]);die();
        // // $pisah_tujuan = explode("|", $gmaps['destination_addresses']);
        // // $tujuan_satu = $pisah_tujuan[0];
        // // $tujuan_dua = $pisah_tujuan[1];

        // $getdistance = $gmaps['rows'][0]['elements'][0]['distance']['text'];
        // $getdistanceval = $gmaps['rows'][0]['elements'][0]['distance']['value'];
        // $getduration = $gmaps['rows'][0]['elements'][0]['duration']['text'];
        // $getdurationval = $gmaps['rows'][0]['elements'][0]['duration']['value'];

        // // $summary = "Jarak dari ".$request->origin." ke ".$request->destination." adalah ".$getdistance." selama ".$getduration;

        // // $jarak = new Jarak();
        // // $jarak->asal = $request->origin;
        // // $jarak->tujuan = $request->destination;
        // // $jarak->jarak = $getdistance;
        // // $jarak->durasi = $getduration;
        // // $jarak->save();
        // $dataCreate = Estimation::create([
        //     'origin' => $request->origin,
        //     'destination' => $request->destination,
        //     'distance' => $getdistance,
        //     'distance_value' => $getdistanceval,
        //     'duration' => $getduration,
        //     'duration_value' => $getdurationval,
        // ]);
        return response($response_data_res);
    }


}
