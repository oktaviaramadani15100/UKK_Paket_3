<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomentarFotoController;
use App\Http\Controllers\LikeFotoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('/');
    Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin');
    Route::post('register', [LoginController::class, 'postRegister'])->name('postRegister');
    
});

Route::middleware(['auth'])->group(function () {
    //home
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('/pelaporan-foto/export/{id}', [HomeController::class, 'pelaporan'])->name('pelaporan-foto.export');

    //end home

    //uplod foto
    Route::get('uploadGallery', [FotoController::class, 'upload'])->name('uploadGallery');
    Route::post('storeFotoGallery', [FotoController::class, 'store'])->name('storeFotoGallery');
    Route::delete('/delete/{id}', [FotoController::class, 'delete'])->name('delete');

    //end upload

    //album
    Route::get('album', [AlbumController::class, 'index'])->name('album');
    Route::post('storeAlbumGallery', [AlbumController::class, 'store'])->name('storeAlbumGallery');
    Route::get('detail/{id}', [AlbumController::class, 'detail'])->name('detail');
    Route::get('/pelaporan/export/{id}', [AlbumController::class, 'pelaporan'])->name('laporan.export');
    //end album

    //komentarfoto
    Route::get('komentarfoto', [KomentarFotoController::class, 'index'])->name('komentarfoto');
    Route::post('storeKomentar', [KomentarFotoController::class, 'store'])->name('storeKomentar');
    Route::get('tampilanKomentar/{id}', [KomentarFotoController::class, 'tampilan'])->name('tampilanKomentar');
    Route::delete('deleteComent/{id}', [KomentarFotoController::class, 'delete'])->name('deleteComent');
    //end komentarfoto

    //likefoto
    Route::get('likefoto', [LikeFotoController::class, 'index'])->name('likefoto');
    Route::post('/like/{id}', [LikeFotoController::class, 'toggleLike'])->name('like.toggle');
    //end likefoto


    //pelaporan
    Route::get('pelaporan/{id}', [BlogController::class, 'index'])->name('pelaporan');

    //profile
    Route::get('profilegallery', [ProfileController::class, 'profile'])->name('profile');
    Route::get('editProfile', [ProfileController::class, 'edit'])->name('edit');
    //end prprofile
    Route::get('actionLogout', [LoginController::class, 'actionLogout'])->name('actionLogout');

});

