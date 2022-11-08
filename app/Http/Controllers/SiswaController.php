<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use DB;

class SiswaController extends Controller
{
    public function importAbsenData()
    {
        $dataAbsen = DB::table('absen')->select('id_siswa')->get();
        $dataSiswa = DB::table('siswa')->whereNotIn('id_siswa', json_decode($dataAbsen, TRUE))->get();
        if (count($dataSiswa) > 0) {
            DB::table('absen')
                ->insert([
                    'id_siswa' => $dataSiswa[0]->id_siswa,
                    'waktu_absen' => NULL,
                    'rekap' => '',
                    'jumlah_terlambat' => 0,
                    'izin' => NULL,
                    'keterangan' => '',
                ]);
        }
    }

    public function import(Request $request)
    {
        Excel::import(new SiswaImport, request()->file('siswa')); //'file' diisi dengan name uploader
        return back()->with('imported', 'Berhasil import siswa!');
    }

    public function index(Request $request)
    {
        if (request()->has('id_kelas')){
            session()->put('siswa', 'uk-active');
        }
        $this->importAbsenData();
        return view('siswa.index', [
            'title' => 'Siswa',
            'navactive' => 'siswa',
            'ai' => 1,
            'dataKelas' => DB::table('kelas')->join('guru', 'guru.id_guru', '=', 'kelas.walas')->get(),
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
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir
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
        if ($request->id_lama != $request->id_siswa){
            $validatedSiswa = $request->validate([
                'id_siswa' => 'required|unique:siswa'
            ]);
        }

        DB::table('siswa')
            ->where('id_siswa', $request->id_lama)
            ->update([
                'id_siswa' => $request->id_siswa,
                'nama_siswa' => $request->nama_siswa,
                'kelas_id' => $request->kelas_id,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
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
