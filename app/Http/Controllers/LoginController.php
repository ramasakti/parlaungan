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
            'title' => 'Login | SMA Islam Parlaungan',
            'navactive' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|max:20',
            'password' => 'required'
        ]);

        $detailUser = DB::table('user')->where('username', request('username'))->first();
        $statusWalas = DB::table('kelas')->where('walas', request('username'))->first();
        $statusPiket = DB::table('hari')->where('piket', request('username'))->first();
        if (Auth::attempt($credentials)){
            if ($request->username == 'adminabsen'){
                $response = new Response(redirect('/absen/engine'));
                $response->withCookie(cookie()->forever('username', 'adminabsen'));
                return $response;
            }else{
                $request->session()->put('username', $request->username);
                $request->session()->put('status', $detailUser->status);
                if ($statusPiket && $statusWalas) {
                    $request->session()->put('piket', $statusPiket);
                }elseif ($statusWalas){
                    $request->session()->put('walas', $statusWalas);
                }else{
                    $request->session()->put('piket', $statusPiket);
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
        return redirect()->intended('/');
    }
}
