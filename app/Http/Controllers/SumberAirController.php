<?php

namespace App\Http\Controllers;

use App\models\SumberAir;
use Illuminate\Http\Request;

class SumberAirController extends Controller
{
    public function store(Request $request)
    {
        $sumber_air = new SumberAir();
        $sumber_air->potensi_id = $request->potensi_id;
        $sumber_air->nama_sumber = $request->nama_sumber;
        $sumber_air->lat = $request->lat;
        $sumber_air->lng = $request->lng;
        $sumber_air->debit = $request->debit;
        $sumber_air->pengelola = $request->pengelola;
        $sumber_air->save();

        return redirect()->back()->with(['success' => 'Potensi berhasil ditambahkan']);
    }

    public function show($id)
    {
        $sumber_air = SumberAir::find($id);
        return response()->json(['data' => $sumber_air]);
    }

    public function update(Request $request, $id)
    {
        $sumber_air = SumberAir::find($id);
        $sumber_air->potensi_id = $request->potensi_id;
        $sumber_air->nama_sumber = $request->nama_sumber;
        $sumber_air->debit = $request->debit;
        $sumber_air->pengelola = $request->pengelola;
        $sumber_air->save();

        return redirect()->back()->with(['success' => 'Potensi berhasil diupdate']);
    }

    public function updateKoordinat(Request $request, $id)
    {
        $sumber_air = SumberAir::find($id);
        $sumber_air->lat = $request->lat;
        $sumber_air->lng = $request->lng;
        $sumber_air->save();

        return response()->json(['success' => true]);
    }
}
