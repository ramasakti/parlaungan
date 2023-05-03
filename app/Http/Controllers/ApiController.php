<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            return DB::table('hari')->where('nama_hari', Carbon::now()->isoFormat('dddd'))->first();
        }
        
        //Absen Guru
        function Guru($request) {
            $dataJadwal = DB::table('jadwal')
                            ->where('guru_id', $id)
                            ->where('hari', Carbon::now()->isoFormat('dddd'))
                            ->where('mulai', '<', date('H:i:s'))
                            ->where('sampai', '>', date('H:i:s'))
                            ->get();
            if (count($dataJadwal) > 0){
                $dataJurnal = DB::table('jurnal')
                                ->where('jadwal_id', $dataJadwal[0]->id_jadwal)
                                ->where('tanggal', date('Y-m-d'))
                                ->get();
                if (count($dataJurnal) < 1){
                    //Update status jadwal menjadi hadir
                    DB::table('jadwal')
                        ->where('id_jadwal', $dataJadwal[0]->id_jadwal)
                        ->update(['status' => 'H']); //HVSIA
                    //Insert ke jurnal
                    $jamPelajaran = jam()->jampel;
                    DB::table('jurnal')
                        ->insert([
                            'tanggal' => date('Y-m-d'),
                            'jadwal_id' => $dataJadwal[0]->id_jadwal,
                            'masuk' => date('H:i:s'),
                            'lama' => ceil((strtotime($dataJadwal[0]->sampai)-strtotime(date('H:i:s')))/intval(substr($jamPelajaran, 3, 2))/60),
                            'inval' => 0,
                            'transport' => 1,
                            'materi' => ''
                        ]);
                    return back()->with('inserted', 'Selamat mengajar!');
                }else{
                    return back()->with('filled', 'Kelas sudah terisi!');
                }
            }else{
                return back()->with('unschedule', 'Anda tidak memiliki jadwal');
            }
        }

        //Absen Siswa
        function Siswa($request) {
            $siswaAbsen = DB::table('absen')
                            ->join('siswa', 'siswa.id_siswa', '=', 'absen.id_siswa')
                            ->where('absen.id_siswa', $id)
                            ->orWhere('siswa.rfid', $id)
                            ->get();
            
            if (count($siswaAbsen) > 0){
                if ($siswaAbsen[0]->waktu_absen === NULL){
                    $jamMasuk = jam();
                    DB::table('absen')
                        ->where('id_siswa', $siswaAbsen[0]->id_siswa)
                        ->update([
                            'waktu_absen' => date('H:i:s'),
                            'izin' => NULL,
                            'keterangan' => ''
                        ]);
                    if (date('H:i:s') > $jamMasuk[0]->masuk){
                        DB::table('rekap_siswa')
                            ->insert([
                                'tanggal' => date('Y-m-d'),
                                'siswa_id' => $siswaAbsen[0]->id_siswa,
                                'keterangan' => 'T',
                                'waktu_absen' => date('H:i:s')
                            ]);
                    }
                    return back()->with('success', $siswaAbsen[0]->nama_siswa);
                }else{
                    return back()->with('bePresent', $siswaAbsen[0]->nama_siswa);
                }
            }else{
                return back()->with('unregistered', 'ID Anda tidak terdaftar!');
            }
        }

        $userAbsen = DB::table('user')->where('username', $id)->get();
        switch (count($userAbsen)) {
            //Guru
            case 1:
                if ($userAbsen[0]->status === 'Siswa') {
                    Siswa($request);
                    return back();
                }else{
                    Guru($request);
                    return back();
                }
            break;
            
            //Siswa
            case 0:
                Siswa($request);
                return back();
            break;
        }
    }
}
