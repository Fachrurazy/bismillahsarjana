<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Matrix;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Matrix::all();
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
    public function destroy(Matrix $matrix)
    {
        //
    }
}
