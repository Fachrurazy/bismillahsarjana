<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Estimation;
use SplPriorityQueue;


class DistanceController extends Controller
{
    public function distance($origin, $destination)
    {
        $response = Http::post('https://maps.googleapis.com/maps/api/distancematrix/json?origins="'.$origin.'"&destinations="'.$destination.'"&key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&language=id-ID&mode=driving')->json();
        
        return $response;
    }

    // public function compare( $priority1, $priority2 )
    // {
    //     if ($priority1 === $priority2) return 0;
    //     return $priority1 < $priority2 ? 1 : -1;
    // }

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
            // $estimate = 'Jarak dari '.$request->origin.' ke '.$request->destination.' adalah '.$getdistance;
            // // echo $estimate;die();
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
        return response($response_data_res);
    }

    

    public function hasil($origin, $destination)
    {
        // $estimate = new Estimation();
        // $estimate->origin = $request->origin;
        // $estimate->destination = $request->destination;
        $response = [$origin, $destination];
        return response($response);die();
        
        
        $graph = new Graph();
        $graph->add_vertex( 'Cikaret', array( 'Jatijajar' => 10511, 'Cilodong' => 3781, 'Citayam' => 8118, 'Karadenan' => 10181 ) );
        $graph->add_vertex( 'Jatijajar', array( 'Cikaret' => 10511, 'Cilodong' => 7889, 'Babakanmadang' => 22707 ) );
        $graph->add_vertex( 'Cilodong', array( 'Jatijajar' => 7889, 'Cikaret' => 3781, 'Citayam' => 10263 ) );
        $graph->add_vertex( 'Citayam', array( 'Cikaret' => 8118, 'Cilodong' => 10263, 'Karadenan' => 8339 ) );
        $graph->add_vertex( 'Karadenan', array( 'Cikaret' => 1081, 'Citayam' => 8339, 'Babakanmadang' => 12102  ) );
        $graph->add_vertex( 'Babakanmadang', array( 'Karadenan' => 12102, 'Jatijajar' => 22707) );

        // print_r($graph->shortest_path($estimate->origin, $estimate->destination));
        // $hasil = [$graph->shortest_path($estimate->origin, $estimate->destination)];
        // return response($graph->shortest_path($estimate->origin, $estimate->destination));
    }

}