<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index($id)
    {
        $laporan = Foto::find($id);
        return view('home.pelaporan', compact('laporan'));
    }
}
