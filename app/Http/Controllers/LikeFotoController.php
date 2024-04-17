<?php

namespace App\Http\Controllers;

use App\Models\LikeFoto;
use Illuminate\Http\Request;

class LikeFotoController extends Controller
{
    public function index()
    {
        $likefoto = LikeFoto::get();
        return view('home.index', compact('likefoto'));
    }

    public function toggleLike(Request $request, $fotoId)
    {
        $userId = $request->user_id;

        $like = LikeFoto::where('foto_id', $fotoId)->where('user_id', $userId)->first();

        if (!$like) {
            LikeFoto::create([
                'foto_id' => $fotoId,
                'user_id' => $userId,
                'TanggalDate' => now(),
            ]);
            $totalLikes = 1; // Ketika pertama kali dilike, jumlah likenya langsung 1
            return response()->json(['status' => 'liked', 'total_likes' => $totalLikes]);
        } else {
            $like->delete();
            $totalLikes = LikeFoto::where('foto_id', $fotoId)->count(); // Menghitung total like setelah unlike
            return response()->json(['status' => 'unliked', 'total_likes' => $totalLikes]);
        }
    }
}
