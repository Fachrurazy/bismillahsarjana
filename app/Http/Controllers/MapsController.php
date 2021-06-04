<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Maps;
use App\Estimation;
use App\Cabang;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Estimation::all();
        return view('maps.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Cabang::where('id', 1)->first();
        return view('maps.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $nama_koordinat = $request->nama_koordinat;
        // $lat = $request->lat;
        // $long = $request->long;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Estimation::findOrFail($id);
        return view('maps.polyline', compact('data'));
    }

    public function polyline()
    {
        return view('maps.polyline');
    }

    public function polyline1()
    {
        return view('maps.polyline1');
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
        Maps::find($id)->delete();
        return redirect()->route('maps.index')->with('success', 'Data Berhasil dihapus');
    }
}
