<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TestingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//API
Route::get('/api', [ApiController::class, 'userAPI']);

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Home | SMA Islam Parlaungan'
    ]);
});

//Login, logout, dashboard
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->middleware('auth');

//Blog
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/view/{slug}', [BlogController::class, 'show']);
Route::get('/blog/create', [BlogController::class, 'create'])->middleware('auth');
Route::post('/blog/create', [BlogController::class, 'store'])->middleware('auth');
Route::get('/blog/edit/{slug}', [BlogController::class, 'edit'])->middleware('auth');
Route::get('/blog/edit/{slug}', [BlogController::class, 'update'])->middleware('auth');
Route::get('/blog/delete/{slug}', [BlogController::class, 'update'])->middleware('auth');

//Galeri
Route::get('/galeri', [GaleriController::class, 'index']);

//About
Route::get('/about', [WebController::class, 'about']);

//Web
//Update galeri, blog, about
Route::get('/web', [WebController::class, 'index'])->middleware('auth');
Route::get('/web/blog/create', [BlogController::class, 'create'])->middleware('auth');

//User
Route::get('/user', [UserController::class, 'index']);
Route::post('/user/store', [UserController::class, 'store'])->middleware('auth');
Route::post('/user/update', [UserController::class, 'update'])->middleware('auth');
Route::post('/user/delete', [UserController::class, 'destroy'])->middleware('auth');

//Sekolah
Route::get('/sekolah', [SekolahController::class, 'index'])->middleware('auth');
//Libur
Route::post('/libur/store', [SekolahController::class, 'storeLibur'])->middleware('auth');
Route::post('/libur/update', [SekolahController::class, 'updateLibur'])->middleware('auth');
Route::post('/libur/delete', [SekolahController::class, 'destroyLibur'])->middleware('auth');
//Hari & Piket
Route::post('/hari/update', [SekolahController::class, 'updateHari'])->middleware('auth');

//Kelas
Route::post('/kelas/store', [SiswaController::class, 'storeKelas'])->middleware('auth');
Route::post('/kelas/update', [SiswaController::class, 'updateKelas'])->middleware('auth');
Route::post('/kelas/delete', [SiswaController::class, 'destroyKelas'])->middleware('auth');
Route::post('/kelas/graduation', [SiswaController::class, 'graduation'])->middleware('auth');

//Siswa
Route::get('/siswa', [SiswaController::class, 'index'])->middleware('auth');
Route::post('/siswa/store', [SiswaController::class, 'storeSiswa'])->middleware('auth');
Route::post('/siswa/update', [SiswaController::class, 'updateSiswa'])->middleware('auth');
Route::post('/siswa/delete', [SiswaController::class, 'destroySiswa'])->middleware('auth');
Route::post('/siswa/import', [SiswaController::class, 'import'])->middleware('auth');
//Keuangan Siswa
Route::get('/siswa/keuangan', [SiswaController::class, 'keuanganSiswa'])->middleware('auth');

//Absen
Route::get('/absen', [AbsenController::class, 'index'])->middleware('auth');
Route::post('/absen/update', [AbsenController::class, 'updateAbsen'])->middleware('auth');
//Engine Absen RFID
Route::get('/absen/rfid', [AbsenController::class, 'rfid']);
Route::post('/absen/engine', [AbsenController::class, 'engineRFID']);
//Engine Absen QRCode
Route::get('/absen/qrcode', [AbsenController::class, 'qrcode']);
Route::get('/absen/engine/{userabsen}', [AbsenController::class, 'engineQR']);

//Jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])->middleware('auth');
Route::post('/jadwal/store', [JadwalController::class, 'storeJadwal'])->middleware('auth');
Route::post('/jadwal/import', [JadwalController::class, 'importJadwal'])->middleware('auth');

//Jurnal
Route::get('/jurnal', [JurnalController::class, 'index'])->middleware('auth');

//Testing
Route::get('/testing', [TestingController::class, 'index']);
Route::get('/tesapi', [TestingController::class, 'getApi']);

//Guru
Route::get('/guru', [GuruController::class, 'index']);
Route::get('/guru/keuangan', [GuruController::class, 'keuangan']);
