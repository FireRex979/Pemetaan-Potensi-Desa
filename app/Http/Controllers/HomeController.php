<?php

namespace App\Http\Controllers;

use App\models\Desa;
use App\models\Sekolah;
use App\models\SumberAir;
use App\models\TempatIbadah;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sekolah = Sekolah::count();
        $sumber_air = SumberAir::count();
        $tempat_ibadah = TempatIbadah::count();
        $desa = Desa::count();
        return view('home', compact('sekolah', 'sumber_air', 'tempat_ibadah', 'desa'));
    }

    public function map()
    {
        return view('map');
    }

}
