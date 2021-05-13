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
}
