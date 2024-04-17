<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\User;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{
    public function index()
    {
        $album = Album::get();
        $user = User::pluck('username', 'id');
        return view('album.upload-album', compact('album', 'user'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'judul_album' => 'required|string|max:255',
                'deskripsi_album' => 'nullable|string',
                'tanggal_upload' => 'required|date',
                'user_id' => 'required|exists:users,id',
            ]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto')->getClientOriginalName();
                $request->file('foto')->move(public_path() . '/upload', $file);

                $data = new Album();
                $data->foto = $file;
                $data->NamaAlbum = $request->judul_album;
                $data->Deskripsi = $request->deskripsi_album;
                $data->TanggalDibuat = $request->tanggal_upload;
                $data->user_id = $request->user_id;

                $data->save();

                return redirect('profilegallery')->with('success', 'Foto berhasil diunggah');
            } else {
                return back()->withInput()->withErrors(['error' => 'File tidak ditemukan']);
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('An error occurred: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            // Handle the error gracefully and provide user feedback
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan foto']);
        }
    }

    public function detail($id)
    {
        $album = Album::find($id);
        $fotos = Foto::where('album_id', $album->id)->get();
        return view('album.detail-album', compact('album', 'fotos'));   
    }
}
