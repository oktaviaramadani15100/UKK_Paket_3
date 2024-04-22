<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile($username)
    {
        
        $user = User::where('username', $username)->firstOrFail();
        $datas = $user->album()->with('foto')->get();
        return view('album.profile', compact('user', 'datas'));
    }

}
