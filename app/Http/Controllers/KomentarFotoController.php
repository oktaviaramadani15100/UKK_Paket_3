<?php

namespace App\Http\Controllers;

use App\Models\KomentarFoto;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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
        dd($request);
        try {
            $request->validate([
                'isi_komentar' => 'required',
                'foto_id' => 'required|exists:fotos,id',
            ]);

            $comment = new KomentarFoto();
            $comment->IsiKomentar = $request->isi_komentar;
            $comment->user_id = Auth::id();
            $comment->foto_id = $request->foto_id;
            $comment->TanggalKomentar = now();
            $comment->save();
            dd($comment);

            return response()->json(['message' => 'Komentar berhasil disimpan'], 201);
        } catch (\Exception $e) {
            // Log the errorm
            Log::error('An error occurred: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            // Handle the error gracefully and provide user feedback
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan komentar']);
        }
    }
}
