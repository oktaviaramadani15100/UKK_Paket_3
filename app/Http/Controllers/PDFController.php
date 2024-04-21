<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function export()
    {
        $userId = Auth::id();
        $aktivitas = Laporan::join('users', 'laporan.user_id', '=', 'users.id')
                         ->where('laporan.user_id', $userId)
                         ->select('laporan.*', 'users.username')
                         ->get();
        $user = User::findOrFail($userId);

        $dompdf = new Dompdf();

        $html = view('home.export-pdf', compact('aktivitas', 'user'));
        $dompdf->loadHtml($html);

        $dompdf->render();

        return $dompdf->stream('aktifitas.pdf');
    }
}
