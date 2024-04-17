<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $datas = Album::all();
        return view('album.profile', compact('user', 'datas'));
    }

    public function edit() 
    {
        return view('home.editProfile');
    }
}
