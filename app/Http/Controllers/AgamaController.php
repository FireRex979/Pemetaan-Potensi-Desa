<?php

namespace App\Http\Controllers;

use App\models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function index()
    {
        $agama = Agama::orderby('created_at', 'desc')->get();
        return view('agama.home', compact('agama'));
    }

    public function store(Request $request)
    {
        $agama = new Agama();
        $agama->agama = $request->agama;
        $agama->save();

        return redirect()->back()->with(['success' => 'Data Berhasil Ditambahkan']);
    }

    public function edit($id)
    {
        $agama = Agama::find($id);
        return response()->json(['data' => $agama]);
    }

    public function update(Request $request, $id)
    {
        $agama = Agama::find($id);
        $agama->agama= $request->agama;
        $agama->save();

        return redirect()->back()->with(['success' => 'Data Berhasil Diupdate']);
    }

    public function delete(Request $request)
    {
        $agama = Agama::find($request->id);
        $agama->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }
}
