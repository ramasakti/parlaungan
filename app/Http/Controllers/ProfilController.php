<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProfilController extends Controller
{
    public function updateProfil(Request $request)
    {
        DB::table('user')
            ->where('username', $request->username)
            ->update([
                ''
            ]);
    }

    public function updateBiodata(Request $request)
    {
        DB::table('detail_siswa')
            ->where('siswa_id', $request->siswa_id)
            ->update([
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'nokk' => $request->nokk,
                'transportasi' => $request->transportasi,
                'anak' => $request->anak,
                'jenis_tinggal' => $request->jenis_tinggal,
                'askol' => $request->askol,
                'ibu' => $request->ibu,
                'nik_ibu' => $request->nikibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'profesi_ibu' => $request->profesi_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'ayah' => $request->ayah,
                'nik_ayah' => $request->nikayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'profesi_ayah' => $request->profesi_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat
            ]);
        return back()->with('biodata', 'Berhasil update biodata!');
    }

    public function siswa()
    {
        return DB::table('siswa')
                    ->join('detail_siswa', 'detail_siswa.siswa_id', '=', 'siswa.id_siswa')
                    ->where('siswa.id_siswa', session('username'))
                    ->get();
    }
}
