<?php

namespace App\Http\Controllers;

use App\Distance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('distance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_koordinat' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        Maps::create([
            'nama_koordinat' => $request->get('nama_koordinat'),
            'lat' => $request->get('lat'),
            'long' => $request->get('long'),
        ]);
        return redirect('/maps')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function show(Distance $distance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function edit(Distance $distance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distance $distance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distance $distance)
    {
        //
    }

    public function distance(Request $request)
    {
        $origin = $request->origin;
        $destination = $request->destination;

        $response = Http::post('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$origin.'&destinations='.$destination.'&key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk');

        return response()->json($response);
    }
}