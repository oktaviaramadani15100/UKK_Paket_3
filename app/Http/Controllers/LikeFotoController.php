<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeFotoController extends Controller
{
    public function index()
    {
        $aktivitas = "tampilan home like";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);

        $likefoto = LikeFoto::get();
        return view('home.index', compact('likefoto'));
    }

    public function toggleLike(Request $request, $fotoId)
{
    $userId = $request->user_id;

    $like = LikeFoto::where('foto_id', $fotoId)->where('user_id', $userId)->first();

    $aktivitas = "menampilkan data like";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);


    if (!$like) {
        LikeFoto::create([
            'foto_id' => $fotoId,
            'user_id' => $userId,
            'TanggalDate' => now(),
        ]);
        $totalLikes = LikeFoto::where('foto_id', $fotoId)->count(); 
        return response()->json(['status' => 'liked', 'total_likes' => $totalLikes]);
    } else {
        $like->delete();
        $totalLikes = LikeFoto::where('foto_id', $fotoId)->count(); 
        return response()->json(['status' => 'unliked', 'total_likes' => $totalLikes]);
    }
}

}
