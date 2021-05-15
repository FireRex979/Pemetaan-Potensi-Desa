<?php

namespace App\Http\Controllers;

use App\models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desa = Desa::orderby('created_at', 'desc')->get();
        return view('desa.home', compact('desa'));
    }

    public function create()
    {
        return view('desa.create');
    }

    public function store(Request $request)
    {
        $desa = new Desa();
        $desa->nama_desa = $request->nama_desa;
        $desa->batas_desa = $request->batas_desa;
        $desa->marker_desa = $request->marker_desa;
        $desa->warna_batas_desa = $request->warna_batas;
        $desa->zoom = $request->zoom;
        $desa->save();

        return redirect()->route('desa.home')->with(['success' => 'Data berhasil ditambahkan']);
    }

    public function show($id)
    {
        $desa = Desa::find($id);
        return view('desa.show', compact('desa'));
    }

    public function readBatasDesa($id)
    {
        $desa = Desa::find($id);
        return response()->json(['desa' => $desa]);
    }

    public function update(Request $request, $id)
    {
        $desa = Desa::find($id);
        $desa->nama_desa = $request->nama_desa;
        $desa->batas_desa = $request->batas_desa;
        $desa->marker_desa = $request->marker_desa;
        $desa->warna_batas_desa = $request->warna_batas;
        $desa->zoom = $request->zoom;
        $desa->save();

        return redirect()->back()->with(['success' => 'Data berhasil diedit']);
    }

    public function delete(Request $request)
    {
        $desa = Desa::find($request->id);
        $desa->delete();
        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }
}
