<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Crypt;

class UserController extends Controller
{
    public function index()
    {
        // $userAPI = Http::get('http://127.0.0.1:8000/api');
        return view('user.index', [
            'title' => 'Daftar Akun',
            'navactive' => 'user',
            'ai' => 1,
            'userGuru' => DB::table('user')->where('status', '!=', 'Siswa')->where('status', '!=', 'Walmur')->get(),
            'userSiswa' => DB::table('user')->where('status', 'Siswa')->get(),
            'userWalmur' => DB::table('user')->where('status', 'Walmur')->get()
        ]);
    }

    public function profile(Request $request)
    {
        return view('user.profile', [
            'title' => 'Update Profil',
            'navactive' => 'profil',
            'dataUser' => $this->detailUser(),
            'transportasi' => DB::table('transportasi')->get(),
            'jenis_tinggal' => DB::table('jenis_tinggal')->get(),
            'pendidikan' => DB::table('pendidikan')->get(),
            'profesi' => DB::table('profesi')->get()
        ]);
    }

    public function detailUser()
    {
        switch (session('status')) {
            case 'Siswa':
                return app('App\Http\Controllers\ProfilController')->siswa();
                break;
            case 'Walmur':
                return DB::table('walmur')->where('id_walmur', session('username'))->get();
            default:
                return DB::table('guru')->where('id_guru', session('username'))->get();
                break;
        }
    }

    public function username()
    {
        $dataUser = DB::table('user')->select('username')->get();
        $username = array_column($dataUser->toArray(), 'username');
        return $username;
    }

    public function guru()
    {
        $dataGuru = DB::table('guru')->whereNotIn('id_guru', $this->username())->get();
        foreach ($dataGuru as $guru) {
            DB::table('user')
                ->insert([
                    'username' => $guru->id_guru,
                    'password' => bcrypt($guru->id_guru),
                    'foto' => '',
                    'status' => 'Guru',
                ]);
        }
    }

    public function siswa()
    {
        $dataSiswa = DB::table('siswa')->whereNotIn('id_siswa', $this->username())->get();
        foreach ($dataSiswa as $siswa) {
            DB::table('user')
                ->insert([
                    'username' => $siswa->id_siswa,
                    'password' => bcrypt($siswa->id_siswa),
                    'foto' => '',
                    'status' => 'Siswa',
                ]);
        }
    }

    public function walmur()
    {
        $dataWalmur = DB::table('walmur')->whereNotIn('id_walmur', $this->username())->get();
        foreach ($dataWalmur as $walmur) {
            DB::table('user')
                ->insert([
                    'username' => $walmur->id_walmur,
                    'password' => bcrypt($walmur->id_walmur),
                    'foto' => '',
                    'status' => 'Walmur',
                ]);
        }
    }

    public function import(Request $request)
    {
        foreach ($request->data as $data) {
            switch ($data) {
                case 'guru':
                    $this->guru();
                    break;
                case 'siswa':
                    $this->siswa();
                    break;
                case 'walmur':
                    $this->walmur();
                    break;
            }
        }
        return back()->with('success', 'Berhasil import user!');
    }

    public function updateUser(Request $request)
    {
        $detailUser = DB::table('user')->where('username', $request->username)->first();
        if ($request->file('foto')) {
            //Hapus Foto Lama
            Storage::delete('profil/' . $detailUser->foto);

            //Upload Foto Baru
            $ext = $request->file('foto')->getClientOriginalExtension();
            $filename = $request->username . '.' . $ext;
            $request->file('foto')->storeAs('/profil', $filename);
            
            if ($request->password) {
                DB::table('user')
                    ->where('username', $request->username)
                    ->update([
                        'password' => bcrypt($request->password),
                        'foto' => $filename,
                        'status' => $request->status,
                    ]);
            }else{
                DB::table('user')
                    ->where('username', $request->username)
                    ->update([
                        'foto' => $filename,
                        'status' => $request->status,
                    ]);
            }
        }else{
            DB::table('user')
                ->where('username', $request->username)
                ->update([
                    'password' => bcrypt($request->password),
                    'foto' => '',
                    'status' => $request->status,
                ]);
        }
        return back()->with('success', 'Berhasil update data!');
    }
}
  