<?php

namespace App\Http\Controllers;

use App\Exports\PelaporanFotoExport;
use App\Models\Foto;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Foto::all();
        return view('home.index', compact('data'));
    }

    public function pelaporan($id)
    {
        $laporan = Foto::findOrFail($id);
        return Excel::download(new PelaporanFotoExport($id), "laporan-foto.xlsx");
    }
}
