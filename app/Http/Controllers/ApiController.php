<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ApiController extends Controller
{
    public function userAPI()
    {
        return response([
            'success' => TRUE,
            'data' => DB::table('user')->get(),
        ], 200);
    }

    public function engineAPI(Request $request, $id)
    {
        function jam() {
            $jamMasuk = DB::table('hari')->where('nama_hari', Carbon::now()->isoFormat('dddd'))->get();
            return $jamMasuk;
        }

        $siswaAbsen = DB::table('absen')
                        ->join('siswa', 'siswa.id_siswa', '=', 'absen.id_siswa')
                        ->where('absen.id_siswa', $id)
                        ->orWhere('siswa.rfid', $id)
                        ->first();

        if ($siswaAbsen){
            if ($siswaAbsen->waktu_absen === NULL){
                $jamMasuk = jam();
                DB::table('absen')
                    ->where('id_siswa', $siswaAbsen->id_siswa)
                    ->update([
                        'waktu_absen' => date('H:i:s'),
                        'izin' => NULL,
                        'keterangan' => ''
                    ]);
                if (date('H:i:s') > $jamMasuk->masuk){
                    DB::table('rekap_siswa')
                        ->insert([
                            'tanggal' => date('Y-m-d'),
                            'siswa_id' => $siswaAbsen->id_siswa,
                            'keterangan' => 'T',
                            'waktu_absen' => date('H:i:s')
                        ]);
                }
                return response([
                    'success' => TRUE,
                    'data' => $siswaAbsen,
                    'message' => 'Berhasil Absen'
                ], 201);
            }else{
                return response([
                    'success' => FALSE,
                    'data' => $siswaAbsen,
                    'message' => 'Sudah Absen'
                ], 201);
            }
        }else{
            return response([
                'success' => FALSE,
                'data' => NULL,
                'message' => 'ID anda tidak terdaftar!'
            ], 404);
        }
    }
}
