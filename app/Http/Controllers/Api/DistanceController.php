<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Cabang;
use App\Vertex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Estimation;
use App\Matrix;
use PhpParser\Node\Stmt\TryCatch;
use SplPriorityQueue;


class DistanceController extends Controller
{
    public function distance($origin, $destination)
    {
        $response = Http::post('https://maps.googleapis.com/maps/api/distancematrix/json?origins="'.$origin.'"&destinations="'.$destination.'"&key=AIzaSyBq2AKHpAN4gHaEYP5Uq-LNFAsQvPlGAUc&language=id-ID&mode=driving')->json();
        
        return $response;
    }
    public function vertex(Request $request)
    {
        set_time_limit(5000);
        $gmaps = $this->distance($request->origin, $request->destination);
        // return $gmaps;
        
        $dt = Cabang::all();
        // return $dt;
        $initialnama = $dt[0]['Nama_Cabang']; 
        $initialcabang = $dt[0]['Alamat'];
        $initialcount = 0;  
        $j = 0;
        $hasil = [];
        for ($i=0; $i < count($dt) * count($dt); $i++) { 
            // echo $dt[$i]['Alamat'];
            $namacabang = $this->distance($initialnama, $dt[$initialcount]['Nama_Cabang']);
            $result = $this->distance($initialcabang, $dt[$initialcount]['Alamat']);
            $getdistanceval = $result['rows'][0]['elements'][0]['distance']['value'];

            // 117063
            if ($getdistanceval < 110000) 
            {
                Vertex::create([
                    'origin' => strval($initialnama),
                    'destination' => strval($dt[$initialcount]['Nama_Cabang']),
                    'distanceval' => $getdistanceval
                ]);
                // // print_r($initialcabang);
                // // echo " - ";
                // // print_r($getdistanceval);
                // array_push($hasil,$getdistanceval);
                // // echo " - ";
                // // print_r($dt[$initialcount]['Alamat']);
                // echo "<br>";
            }
            
            $initialcount++;
            if (count($dt) == $initialcount) 
            {
                $initialcount = 0;
                $j = $j + 1;
                // print_r($initialcabang);
                if ($j == 27) 
                {
                    break;
                }
                else 
                {
                    $initialcabang = $dt[$j]['Alamat'];
                    $initialnama = $dt[$j]['Nama_Cabang'];
                }
            }
        }
        // return json_encode($hasil);
    }

    public function getDistance(Request $request)
    {
        $rules = [
            'ID1' => 'required',
            'ID2' => 'required',
        ];
 
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            $gmaps = $this->distance($request->origin, $request->destination);

            $getdistanceval = $gmaps['rows'][0]['elements'][0]['distance']['value'];
            $distance = $getdistanceval / 1000;

            Matrix::create([
                'Kode_Origin' => $request->ID1,
                'Kode_Destination' => $request->ID2,
                'Distance' => $distance,
            ]);
            return redirect()->route('distancematrix.index')->with('success', 'Data berhasil ditambahkan');
    }

    // public function getDistance(Request $request)
    // {
    //     // print_r($request->all());die();
    //     if ($request->destination1 == "" && $request->destination2 == "") {
    //         $gmaps = $this->distance($request->origin, $request->destination);

    //         $getdistance = $gmaps['rows'][0]['elements'][0]['distance']['text'];
    //         $getdistanceval = $gmaps['rows'][0]['elements'][0]['distance']['value'];
    //         $getduration = $gmaps['rows'][0]['elements'][0]['duration']['text'];
    //         $getdurationval = $gmaps['rows'][0]['elements'][0]['duration']['value'];

    //         $res = [
    //             'origin' => $request->origin,
    //             'destination' => $request->destination,
    //             'distance' => $getdistance,
    //             'distance_value' => $getdistanceval,
    //             'duration' => $getduration,
    //             'duration_value' => $getdurationval,
    //         ];

    //         $dataCreate = Estimation::create($res);
    //         $response_data_res = $dataCreate;
    //         // $estimate = 'Jarak dari '.$request->origin.' ke '.$request->destination.' adalah '.$getdistance;
    //         // // echo $estimate;die();
    //     } elseif ($request->destination2 == "") {
    //         $gmaps = $this->distance($request->origin, $request->destination);
    //         $gmaps1 = $this->distance($request->destination, $request->destination1);
            
    //         $getdistance = $gmaps['rows'][0]['elements'][0]['distance']['text'];
    //         $getdistanceval = $gmaps['rows'][0]['elements'][0]['distance']['value'];
    //         $getduration = $gmaps['rows'][0]['elements'][0]['duration']['text'];
    //         $getdurationval = $gmaps['rows'][0]['elements'][0]['duration']['value'];
            
    //         $getdistance1 = $gmaps1['rows'][0]['elements'][0]['distance']['text'];
    //         $getdistanceval1 = $gmaps1['rows'][0]['elements'][0]['distance']['value'];
    //         $getduration1 = $gmaps1['rows'][0]['elements'][0]['duration']['text'];
    //         $getdurationval1 = $gmaps1['rows'][0]['elements'][0]['duration']['value'];

    //         $res = [
    //             'origin' => $request->origin,
    //             'destination' => $request->destination,
    //             'distance' => $getdistance,
    //             'distance_value' => $getdistanceval,
    //             'duration' => $getduration,
    //             'duration_value' => $getdurationval,
    //         ];

    //         $res1 = [
    //             'origin' => $request->destination,
    //             'destination' => $request->destination1,
    //             'distance' => $getdistance1,
    //             'distance_value' => $getdistanceval1,
    //             'duration' => $getduration1,
    //             'duration_value' => $getdurationval1,
    //         ];

    //         $dataCreate = Estimation::create($res);
    //         $dataCreate1 = Estimation::create($res1);
            

    //         $response_data_res = [
    //             $dataCreate,
    //             $dataCreate1
    //         ];
    //     }
    //     return response($response_data_res);
    // }

    

    // public function hasil($origin, $destination)
    // {
    //     // $estimate = new Estimation();
    //     // $estimate->origin = $request->origin;
    //     // $estimate->destination = $request->destination;
    //     $response = [$origin, $destination];
    //     return response($response);die();
        
        
    //     $graph = new Graph();
    //     $graph->add_vertex( 'Cikaret', array( 'Jatijajar' => 10511, 'Cilodong' => 3781, 'Citayam' => 8118, 'Karadenan' => 10181 ) );
    //     $graph->add_vertex( 'Jatijajar', array( 'Cikaret' => 10511, 'Cilodong' => 7889, 'Babakanmadang' => 22707 ) );
    //     $graph->add_vertex( 'Cilodong', array( 'Jatijajar' => 7889, 'Cikaret' => 3781, 'Citayam' => 10263 ) );
    //     $graph->add_vertex( 'Citayam', array( 'Cikaret' => 8118, 'Cilodong' => 10263, 'Karadenan' => 8339 ) );
    //     $graph->add_vertex( 'Karadenan', array( 'Cikaret' => 1081, 'Citayam' => 8339, 'Babakanmadang' => 12102  ) );
    //     $graph->add_vertex( 'Babakanmadang', array( 'Karadenan' => 12102, 'Jatijajar' => 22707) );

    //     // print_r($graph->shortest_path($estimate->origin, $estimate->destination));
    //     // $hasil = [$graph->shortest_path($estimate->origin, $estimate->destination)];
    //     // return response($graph->shortest_path($estimate->origin, $estimate->destination));
    // }

}