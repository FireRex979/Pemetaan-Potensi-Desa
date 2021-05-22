<?php

namespace App\Http\Controllers;

use App\models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function store(Request $request)
    {
        $sekolah = new Sekolah();
        $sekolah->potensi_id = $request->potensi_id;
        $sekolah->jenis = $request->jenis;
        $sekolah->tingkat = $request->tingkat;
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->alamat = $request->alamat;
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->save();

        return redirect()->back()->with(['success' => 'Data Berhasil disimpan']);
    }
}
