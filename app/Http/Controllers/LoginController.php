<?php

namespace App\Http\Controllers;

use App\Models\User;
use Nette\Utils\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function postLogin(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            $initial = strtoupper(substr(Auth::user()->username, 0, 1));
            session(['user_initial' => $initial]);
            return redirect('home')->with('sukses', 'berhasil');
        } else {
            return redirect('/');
        }
    }

    public function postRegister(Request $request)
    {
        Session::flash('username', $request->username);
        Session::flash('email', $request->email);
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users| :255',
            'password' => 'required|string|min:5|confirmed',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 5 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->alamat = $request->input('alamat');
        $initial = strtoupper(substr($request->input('username'), 0, 1));
        $user->save();

        session(['user_initial' => $initial]);
        return redirect()->route('/')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function actionLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function adminFunction()
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized');
        }
    }
}
