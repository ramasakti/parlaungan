<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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

        $detailUser = User::all()->where('username', request('username'));
        if (Auth::attempt($credentials)){
            if ($request->username == 'adminabsen'){
                $response = new Response(redirect('/absen/rfid'));
                $response->withCookie(cookie()->forever('username', 'adminabsen'));
                return $response;
            }else{
                $request->session()->put('username', $request->username);
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
            'navactive' => 'dashboard'
        ]);
    }
}
