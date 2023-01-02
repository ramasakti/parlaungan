<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalImport;
use App\Models\Jadwal;
use Carbon\Carbon;
use DB;

class JadwalController extends Controller
{
    public function jadwal()
    {
        return DB::table('guru')
                ->crossJoin('jadwal')
                ->select('jadwal.id_jadwal', 'jadwal.hari', 'jadwal.guru_id', 'jadwal.kelas_id', 'jadwal.mapel', 'jadwal.mulai', 'jadwal.sampai', 'jadwal.status', 'guru.nama_guru')
                ->where('guru.id_guru', '=', DB::raw('jadwal.guru_id'));
    }   

    public function jadwalSenin()
    {
        return $this->jadwal()->where('jadwal.hari', '=', 'Senin');
    }
    
    public function jadwalSelasa()
    {
        return $this->jadwal()->where('jadwal.hari', '=', 'Selasa');
    }

    public function jadwalRabu()
    {
        return $this->jadwal()->where('jadwal.hari', '=', 'Rabu');
    }

    public function jadwalKamis()
    {
        return $this->jadwal()->where('jadwal.hari', '=', 'Kamis');
    }

    public function jadwalJumat()
    {
        return $this->jadwal()->where('jadwal.hari', '=', 'Jumat');
    }

    public function jadwalSabtu()
    {
        return $this->jadwal()->where('jadwal.hari', '=', 'Sabtu');
    }

    public function index(Request $request)
    {
        return view('jadwal.index', [
            'title' => 'Jadwal Pelajaran',
            'navactive' => 'jadwal',
            'ai' => 1,
            'dataKelas' => DB::table('kelas')->get(),
            'kelasSelected' => DB::table('kelas')->where('id_kelas', request('id_kelas'))->get(),
            'dataGuru' => DB::table('guru')->get(),
            'dataHari' => DB::table('hari')->get(),
            'dataSenin' => $this->jadwalSenin()->where('jadwal.kelas_id', request('id_kelas'))->get(),
            'dataSelasa' => $this->jadwalSelasa()->where('jadwal.kelas_id', request('id_kelas'))->get(),
            'dataRabu' => $this->jadwalRabu()->where('jadwal.kelas_id', request('id_kelas'))->get(),   
            'dataKamis' => $this->jadwalKamis()->where('jadwal.kelas_id', request('id_kelas'))->get(),
            'dataJumat' => $this->jadwalJumat()->where('jadwal.kelas_id', request('id_kelas'))->get(),
            'dataSabtu' => $this->jadwalSabtu()->where('jadwal.kelas_id', request('id_kelas'))->get(),
        ]);
    }

    public function storeJadwal(Request $request)
    {
        DB::table('jadwal')
            ->insert([
                'hari' => $request->hari,
                'guru_id' => $request->guru_id,
                'kelas_id' => $request->kelas_id,
                'mapel' => $request->mapel,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
                'status' => ''
            ]);
        return back();
    }

    public function import(Request $request)
    {
        Excel::import(new JadwalImport, request()->file('jadwal')); //'file' diisi dengan name uploader
        return back()->with('imported', 'Berhasil jadwal pelajaran!');
    }

    public function deleteJadwal(Request $request)
    {
        DB::table('jadwal')
            ->where('id_jadwal', $request->id_jadwal)
            ->delete();
        return back()->with('success', 'Berhasil delete jadwal!');
    }

    public function absenGuruManual(Request $request)
    {
        function jam() {
            $jamMasuk = DB::table('hari')
                        ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                        ->get();
            return $jamMasuk;
        }

        $dataJadwal = DB::table('jadwal')
                ->where('id_jadwal', $request->id_jadwal)
                ->where('mulai', '<', date('H:i:s'))
                ->where('sampai', '>', date('H:i:s'))
                ->get();
        $dataJurnal = DB::table('jurnal')
                ->where('jadwal_id', $request->id_jadwal)
                ->where('tanggal', date('Y-m-d'))
                ->get();

        if (count($dataJadwal) < 1) {
            return back()->with('unschedule', 'Jadwal belum dimulai atau telah selesai');
        }

        if (count($dataJurnal) < 1){
            if ($request->status != NULL) {
                //Rekap Ketidakhadiran
                DB::table('inval')
                    ->insert([
                        'tanggal' => date('Y-m-d'),
                        'jadwal_id' => $request->id_jadwal,
                        'keterangan' => $request->status,
                        'penginval' => $request->guru_id
                    ]);
                //Update status jadwal menjadi hadir
                DB::table('jadwal')
                    ->where('id_jadwal', $request->id_jadwal)
                    ->update(['status' => $request->status]); //HVSIA
                //Insert ke jurnal
                $jamPelajaran = jam()[0]->jampel;
                DB::table('jurnal')
                    ->insert([
                        'tanggal' => date('Y-m-d'),
                        'jadwal_id' => $request->id_jadwal,
                        'masuk' => $request->masuk,
                        'lama' => ceil((strtotime($request->sampai)-strtotime(date('H:i:s')))/intval(substr($jamPelajaran, 3, 2))/60),
                        'inval' => 1,
                        'transport' => 1,
                        'materi' => ''
                    ]);
                return back()->with('inserted', 'Selamat mengajar!');
            }
            //Update status jadwal menjadi hadir
            DB::table('jadwal')
                ->where('id_jadwal', $request->id_jadwal)
                ->update(['status' => 'H']); //HVSIA
            //Insert ke jurnal
            $jamPelajaran = jam()[0]->jampel;
            DB::table('jurnal')
                ->insert([
                    'tanggal' => date('Y-m-d'),
                    'jadwal_id' => $request->id_jadwal,
                    'masuk' => $request->masuk,
                    'lama' => ceil((strtotime($request->sampai)-strtotime(date('H:i:s')))/intval(substr($jamPelajaran, 3, 2))/60),
                    'inval' => 0,
                    'transport' => 1,
                    'materi' => ''
                ]);
            return back()->with('inserted', 'Selamat mengajar!');
        }else{ 
            return back()->with('filled', 'Kelas sudah terisi!');
        }
    }
}
