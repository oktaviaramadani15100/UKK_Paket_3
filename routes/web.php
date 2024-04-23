<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomentarFotoController;
use App\Http\Controllers\LikeFotoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFController;
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
    Route::get('/admin/function', [LoginController::class, 'adminFunction'])->name('admin.function');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    //home
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('detailFoto/{id}', [HomeController::class, 'show'])->name('detailFoto');
    Route::get('/pelaporan-foto/export/{id}', [HomeController::class, 'pelaporan'])->name('pelaporan-foto.export');

   

    //end home

    //uplod foto
    Route::get('uploadGallery', [FotoController::class, 'upload'])->name('uploadGallery');
    Route::post('storeFotoGallery', [FotoController::class, 'store'])->name('storeFotoGallery');
    Route::delete('/delete/{id}', [FotoController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [FotoController::class, 'edit'])->name('editFoto');
    Route::put('/update/{id}', [FotoController::class, 'update'])->name('updateFoto');


    //end upload

    //album
    Route::get('album', [AlbumController::class, 'index'])->name('album');
    Route::post('storeAlbumGallery', [AlbumController::class, 'store'])->name('storeAlbumGallery');
    Route::get('detail/{id}', [AlbumController::class, 'detail'])->name('detail');
    Route::get('/pelaporan/export/{id}', [AlbumController::class, 'pelaporan'])->name('laporan.export');
    Route::get('editAlbum/{id}', [AlbumController::class, 'edit'])->name('editAlbum');
    Route::put('updateAlbum/{id}', [AlbumController::class, 'update'])->name('updateAlbum');
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


    //profile
    Route::get('profilegallery/{username}', [ProfileController::class, 'profile'])->name('profile');
    Route::delete('/deleteAlbum/{id}', [ProfileController::class, 'delete'])->name('deleteAlbum');
    
    //end prprofile
    Route::get('actionLogout', [LoginController::class, 'actionLogout'])->name('actionLogout');

    Route::get('exportPDF', [PDFController::class, 'export'])->name('exportPDF');

});

