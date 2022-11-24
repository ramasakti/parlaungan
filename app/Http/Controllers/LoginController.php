<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login | SMA Islam Parlaungan'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|max:20',
            'password' => 'required'
        ]);

        $detailUser = DB::table('user')->where('username', request('username'))->get();
        $statusWalas = DB::table('kelas')->where('walas', request('username'))->get();
        $statusPiket = DB::table('hari')->where('piket', request('username'))->get();
        if (Auth::attempt($credentials)){
            if ($request->username == 'adminabsen'){
                $response = new Response(redirect('/absen/engine'));
                $response->withCookie(cookie()->forever('username', 'adminabsen'));
                return $response;
            }else{
                $request->session()->put('username', $request->username);
                $request->session()->put('status', $detailUser[0]->status);
                if (count($statusWalas) > 0) {
                    $request->session()->put('walas', $statusWalas[0]);
                }
                if (count($statusPiket) > 0) {
                    $request->session()->put('piket', $statusPiket[0]);
                }
                return redirect()->intended('/dashboard');
            }
        }else{
            return back()->with('gagal', 'Username atau Password salah!'); 
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('username');
        $request->session()->forget('status');
        $request->session()->forget('walas');
        return redirect()->intended('/login');
    }

    public function jamSekarang()
    {
        $jamMasuk = DB::table('hari')
                        ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                        ->get();
        return $jamMasuk;
    }

    public function diagramAbsen()
    {
        $hadir = DB::table('absen')
                    ->where('waktu_absen', '<', $this->jamSekarang()[0]->masuk)
                    ->get();
        $terlambat = DB::table('absen')
                        ->where('waktu_absen', '>', $this->jamSekarang()[0]->masuk)
                        ->get();
        $izin = DB::table('absen')
                    ->where('keterangan', 'I')
                    ->get();
        $sakit = DB::table('absen')
                    ->where('keterangan', 'S')
                    ->get();
        $alfa = DB::table('absen')
                    ->where('waktu_absen', NULL)
                    ->orWhere('keterangan', 'A')
                    ->get();
        return [count($hadir), count($terlambat), count($izin), count($sakit), count($alfa)];
    }

    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'navactive' => 'dashboard',
            'dataSiswa' => count(DB::table('siswa')->get()),
            'dataGuru' => count(DB::table('guru')->get()),
            'dataKelas' => count(DB::table('kelas')->get()),
            'detailUser' => $this->userCard(),
            'dataQR' => QrCode::size(200)->generate(session('username')),
            'dataAbsen' => $this->diagramAbsen()
        ]);
    }

    public function userCard()
    {
        switch (session('status')) {
            case 'Siswa':
                $detailUser = DB::table('siswa')
                                ->where('id_siswa', session('username'))
                                ->get();
                return $detailUser;
                break;
            case 'Walmur':
                $detailUser = DB::table('walmur')
                                ->where('id_walmur', session('username'))
                                ->get();
                return $detailUser;
                break;
            default:
                $detailUser = DB::table('guru')
                                ->where('id_guru', session('username'))
                                ->get();
                return $detailUser;
                break;
        }
    }
}
