<?php

namespace App\Http\Controllers;

use App\models\Desa;
use App\models\Sekolah;
use App\models\SumberAir;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('map.home');
    }

    public function getAllDesa()
    {
        $desa = Desa::all();
        return response()->json(['desa' => $desa]);
    }

    public function getDataPotensi()
    {
        $sumber_air = SumberAir::join('tb_jenis_potensi', 'tb_sumber_air.potensi_id', 'tb_jenis_potensi.id')
            ->select('tb_jenis_potensi.icon', 'tb_sumber_air.*', 'tb_jenis_potensi.tablelink')->get();
        $sekolah = Sekolah::join('tb_jenis_potensi', 'tb_sekolah.potensi_id', 'tb_jenis_potensi.id')
            ->select('tb_jenis_potensi.icon', 'tb_sekolah.*', 'tb_jenis_potensi.tablelink')->get();
        return response()->json(['sumber_air' => $sumber_air, 'sekolah' => $sekolah]);
    }
}
