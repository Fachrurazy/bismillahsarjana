<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Matrix;
use App\Rute;
use App\Saving;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbg = Cabang::count();
        $cabang = Cabang::all()->take(5);
        $dm = Matrix::count();
        $svg = Saving::count();
        $rute = Rute::count();
        $rutedetail = Rute::all()->take(5);
        return view('home', compact('cbg', 'cabang', 'dm', 'svg', 'rute', 'rutedetail'));
    }
}
