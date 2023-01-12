<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class GuruController extends Controller
{
    public function jampel()
    {
        return DB::table('hari')
                    ->select(DB::raw('TIME_TO_SEC(jampel)/60 as jampel'))
                    ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                    ->get();
    }
    
    public function nominal()
    {
        return DB::table('nominal')->get();
    }

    public function keuangan(Request $request)
    {
        return view('guru.keuangan.index', [
            'title' => 'Keuangan Guru',
            'navactive' => 'guru',
            'dataGuru' => DB::table('guru')->get(),
            'jampel' => $this->jampel(),
            'dataNominal' => $this->nominal(),
        ]);
    }

    public function addGuru(Request $request)
    {
        DB::table('guru')
            ->insert([
                'id_guru' => $request->id_guru,
                'nama_guru' => $request->nama_guru,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

        DB::table('user')
            ->insert([
                'username' => $request->id_guru,
                'password' => bcrypt($request->password),
                'foto' => '',
                'status' => 'Guru'
            ]);

        return back()->with('success', 'Berhasil menambah data guru!');
    }

    public function deleteGuru(Request $request)
    {
        DB::table('guru')
            ->where('id_guru', $request->id_guru)
            ->delete();
        DB::table('user')
            ->where('username', $request->id_guru)
            ->delete();
        return back()->with('success', 'Berhasil delete guru');
    }

    public function index()
    {
        return view('guru.data.index', [
            'title' => 'Data Guru',
            'navactive' => 'guru',
            'ai' => 1,
            'dataGuru' => DB::table('guru')->join('user', 'user.username', '=', 'guru.id_guru')->get()
        ]);
    }
}
