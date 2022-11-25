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
}
