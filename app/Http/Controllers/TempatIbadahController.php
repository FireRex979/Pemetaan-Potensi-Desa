<?php

namespace App\Http\Controllers;

use App\models\TempatIbadah;
use Illuminate\Http\Request;

class TempatIbadahController extends Controller
{
    public function store(Request $request)
    {
        $tempat_ibadah = new TempatIbadah();
        $tempat_ibadah->potensi_id = $request->potensi_id;
        $tempat_ibadah->nama_tempat_ibadah = $request->nama_tempat_ibadah;
        $tempat_ibadah->lat = $request->lat;
        $tempat_ibadah->lng = $request->lng;
        $tempat_ibadah->alamat = $request->alamat;
        $tempat_ibadah->agama_id = $request->agama_id;
        $tempat_ibadah->save();

        return redirect()->back()->with(['success' => 'Potensi berhasil ditambahkan']);
    }

    public function show($id)
    {
        $tempat_ibadah = TempatIbadah::find($id);
        return response()->json(['data' => $tempat_ibadah]);
    }

    public function update(Request $request, $id)
    {
        $tempat_ibadah = TempatIbadah::find($id);
        $tempat_ibadah->nama_tempat_ibadah = $request->nama_tempat_ibadah;
        $tempat_ibadah->lat = $request->lat;
        $tempat_ibadah->lng = $request->lng;
        $tempat_ibadah->alamat = $request->alamat;
        $tempat_ibadah->agama_id = $request->agama_id;
        $tempat_ibadah->save();

        return redirect()->back()->with(['success' => 'Potensi berhasil diubah']);
    }

    public function delete(Request $request)
    {
        $tempat_ibadah = TempatIbadah::find($request->id);
        $tempat_ibadah->delete();

        return redirect()->back()->with(['success' => 'Potensi berhasil dihapus']);
    }

    public function updateKoordinat(Request $request, $id)
    {
        $tempat_ibadah = TempatIbadah::find($id);
        $tempat_ibadah->lat = $request->lat;
        $tempat_ibadah->lng = $request->lng;
        $tempat_ibadah->save();

        return response()->json(['success' => true]);
    }
}
