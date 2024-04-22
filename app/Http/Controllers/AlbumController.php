<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\User;
use App\Models\Album;
use Maatwebsite\Excel\Row;
use Illuminate\Http\Request;
use App\Exports\PelaporanExport;
use App\Models\Laporan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            ]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto')->getClientOriginalName();
                $request->file('foto')->move(public_path() . '/upload', $file);

                $data = new Album();
                $data->foto = $file;
                $data->NamaAlbum = $request->judul_album;
                $data->Deskripsi = $request->deskripsi_album;
                $data->TanggalDibuat = now();
                $data->user_id = auth()->user()->id;
                $data->save();

                $aktivitas = "data album berhasil di upload";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);

                return redirect()->route('profile', ['username' => Auth::user()->username])->with('success', 'Foto berhasil diunggah');
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

        $aktivitas = "masuk ke tampilan detail";

        Laporan::create([
            'user_id' => Auth::id(),
            'aktivitas' => $aktivitas,
        ]);

        if ($album) {
            $fotos = Foto::where('album_id', $album->id)->get();

            return view('album.detail-album', compact('album', 'fotos'));
        } else {
            return redirect()->back()->with('error', 'Album not found');
        }
    }

    public function pelaporan($id)
    {
        $pelaporan = Album::findOrFail($id);
        return Excel::download(new PelaporanExport($id), "pelapor.xlsx");
    }
}
