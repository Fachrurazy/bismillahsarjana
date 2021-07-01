<?php

namespace App\Http\Controllers;

use App\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Cabang::all();
        return view('cabang.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Cabang::orderBy('Kode_Cabang', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "C00";

        if($rowCount > 0){
            $strKode = substr($lastId->Kode_Cabang, 1, 2);
            if ($strKode < 99){
                $kode = "C".''.($strKode + 1);
            }else{
                $kode = "C01".''.($strKode + 1);
            }
        }
        return view('cabang.create', compact('kode'));
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
            'Kode_Cabang' => 'required',
            'Nama_Cabang' => 'required',
            'Pemilik' => 'required',
            'Telepon' => 'required',
            'Alamat' => 'required',
            'Latitude' => 'required',
            'Longitude' => 'required'
        ]);

        Cabang::create([
            'Kode_Cabang' => $request->get('Kode_Cabang'),
            'Nama_Cabang' => $request->get('Nama_Cabang'),
            'Pemilik' => $request->get('Pemilik'),
            'Telepon' => $request->get('Telepon'),
            'Alamat' => $request->get('Alamat'),
            'Latitude' => $request->get('Latitude'),
            'Longitude' => $request->get('Longitude'),
        ]);
        return redirect('/cabang')->with('success','Data berhasil ditambahkan');

        // $dataCreate = Cabang::create([
        //     'Nama_Cabang' => $request->Nama_Cabang,
        //     'Pemilik' => $request->Pemilik,
        //     'Telepon' => $request->Telepon,
        //     'Alamat' => $request->Alamat
        // ]);
        // return response($dataCreate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function show(Cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function edit(Cabang $cabang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'Kode_Cabang' => 'required',
            'Nama_Cabang' => 'required',
            'Pemilik' => 'required',
            'Telepon' => 'required',
            'Alamat' => 'required',
            'Latitude' => 'required',
            'Longitude' => 'required'
        ]);

        $cabang = array(
            'Kode_Cabang' => $request->Kode_Cabang,
            'Nama_Cabang' => $request->Nama_Cabang,
            'Pemilik' => $request->Pemilik,
            'Telepon' => $request->Telepon,
            'Alamat' => $request->Alamat,
            'Latitude' => $request->Latitude,
            'Longitude' => $request->Longitude,
        );
        // return $cabang;die();
        Cabang::findorfail($request->id)->update($cabang);
        return redirect()->route('cabang.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cabang::find($id)->delete();
        return redirect()->route('cabang.index')->with('success', 'Data berhasil dihapus');
    }
}
