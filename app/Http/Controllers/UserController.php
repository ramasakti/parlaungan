<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
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
            'data' => DB::table('user')->get()
        ]);
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
                    'id' => '',
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
                    'id' => '',
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
                    'id' => '',
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
        DB::table('user')
            ->where('username', $request->username)
            ->update([
                'foto' => '',
                'status' => $request->status,
            ]);
        return back()->with('success', 'Berhasil update data!');
    }
}
  