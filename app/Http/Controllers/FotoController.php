<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use App\Models\Laporan;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function upload()
    {
        $foto = Foto::get();
        $userAlbums = Album::where('user_id', auth()->user()->id)->pluck('NamaAlbum', 'id');

        return view('home.product', compact('foto', 'userAlbums'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul_foto' => 'required|string|max:255',
                'deskripsi_foto' => 'nullable|string',
                'album_id' => 'required|exists:albums,id',
                'LokasiFIle' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Periksa apakah file diunggah
            if ($request->hasFile('LokasiFIle')) {

                $fileName = $request->file('LokasiFIle')->getClientOriginalName();

                $request->file('LokasiFIle')->move(public_path() . '/upload', $fileName);

                // Buat data baru
                $data = new Foto();
                $data->LokasiFIle = $fileName;
                $data->JudulFoto = $request->judul_foto;
                $data->DeskripsiFoto = $request->deskripsi_foto;
                $data->TanggalUngguh = now();
                $data->album_id = $request->album_id;
                $data->user_id = auth()->user()->id;
                $data->save();

                $aktivitas = "data foto berhasil di upload";

                Laporan::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                ]);

                // Redirect dengan pesan sukses jika berhasil
                return redirect('home')->with('success', 'Foto berhasil diunggah');
            } else {
                // Tangani jika tidak ada file yang diunggah
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


    public function toggleLike(Request $request, $fotoId)
    {
        $userId = $request->user_id;

        $like = LikeFoto::where('foto_id', $fotoId)->where('user_id', $userId)->first();

        $aktivitas = "like berhasil";

        Laporan::create([
            'user_id' => Auth::id(),
            'aktivitas' => $aktivitas,
        ]);


        if (!$like) {
            LikeFoto::create([
                'foto_id' => $fotoId,
                'user_id' => $userId,
            ]);
            return response()->json(['status' => 'liked']);
        } else {
            $like->delete();
            return response()->json(['status' => 'unliked']);
        }
    }

    public function delete(Request $request, $id)
    {
        $gambar = Foto::find($id);

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

        Storage::delete($gambar->LokasiFIle);
        $gambar->delete();

        return response()->json(['success' => 'Gambar berhasil dihapus.'], 200);
    }

    public function edit($id)
    {
        $foto = Foto::findOrFail($id);
        // Kirim data foto ke halaman edit
        return view('home.edit-foto', compact('foto'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diinput pengguna jika diperlukan
        $request->validate([
            'JudulFoto' => 'required',
            'DeskripsiFoto' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Temukan foto yang akan diupdate
        $foto = Foto::findOrFail($id);

        $foto->JudulFoto = $request->JudulFoto;
        $foto->DeskripsiFoto = $request->DeskripsiFoto;

        $foto->save();

        $aktivitas = "edit foto berhasil";

        Laporan::create([
            'user_id' => Auth::id(),
            'aktivitas' => $aktivitas,
        ]);

        return redirect()->route('detailFoto', ['id' => $foto->id])->with('success', 'Foto berhasil diperbarui');
    }
}
