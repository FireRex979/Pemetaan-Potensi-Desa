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
        $sekolah->desa_id = $request->id_desa;
        $sekolah->jenis = $request->jenis;
        $sekolah->tingkat = $request->tingkat;
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->alamat = $request->alamat;
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->save();

        return redirect()->back()->with(['success' => 'Data Berhasil disimpan']);
    }

    public function show($id)
    {
        $sekolah = Sekolah::find($id);
        return response()->json(['data' => $sekolah]);
    }

    public function update(Request $request, $id)
    {
        $sekolah = Sekolah::find($id);
        $sekolah->jenis = $request->jenis;
        $sekolah->tingkat = $request->tingkat;
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->alamat = $request->alamat;
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->save();

        return redirect()->back()->with(['success' => 'Data Berhasil disimpan']);
    }

    public function updateKoordinat(Request $request, $id)
    {
        $sekolah = Sekolah::find($id);
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->save();

        return response()->json(['success' => true]);
    }

    public function delete(Request $request) {
        $sekolah = Sekolah::find($request->id);
        $sekolah->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil dihapus']);
    }
}
