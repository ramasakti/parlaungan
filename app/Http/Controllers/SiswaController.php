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
        $insertAbsen = DB::table('siswa')->whereNotIn('id_siswa', json_decode($dataAbsen, TRUE))->get();
        if (count($insertAbsen) > 0) {
            for ($i=0; $i<count($insertAbsen); $i++) {
                DB::table('absen')
                    ->insert([
                        'id_siswa' => $insertAbsen[$i]->id_siswa,
                        'waktu_absen' => NULL,
                        'izin' => NULL,
                        'keterangan' => ''
                    ]);
            }
        }
    }

    public function importDetailSiswa()
    {
        $detailSiswa = DB::table('detail_siswa')->select('siswa_id')->get();
        $insertDetail = DB::table('siswa')->whereNotIn('id_siswa', json_decode($detailSiswa, TRUE))->get();
        if (count($insertDetail) > 0) {
            for ($i=0; $i<count($insertDetail); $i++) {
                DB::table('detail_siswa')
                    ->insert([
                        'siswa_id' => $insertDetail[$i]->id_siswa,
                        'nik' => '',
                        'nokk' => '',
                        'transportasi' => '',
                        'anak' => '',
                        'jenis_tinggal' => '',
                        'askol' => '',
                        'ibu' => '',
                        'nik_ibu' => '',
                        'pendidikan_ibu' => '',
                        'penghasilan_ibu' => '',
                        'ayah' => '',
                        'nik_ayah' => '',
                        'pendidikan_ayah' => '',
                        'penghasilan_ayah' => '',
                        'tinggi' => 0,
                        'berat' => 0
                    ]);
            }
        }
    }

    public function import(Request $request)
    {
        Excel::import(new SiswaImport, request()->file('siswa')); //'file' diisi dengan name uploader
        return back()->with('imported', 'Berhasil import siswa!');
    }

    public function index(Request $request)
    {
        $this->importAbsenData();
        $this->importDetailSiswa();
        return view('siswa.index', [
            'title' => 'Siswa',
            'navactive' => 'siswa',
            'ai' => 1,
            'dataKelas' => DB::table('kelas')->join('guru', 'guru.id_guru', '=', 'kelas.walas')->get(),
            'kelasSelected' => DB::table('kelas')->where('id_kelas', request('id_kelas'))->get(),
            'dataSiswa' => DB::table('siswa')->where('kelas_id', request('id_kelas'))->orderBy('nama_siswa')->get(),
            'dataGuru' => DB::table('guru')->get(),
            'dataKelulusan' => app('App\Http\Controllers\KelulusanController')->dataKelulusan()
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
        return back()->with('kelas', 'Berhasil menambah kelas!');
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
        return back()->with('kelas', 'Berhasil edit kelas!');
    }

    public function destroyKelas(Request $request)
    {
        DB::table('kelas')
            ->where('id_kelas', $request->id_kelas)
            ->delete();
        return back()->with('kelas', 'Berhasil delete kelas!');
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

        return back()->with('kelas', 'Berhasil menaikkan tingkatan kelas!');
    }

    public function storeSiswa(Request $request)
    {
        $validatedSiswa = $request->validate([
            'id_siswa' => 'required|unique:siswa'
        ]);

        DB::table('siswa')
            ->insert([
                'id_siswa' => $request->id_siswa,
                'rfid' => $request->rfid,
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
                'izin' => NULL,
                'keterangan' => '',
            ]);
            
        return back()->with('siswa', [
            'success' => 'Berhasil tambah siswa!'
        ]);
    }

    public function updateSiswa(Request $request)
    {
        if ($request->id_lama != $request->id_siswa){
            $validatedSiswa = $request->validate([
                'id_siswa' => 'required|unique:siswa',
                'rfid' => 'required|unique:siswa'
            ]);
        }

        DB::table('siswa')
            ->where('id_siswa', $request->id_lama)
            ->update([
                'id_siswa' => $request->id_siswa,
                'rfid' => $request->rfid,
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

        return back()->with('siswa', 'Berhasil update data siswa!');
    }

    public function destroySiswa(Request $request)
    {
        DB::table('siswa')
            ->where('id_siswa', $request->id_siswa)
            ->delete();

        DB::table('absen')
            ->where('id_siswa', $request->id_siswa)
            ->delete();

        return back()->with('siswa', 'Berhasil delete data siswa!');
    }

    public function ktp($id_siswa)
    {
        return view('ktp', [
            'data' => DB::table('siswa')->join('user', 'user.username', '=', 'siswa.id_siswa')->where('id_siswa', $id_siswa)->first()
        ]);
    }
}
