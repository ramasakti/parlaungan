<?php

namespace App\Http\Controllers;

use DB;
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
        if (Auth::attempt($credentials)){
            if ($request->username == 'adminabsen'){
                $response = new Response(redirect('/absen/rfid'));
                $response->withCookie(cookie()->forever('username', 'adminabsen'));
                return $response;
            }else{
                $request->session()->put('username', $request->username);
                $request->session()->put('status', $detailUser[0]->status);
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
        return redirect()->intended('/login');
    }

    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'navactive' => 'dashboard',
            'dataSiswa' => count(DB::table('siswa')->get()),
            'dataGuru' => count(DB::table('guru')->get()),
            'dataKelas' => count(DB::table('kelas')->get()),
            'dataQR' => QrCode::size(200)->generate(session('username'))
        ]);
    }
}
