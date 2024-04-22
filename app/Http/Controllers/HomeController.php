<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use App\Exports\PelaporanFotoExport;
use App\Models\Laporan;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
{   
    $searchTerm = $request->input('search');

    if ($searchTerm) {
        $data = Foto::where('JudulFoto', 'LIKE', "%{$searchTerm}%")->get();
    } else {
        $data = Foto::all();
    }

    return view('home.index', compact('data'));
}

    
    public function pelaporan($id)
    {
        $laporan = Foto::findOrFail($id);
        return Excel::download(new PelaporanFotoExport($id), "laporan-foto.xlsx");
    }

    public function show($id)
    {
        $foto = Foto::findOrFail($id);
        $fotos = Album::with('foto')->where('user_id',$foto->user_id)->get();

        $aktivitas = "menampilkan detail foto";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);

        return view('home.detail-foto', compact('foto','fotos'));
    }

}
