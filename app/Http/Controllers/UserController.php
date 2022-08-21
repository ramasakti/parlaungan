<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        // $userAPI = Http::get('http://127.0.0.1:8000/api');
        return view('user.index', [
            'title' => 'Daftar Akun',
            'navactive' => 'user',
            'ai' => 1,
            'data' => DB::table('user')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedUser = $request->validate([
            'username' => 'required|min:8|unique:user',
            'password' => 'required|min:8',
        ]);
        
        if($request->status != 'Walmur'){
            DB::table('guru')
                ->insert([
                    'id_guru' => $request->username,
                    'nama_guru' => $request->nama,
                ]);
        }
        
        DB::table('user')
            ->insert([
                'username' => $request->username,
                'password' => $request->password,
                'foto' => '',
                'telp' => $request->telp,
                'status' => $request->status
            ]);
        return back(); 
    }

    public function update(Request $request)
    {
        $validatedUser = $request->validate([
            'status' => 'required',
        ]);
        
        DB::table('user')
            ->where('username', $request->username)
            ->update([
                'status' => $request->status
            ]);
        return back();
    }


    public function destroy(Request $request)
    {
        DB::table('user')
            ->where('username', $request->username)
            ->delete();
        return back();
    }
}
