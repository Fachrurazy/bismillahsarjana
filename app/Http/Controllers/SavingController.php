<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Matrix;
use App\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller
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
            select svm.id, c1.Nama_Cabang AS Nama_Origin, c2.Nama_Cabang AS Nama_Destination, svm.Saving
            FROM savingmatrix svm
            INNER JOIN cabang c1
            ON svm.Kode_Origin = c1.id
            INNER JOIN cabang c2
            ON svm.Kode_Destination = c2.id;
            ")
        );
        sort($datas);
        return view('saving.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = DB::select(
            DB::raw("
            select dm.id, c1.Kode_Cabang AS Kode_Origin, c1.Nama_cabang AS Cabang1, c2.Kode_Cabang AS Kode_Destination, c2.Nama_Cabang AS Cabang2, dm.Distance
            FROM matrixjarak dm
            INNER JOIN cabang c1
            ON dm.Kode_Origin = c1.id
            INNER JOIN cabang c2
            ON dm.Kode_Destination = c2.id;
            ")
        );
        sort($datas);
        return view('saving.create', compact('datas'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_distance($id){
        $dt = Matrix::where('id', $id)->first();

        return response()->json([
            'data' => $dt
        ]);
    }
    public function store(Request $request)
    {
        $distance1 = $request->get('distance1');
        $distance2 = $request->get('distance2');
        $distance3 = $request->get('distance3');
        $saving = $distance1 + $distance2 - $distance3;
        $res = [
            'Kode_Origin' => $request->get('origin3'),
            'Kode_Destination' => $request->get('destination3'),
            'Saving' => $saving,
        ];
        // echo print_r($res);die();
        Saving::create($res);
        return redirect('/saving')->with('success','Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function show(Saving $saving)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function edit(Saving $saving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saving $saving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Saving::find($id)->delete();
        return redirect()->route('saving.index')->with('success', 'Data berhasil dihapus');
    }
}
