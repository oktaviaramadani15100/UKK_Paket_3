<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Laporan;
use App\Models\KomentarFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\QueryException;

class KomentarFotoController extends Controller
{
    public function index()
    {
        $komentarfoto = KomentarFoto::get();
        return view('home.index', compact('komentarfoto'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'komentar' => 'required',
                'foto_id' => 'required|exists:fotos,id',
            ]);

            $comment = new KomentarFoto();
            $comment->IsiKomentar = $request->komentar;
            $comment->user_id = Auth::id();
            $comment->foto_id = $request->foto_id;
            $comment->TanggalKomentar = now();
            $comment->save();

            $aktivitas = "data komentar berhasil di upload";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);


            return back()->with('success', 'Komentar berhasil disimpan');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan komentar']);
        }
    }

    public function tampilan($id)
    {
        $aktivitas = "menampilkan tampilan komentar";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);

        $foto = Foto::find($id);
        $komentar = KomentarFoto::where('foto_id', $id)->get();
        return view('komentar.tampilan-komentar', compact('foto', 'id', 'komentar'));
    }

    public function delete(Request $request, $id)
    {
        $komentar = KomentarFoto::findOrFail($id);
        
        // Periksa apakah pengguna yang terautentikasi adalah pemilik komentar
        if ($komentar->user_id !== Auth::id()) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk menghapus komentar ini.'], 403);
        }

        $aktivitas = "data komentar berhasil di hapus";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);

        
        // Hapus komentar
        $komentar->delete();

        // Berikan respons sukses
        return response()->json(['success' => 'Komentar berhasil dihapus.']);
    }


}
