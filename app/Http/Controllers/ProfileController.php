<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\User;
use App\Models\Album;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile($username)
    {
        
        $user = User::where('username', $username)->firstOrFail();
        $datas = $user->album()->with('foto')->get();
        return view('album.profile', compact('user', 'datas'));
    }

    public function delete(Request $request, $id)
    {
        $gambar = Album::find($id);

        $aktivitas = "gambar dan data berhasil di hapus";

        Laporan::create([
            'user_id' => Auth::id(),
            'aktivitas' => $aktivitas,
        ]);


        if (!$gambar) {
            return response()->json(['error' => 'Gambar tidak ditemukan.'], 404);
        }

        if ($gambar->user_id != Auth::id()) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk menghapus gambar ini.'], 403);
        }

        Storage::delete($gambar->foto);
        $gambar->delete();

        return response()->json(['success' => 'Gambar berhasil dihapus.'], 200);
    }

}
