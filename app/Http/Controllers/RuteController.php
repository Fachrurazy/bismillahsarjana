<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Rute;
use App\Rute_Detail;
use App\RuteDetail;
use App\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Rute::all();
        return view('rute.index', compact('datas'));
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
            select svm.id, c1.Kode_Cabang AS Kode_Origin, c2.Kode_Cabang AS Kode_Destination, svm.Saving
            FROM savingmatrix svm
            INNER JOIN cabang c1
            ON svm.Kode_Origin = c1.id
            INNER JOIN cabang c2
            ON svm.Kode_Destination = c2.id;
            ")
        );
        // return $datas;
        // $cabang = Cabang::where('id', 1)->first();
        return view('rute.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function get_cabang($Kode_Cabang){
        $dt = Cabang::where('Kode_Cabang', $Kode_Cabang)->first();

        return response()->json([
            'data' => $dt
        ]);
    }

    public function getcabangajax(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = Cabang::where('Nama_Cabang', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
        }
    }

    public function store(Request $request)
    {
            $getRow = Rute::orderBy('Kelompok', 'DESC')->get();
            $rowCount = $getRow->count();
            $lastId = $getRow->first();
            $kode="RUTE01";

            if($rowCount > 0){
                $strKode = substr($lastId->Kelompok, 4, 2);
                if ($strKode <= 9){
                    $kode = "RUTE0".''.($strKode + 1);
                }elseif($strKode < 20){
                    $kode = "RUTE1".''.($strKode + 1);
                }
            }
            // return $kode;die();
            $cabang = $request->cabang;
            try{
            DB::transaction(function()use($cabang,$kode) {
                $header = Rute::insertGetId([
                    'Kelompok' => $kode,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                foreach ($cabang as $cbg){
                    Rute_Detail::insert([
                        'id_rute' => $header,
                        'id_cabang' => $cbg,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            });
            return redirect()->route('rute.index')->with('success', 'Rute Berhasil Dibentuk!');
        }catch(Exception $ex){
            $request->session()->flash('error', $ex->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dt = Rute::find($id);
        $cabang = [];
        $latAsal = $dt->getdetail[0]->cabangs->Latitude;
        $lonAsal = $dt->getdetail[0]->cabangs->Longitude;

        for ($i=1; $i < count($dt->getdetail); $i++) { 
            array_push($cabang, 
            [
                'kc' => $dt->getdetail[$i]->cabangs->Kode_Cabang,
                'nc' => $dt->getdetail[$i]->cabangs->Nama_Cabang,
                'lat' => $dt->getdetail[$i]->cabangs->Latitude, 
                'long' => $dt->getdetail[$i]->cabangs->Longitude
            ]);
        }

        $result = [];
        for ($i=0; $i < count($cabang); $i++) { 
            $latTujuan = $cabang[$i]['lat'];
            $lonTujuan = $cabang[$i]['long']; 
            $lingkarBumi = 111.319;
            $calcLatAsalTujuan = $latTujuan - $latAsal;
            $calcLonAsalTujuan = $lonTujuan - $lonAsal; 
            $calc = sqrt(pow($calcLatAsalTujuan, 2) + pow($calcLonAsalTujuan, 2)) * $lingkarBumi;
            array_push($result, $calc);
        }
        // sort($result);
        return view('rute.show', [
            'cabang' => $cabang, 
            'dt' => $dt,
            'result' => $result
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function edit(Rute $rute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rute $rute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rute_Detail::find($id)->delete();
        return redirect()->route('saving.index')->with('success', 'Data berhasil dihapus');
    }
}
