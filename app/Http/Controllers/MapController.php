<?php

namespace App\Http\Controllers;

use App\models\Agama;
use App\models\Desa;
use App\models\Sekolah;
use App\models\SumberAir;
use App\models\TempatIbadah;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $agama = Agama::all();
        return view('map.home', compact('agama'));
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
        $tempat_ibadah = TempatIbadah::query()
            ->join('tb_agama', 'tb_agama.id', 'tb_tempat_ibadah.agama_id')
            ->select('tb_tempat_ibadah.*', 'tb_agama.agama')
            ->get();
        return response()->json(['sumber_air' => $sumber_air, 'sekolah' => $sekolah, 'tempat_ibadah' => $tempat_ibadah]);
    }
}
