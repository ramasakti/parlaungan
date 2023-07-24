<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
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
        // Parsing ke Integer
        $penghasilanIbu = str_replace('.', '', $request->penghasilan_ibu);
        $penghasilanAyah = str_replace('.', '', $request->penghasilan_ayah);

        // Cek Inputan KK
        if ($request->hasFile('kk')) {
            $kk = $request->file('kk');
            $scan_kk = base64_encode(file_get_contents($kk->getPathname()));

            DB::table('detail_siswa')
                ->where('siswa_id', $request->siswa_id)
                ->update([
                    'scan_kk' => $scan_kk,
                ]);
        }

        // Cek Inputan Ijazah
        if ($request->hasFile('ijazah')) {
            $ijazah = $request->file('ijazah');
            $scan_ijazah = base64_encode(file_get_contents($ijazah->getPathname()));

            DB::table('detail_siswa')
                ->where('siswa_id', $request->siswa_id)
                ->update([
                    'scan_ijazah' => $scan_ijazah,
                ]);
        }

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
                'penghasilan_ibu' => (int)$penghasilanIbu,
                'telp_ibu' => $request->telp_ibu,
                'ayah' => $request->ayah,
                'nik_ayah' => $request->nikayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'profesi_ayah' => $request->profesi_ayah,
                'penghasilan_ayah' => (int)$penghasilanAyah,
                'telp_ayah' => $request->telp_ayah,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat
            ]);
        return back()->with('biodata', 'Berhasil update biodata!');
    }

    public function updateAkun(Request $request)
    {
        $user = DB::table('user')->where('username', $request->username)->get();
        if ($request->passwordBaru != $request->confPasswordBaru) {
            return back()->with('fail', 'Password tidak valid!');
        }
        if (!Hash::check($request->passwordLama, $user[0]->password)) {
            return back()->with('fail', 'Masukkan password lama dengan benar!');
        }
        DB::table('user')
            ->where('username', $request->username)
            ->update([
                'password' => bcrypt($request->passwordBaru),
            ]);
        return back()->with('success', 'Berhasil update password');
    }

    public function siswa()
    {
        return DB::table('siswa')
                    ->join('detail_siswa', 'detail_siswa.siswa_id', '=', 'siswa.id_siswa')
                    ->where('siswa.id_siswa', session('username'))
                    ->get();
    }

    public function downloadKK($id)
    {
        $kk = DB::table('detail_siswa')->where('siswa_id', $id)->first();
        $decodedData = base64_decode($kk->scan_kk);

        return response($decodedData)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="KK-' . $kk->siswa_id . '.pdf"');
    }

    public function downloadIjazah($id)
    {
        $ijazah = DB::table('detail_siswa')->where('siswa_id', $id)->first();
        $decodedData = base64_decode($ijazah->scan_ijazah);

        return response($decodedData)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="Ijazah-' . $ijazah->siswa_id . '.pdf"');
    }
}
