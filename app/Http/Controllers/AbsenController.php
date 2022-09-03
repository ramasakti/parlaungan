<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AbsenController extends Controller
{
    public function jamSekarang()
    {
        $jamMasuk = DB::table('hari')
                        ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                        ->get();
        return $jamMasuk;
    }

    public function absen()
    {
        $dataAbsen = DB::table('absen')
                        ->join('siswa', 'siswa.id_siswa', '=', 'absen.id_siswa');
        return $dataAbsen;
    }

    public function terlambat()
    {
        $jamMasuk = $this->jamSekarang();
        $dataTerlambat = DB::table('absen')
                        ->join('siswa', 'siswa.id_siswa', '=', 'absen.id_siswa')
                        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.kelas_id')
                        ->where('waktu_absen', '>', $jamMasuk[0]->masuk);
        return $dataTerlambat;
    }

    public function ketidakhadiran()
    {
        $dataKetidakhadiran = DB::table('absen')
                                ->join('siswa', 'siswa.id_siswa', '=', 'absen.id_siswa')
                                ->join('kelas', 'kelas.id_kelas', '=', 'siswa.kelas_id')
                                ->where('waktu_absen', NULL);
        return $dataKetidakhadiran;
    }

    public function index()
    {
        return view('absen.index', [
            'title' => 'Absen Siswa',
            'navactive' => 'absen',
            'ai' => 1,
            'hariIni' => Carbon::now()->isoFormat('dddd, DD MMMM Y'),
            'dataKelas' => DB::table('kelas')->get(),
            'jamMasuk' => DB::table('hari')->where('nama_hari', Carbon::now()->isoFormat('dddd'))->get(),
            'dataAbsen' => $this->absen()->where('siswa.kelas_id', request('id_kelas'))->orderBy('siswa.nama_siswa')->get(),
            'dataTerlambat' => $this->terlambat()->get(),
            'dataKetidakhadiran' => $this->ketidakhadiran()->get(),
        ]);
    }

    public function updateAbsen(Request $request)
    {
        if ($request->keterangan === 'Hadir'){
            DB::table('absen')->increment('jumlah_terlambat');
            DB::table('absen')
                ->where('id_siswa', $request->id_siswa)
                ->update([
                    'waktu_absen' => date('H:i:s'),
                    'izin' => NULL,
                    'keterangan' => ''
                ]);
        }else{
            DB::table('absen')
                ->where('id_siswa', $request->id_siswa)
                ->update([
                    'waktu_absen' => NULL,
                    'keterangan' => $request->keterangan,
                    'izin' => date('Y-m-d')
                ]);
        }

        return back();
    }

    public function rfid(Request $request)
    {
        return view('absen.rfid', [
            'title' => 'Sistem Absen',
        ]);
    }

    public function qrcode(Request $request)
    {
        return view('absen.qrcode', [
            'title' => 'Sistem Absen',
        ]);
    }

    public function engineRFID(Request $request)
    {
        $userAbsen = DB::table('user')->where('username', $request->userabsen)->get();
        if (count($userAbsen) > 0){
            //Guru
        }else{
            $siswaAbsen = DB::table('absen')
                                ->join('siswa', 'siswa.id_siswa', '=', 'absen.id_siswa')
                                ->where('absen.id_siswa', $request->userabsen)
                                ->get();
                               
            if (count($siswaAbsen) > 0){
                if ($siswaAbsen[0]->waktu_absen === NULL){
                    $jamMasuk = $this->jamSekarang();
                    if (date('H:i:s') > $jamMasuk[0]->masuk){
                        DB::table('absen')->where('id_siswa', $request->userabsen)->increment('jumlah_terlambat');
                    }
                    DB::table('absen')
                        ->where('id_siswa', $request->userabsen)
                        ->update([
                            'waktu_absen' => date('H:i:s'),
                            'izin' => NULL,
                            'keterangan' => '',
                        ]);
                    return back()->with('success', $siswaAbsen[0]->nama_siswa);
                }else{
                    return back()->with('bePresent', $siswaAbsen[0]->nama_siswa);
                }
            }else{
                return back()->with('unregistered', 'ID Anda tidak terdaftar!');
            }
        }
    }

    public function engineQR($userabsen)
    {
        $userAbsen = DB::table('user')->where('username', $userabsen)->get();
        if (count($userAbsen) > 0){
            //Guru
        }else{
            $siswaAbsen = DB::table('absen')
                                ->join('siswa', 'siswa.id_siswa', '=', 'absen.id_siswa')
                                ->where('absen.id_siswa', $userabsen)
                                ->get();
                               
            if (count($siswaAbsen) > 0){
                if ($siswaAbsen[0]->waktu_absen === NULL){
                    $jamMasuk = $this->jamSekarang();
                    if (date('H:i:s') > $jamMasuk[0]->masuk){
                        DB::table('absen')->where('id_siswa', $userabsen)->increment('jumlah_terlambat');
                    }
                    DB::table('absen')
                        ->where('id_siswa', $userabsen)
                        ->update([
                            'waktu_absen' => date('H:i:s'),
                            'izin' => NULL,
                            'keterangan' => '',
                        ]);
                    return back()->with('success', $siswaAbsen[0]->nama_siswa);
                }else{
                    return back()->with('bePresent', $siswaAbsen[0]->nama_siswa);
                }
            }else{
                return back()->with('unregistered', 'ID Anda tidak terdaftar!');
            }
        }
    }
}
