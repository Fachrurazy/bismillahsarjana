<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = Cabang::get();
        $route = Route::get();
        return view('dijkstra.index', compact('cabang','route'));
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
        // print_r($_POST);die;
        $origin = Cabang::find($request->origin);
        $destination1 = Cabang::find($request->destination1);
        $destination2 = Cabang::find($request->destination2);

        $route = new Route();
        $route->name = $origin->Nama_Cabang." - ".$destination1->Nama_Cabang." - ".$destination2->Nama_Cabang;
        $route->origin = $origin->Alamat;
        $route->origin_lat = $origin->Latitude;
        $route->origin_long = $origin->Longitude;
        $route->first_destination = $destination1->Alamat;
        $route->first_destination_lat = $destination1->Latitude;
        $route->first_destination_long = $destination1->Longitude;
        $route->last_destination = $destination2->Alamat;
        $route->last_destination_lat = $destination2->Latitude;
        $route->last_destination_long = $destination2->Longitude;
        $route->save();
        return redirect('/dijkstra/index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::find($id);
        return view('dijkstra.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function routedetail($id)
    {
        print_r('dijkstra.show');die();
        $route = Route::find($id);
        return view('dijkstra.show', compact('route'));
    }
}
