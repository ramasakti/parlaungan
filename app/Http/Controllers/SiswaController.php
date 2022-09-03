<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SiswaController extends Controller
{

    public function index(Request $request)
    {
        if (request()->has('id_kelas')){
            session()->put('siswa', 'uk-active');
        }
        return view('siswa.index', [
            'title' => 'Siswa',
            'navactive' => 'siswa',
            'ai' => 1,
            'dataKelas' => DB::table('kelas')->get(),
            'kelasSelected' => DB::table('kelas')->where('id_kelas', request('id_kelas'))->get(),
            'dataSiswa' => DB::table('siswa')->where('kelas_id', request('id_kelas'))->orderBy('nama_siswa')->get(),
            'dataGuru' => DB::table('guru')->get(),
        ]);
    }

    public function storeKelas(Request $request)
    {
        DB::table('kelas')
            ->insert([
                'tingkat' => $request->tingkat,
                'jurusan' => $request->jurusan,
                'walas' => $request->walas,
            ]);
        return back()->with('kelas', 'uk-active');
    }

    public function updateKelas(Request $request)
    {
        DB::table('kelas')
            ->where('id_kelas', $request->id_kelas)
            ->update([
                'tingkat' => $request->tingkat,
                'jurusan' => $request-> jurusan,
                'walas' => $request-> walas,
            ]);
        return back()->with('kelas', 'uk-active');
    }

    public function destroyKelas(Request $request)
    {
        DB::table('kelas')
            ->where('id_kelas', $request->id_kelas)
            ->delete();
        return back()->with('kelas', 'uk-active');
    }

    public function graduation(Request $request)
    {
        DB::table('kelas')
            ->where('tingkat', 'XII')
            ->delete();

        DB::table('kelas')
            ->where('tingkat', 'XI')
            ->update([
                'tingkat' => 'XII'
            ]);

        DB::table('kelas')
            ->where('tingkat', 'X')
            ->update([
                'tingkat' => 'XI'
            ]);

        return back()->with('kelas', 'uk-active');
    }

    public function storeSiswa(Request $request)
    {
        $validatedSiswa = $request->validate([
            'id_siswa' => 'required|unique:siswa'
        ]);

        DB::table('siswa')
            ->insert([
                'id_siswa' => $request->id_siswa,
                'nama_siswa' => $request->nama_siswa,
                'kelas_id' => $request->kelas_id,
            ]);
        
        DB::table('absen')
            ->insert([
                'id_siswa' => $request->id_siswa,
                'waktu_absen' => NULL,
                'rekap' => '',
                'jumlah_terlambat' => 0,
                'izin' => NULL,
                'keterangan' => '',
            ]);
            
        return back()->with('siswa', 'uk-active');
    }

    public function updateSiswa(Request $request)
    {
        $validatedSiswa = $request->validate([
            'id_siswa' => 'required|unique:siswa'
        ]);

        DB::table('siswa')
            ->where('id_siswa', $request->id_lama)
            ->update([
                'id_siswa' => $request->id_siswa,
                'nama_siswa' => $request->nama_siswa,
                'kelas_id' => $request->kelas_id,
            ]);

        DB::table('absen')
            ->where('id_siswa', $request->id_lama)
            ->update([
                'id_siswa' => $request->id_siswa
            ]);

        return back()->with('siswa', 'uk-active');
    }

    public function destroySiswa(Request $request)
    {
        DB::table('siswa')
            ->where('id_siswa', $request->id_siswa)
            ->delete();

        DB::table('absen')
            ->where('id_siswa', $request->id_siswa)
            ->delete();

        return back()->with('siswa', 'uk-active');
    }
}
