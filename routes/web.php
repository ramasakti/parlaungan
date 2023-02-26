<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\KeuanganSiswa;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\InfrastrukturIOT;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipController;

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

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Home | SMA Islam Parlaungan',
        'navactive' => 'home'
    ]);
})->middleware('guest')->name('login');

//Login, logout, dashboard
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

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
Route::post('/web/blog/store', [BlogController::class, 'store'])->middleware('auth');
Route::get('/web/api', [BlogController::class, 'apiBlog']);

//User
Route::get('/profile', [UserController::class, 'profile']);
Route::post('/profile', [UserController::class, 'updateProfile']);
Route::get('/user', [UserController::class, 'index']);
Route::post('/user/import', [UserController::class, 'import'])->middleware('auth');
Route::post('/user/update', [UserController::class, 'updateUser'])->middleware('auth');

//Profil
Route::post('/biodata/update', [ProfilController::class, 'updateBiodata']);
Route::post('/profile/updateAkun', [ProfilController::class, 'updateAkun']);

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
Route::get('/siswa/keuangan', [KeuanganSiswa::class, 'index'])->middleware('auth');
Route::post('/pembayaran/store', [KeuanganSiswa::class, 'addPembayaran'])->middleware('auth');
Route::post('/pembayaran/update', [KeuanganSiswa::class, 'updatePembayaran'])->middleware('auth');
Route::post('/pembayaran/transaksi', [KeuanganSiswa::class, 'engineTransaction'])->middleware('auth');
Route::post('/pembayaran/payment', [KeuanganSiswa::class, 'payment'])->middleware('auth');

//Absen
Route::get('/absen', [AbsenController::class, 'index'])->middleware('auth');
Route::post('/absen/update', [AbsenController::class, 'updateAbsen'])->middleware('auth');
Route::get('/absen/rekap', [AbsenController::class, 'rekap'])->middleware('auth');
Route::get('/absen/reset', [AbsenController::class, 'reset'])->middleware('auth');
//Engine Absen RFID
Route::get('/absen/engine', [AbsenController::class, 'viewEngine']);
Route::post('/absen/engine', [AbsenController::class, 'engine']);

//Jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])->middleware('auth');
Route::post('/jadwal/store', [JadwalController::class, 'storeJadwal'])->middleware('auth');
Route::post('/jadwal/import', [JadwalController::class, 'import'])->middleware('auth');
Route::post('/jadwal/delete', [JadwalController::class, 'deleteJadwal'])->middleware('auth');
Route::post('/jadwal/manual', [JadwalController::class, 'absenGuruManual'])->middleware('auth');

//Jurnal
Route::get('/jurnal', [JurnalController::class, 'index'])->middleware('auth');

//Testing
Route::get('/testing', [TestingController::class, 'index']);
Route::get('/tesapi', [TestingController::class, 'getApi']);
Route::get('/csv', [TestingController::class, 'csv']);

//Guru
Route::get('/mencowba', [GuruController::class, 'dataPerGuru']);
Route::get('/guru', [GuruController::class, 'index'])->middleware('auth');
Route::get('/guru/keuangan', [GuruController::class, 'keuangan'])->middleware('auth');
Route::post('/guru/store', [GuruController::class, 'addGuru'])->middleware('auth');
Route::post('/guru/update', [GuruController::class, 'updateGuru'])->middleware('auth');
Route::post('/guru/delete', [GuruController::class, 'deleteGuru'])->middleware('auth');

//Absen Rapat
Route::get('/rapat', [RapatController::class, 'index'])->middleware('auth');
Route::post('/rapat/store', [RapatController::class, 'store'])->middleware('auth');
Route::post('/rapat/delete', [RapatController::class, 'delete'])->middleware('auth');
Route::post('/rapat/update', [RapatController::class, 'update'])->middleware('auth');
Route::get('/rapat/{slug}', [RapatController::class, 'detail'])->middleware('auth');
Route::post('/rapat/{slug}', [RapatController::class, 'engine'])->middleware('auth');

//Infrastruktur IOT dan Otomasi
Route::get('/infrastruktur', [InfrastrukturIOT::class, 'restapi']);
Route::get('/arduino', [InfrastrukturIOT::class, 'arduino']);

//Surat
Route::get('/arsip', [ArsipController::class, 'index']);
Route::post('/arsip/store', [ArsipController::class, 'store']);
Route::post('/arsip/update', [ArsipController::class, 'update']);
Route::post('/arsip/delete', [ArsipController::class, 'delete']);