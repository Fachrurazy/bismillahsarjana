<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Matrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::select(
            DB::raw("
            select dm.id, c1.Kode_Cabang AS Kode_Origin, c2.Kode_Cabang AS Kode_Destination, dm.Distance
            FROM matrixjarak dm
            INNER JOIN cabang c1
            ON dm.Kode_Origin = c1.id
            INNER JOIN cabang c2
            ON dm.Kode_Destination = c2.id;
            ")
        );
        return view('distancematrix.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Cabang::all();
        return view('distancematrix.create', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_cabang($id){
        $dt = Cabang::where('id', $id)->first();

        return response()->json([
            'data' => $dt
        ]);
    }

    // public function getcabangajax(Request $request){
    //     if ($request->has('q')) {
    //         $cari = $request->q;
    //         $data = Cabang::where('Nama_Cabang', 'LIKE', '%'.$cari.'%')->get();
    //         return response()->json($data);
    //     }
    // }
    public function store(Request $request)
    {
        Matrix::create([
            'Kode_Origin' => $request->get('Kode_Origin'),
            'Kode_Destination' => $request->get('Kode_Destination'),
            'Distance' => $request->get('Distance'),
        ]);
        return redirect('/distancematrix')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function show(Matrix $matrix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function edit(Matrix $matrix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matrix $matrix)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Matrix::find($id)->delete();
        return redirect()->route('distancematrix.index')->with('success', 'Data berhasil dihapus');
    }

    public function distance($alamat1, $alamat2)
    {
        $response = Http::post('https://maps.googleapis.com/maps/api/distancematrix/json?origins="'.$alamat1.'"&destinations="'.$alamat2.'"&key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&language=id-ID&mode=driving')->json();
        
        return $response;
    }

    public function getDistance(Request $request)
    {
            $gmaps = $this->distance($request->alamat1, $request->alamat2);

            $getdistanceval = $gmaps['rows'][0]['elements'][0]['distance']['value'];
            $distance = $getdistanceval / 1000;
            $res = [
                'Kode_Origin' => $request->alamat1,
                'Kode_Destination' => $request->alamat2,
                'Distance' => $distance,
            ];
            echo $res;die();
            $dataCreate = Matrix::create($res);
    }
}
