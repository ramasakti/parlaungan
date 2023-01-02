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
            'navactive' => 'siswa',
            'ai' => 1,
            'hariIni' => Carbon::now()->isoFormat('dddd, DD MMMM Y'),
            'dataKelas' => DB::table('kelas')->get(),
            'kelasSelected' => DB::table('kelas')->where('id_kelas', request('id_kelas'))->get(),
            'jamMasuk' => DB::table('hari')->where('nama_hari', Carbon::now()->isoFormat('dddd'))->get(),
            'dataAbsen' => $this->absen()->where('siswa.kelas_id', request('id_kelas'))->orderBy('siswa.nama_siswa')->get(),
            'dataTerlambat' => $this->terlambat()->get(),
            'dataKetidakhadiran' => $this->ketidakhadiran()->get(),
        ]);
    }

    public function updateAbsen(Request $request)
    {
        if ($request->keterangan === 'Hadir'){
            $dataAbsen = DB::table('absen')->where('id_siswa', $request->id_siswa)->get();
            if ($dataAbsen[0]->waktu_absen != NULL) {
                return back()->with('bePresent', 'Sudah absen');
            }

            $jamMasuk = $this->jamSekarang();
            if (date('H:i:s') > $jamMasuk[0]->masuk){
                DB::table('absen')->where('id_siswa', $request->id_siswa)->increment('jumlah_terlambat');
                DB::table('rekap_siswa')
                    ->insert([
                        'tanggal' => date('Y-m-d'),
                        'siswa_id' => $request->id_siswa,
                        'keterangan' => 'T',
                        'waktu_absen' => date('H:i:s')
                    ]);
            }

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

    public function viewEngine(Request $request)
    {
        if (!$request->cookie('username')){
            return redirect('/login');
        }
        return view('absen.engine', [
            'title' => 'Sistem Absen',
        ]);
    }
 
    public function engine(Request $request)
    {
        function jam() {
            $jamMasuk = DB::table('hari')
                        ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                        ->get();
            return $jamMasuk;
        }
        
        //Absen Guru
        function Guru($request) {
            $dataJadwal = DB::table('jadwal')
                            ->where('guru_id', $request->userabsen)
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
                    $jamPelajaran = jam()[0]->jampel;
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
                            ->where('absen.id_siswa', $request->userabsen)
                            ->orWhere('siswa.rfid', $request->userabsen)
                            ->get();
            
            if (count($siswaAbsen) > 0){
                if ($siswaAbsen[0]->waktu_absen === NULL){
                    $jamMasuk = jam();
                    if (date('H:i:s') > $jamMasuk[0]->masuk){
                        DB::table('absen')->where('id_siswa', $siswaAbsen[0]->id_siswa)->increment('jumlah_terlambat');
                        DB::table('rekap_siswa')
                            ->insert([
                                'tanggal' => date('Y-m-d'),
                                'siswa_id' => $siswaAbsen[0]->id_siswa,
                                'keterangan' => 'T',
                                'waktu_absen' => date('H:i:s')
                            ]);
                    }
                    DB::table('absen')
                        ->where('id_siswa', $siswaAbsen[0]->id_siswa)
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

        $userAbsen = DB::table('user')->where('username', $request->userabsen)->get();
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