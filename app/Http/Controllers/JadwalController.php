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
        DB::table('guru')
                ->crossJoin('jadwal')
                ->select('jadwal.id_jadwal', 'jadwal.hari', 'jadwal.guru_id', 'jadwal.kelas_id', 'jadwal.mapel', 'jadwal.mulai', 'jadwal.sampai', 'jadwal.status', 'guru.nama_guru')
                ->where('guru.id_guru', '=', DB::raw('jadwal.guru_id'));

        $nw = DB::table('jadwal')
                ->join('guru', 'guru.id_guru', '=', 'jadwal.guru_id')
                ->join('jam_pelajaran', 'jam_pelajaran.id_jampel', '=', 'jadwal.jampel');
        return $nw;
    }   

    public function jadwalSenin()
    {
        return $this->jadwal()->where('jam_pelajaran.hari', 'Senin');
    }
    
    public function jadwalSelasa()
    {
        return $this->jadwal()->where('jam_pelajaran.hari', 'Selasa');
    }

    public function jadwalRabu()
    {
        return $this->jadwal()->where('jam_pelajaran.hari', 'Rabu');
    }

    public function jadwalKamis()
    {
        return $this->jadwal()->where('jam_pelajaran.hari', 'Kamis');
    }

    public function jadwalJumat()
    {
        return $this->jadwal()->where('jam_pelajaran.hari', 'Jumat');
    }

    public function jadwalSabtu()
    {
        return $this->jadwal()->where('jam_pelajaran.hari', 'Sabtu');
    }

    public function index(Request $request)
    {
        return view('jadwal.index', [
            'title' => 'Jadwal Pelajaran',
            'navactive' => 'akademik',
            'ai' => 1,
            'dataKelas' => DB::table('kelas')->get(),
            'kelasSelected' => DB::table('kelas')->where('id_kelas', request('id_kelas'))->get(),
            'dataGuru' => DB::table('guru')->get(),
            'dataHari' => DB::table('hari')->get(),
            'dataJampel' => DB::table('jam_pelajaran')->get(),
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
        $existingJampel = DB::table('jadwal')
                            ->where('jampel', $request->jampel)
                            ->where('kelas_id', $request->kelas_id)
                            ->first();
        if ($existingJampel) {
            return back()->with('fail', 'Jam Pelajaran telah digunakan');
        }
        DB::table('jadwal')
            ->insert([
                'jampel' => $request->jampel,
                'guru_id' => $request->guru_id,
                'kelas_id' => $request->kelas_id,
                'mapel' => $request->mapel,
                'status' => ''
            ]);
        return back()->with('success', 'Berhasil menambahkan jadwal!');
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
            return DB::table('hari')->where('nama_hari', Carbon::now()->isoFormat('dddd'))->first();
        }

        $dataJadwal = DB::table('jadwal')->where('id_jadwal', $request->id_jadwal)->first();
        $dataJurnal = DB::table('jurnal')
                        ->where('jadwal_id', $request->id_jadwal)
                        ->where('tanggal', date('Y-m-d'))
                        ->get();

        if (count($dataJurnal) < 1) {
            if ($request->status != NULL) {
                //Cek Inputan Penginval, Tidak Boleh = Guru Sesuai Jadwal
                if ($request->guru_id === $dataJadwal->guru_id) {
                    return back()->with('fail', 'Guru penginval tidak boleh sama dengan guru diinval');
                }
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
                $jamPelajaran = jam()->jampel;
                DB::table('jurnal')
                    ->insert([
                        'tanggal' => date('Y-m-d'),
                        'jadwal_id' => $request->id_jadwal,
                        'inval' => 1,
                        'transport' => 1,
                        'materi' => ''
                    ]);
                return back()->with('inserted', 'Selamat mengajar!');
            }else{
                //Update status jadwal menjadi hadir
                DB::table('jadwal')
                    ->where('id_jadwal', $request->id_jadwal)
                    ->update(['status' => 'H']);
                //Insert ke jurnal
                $jamPelajaran = jam()->jampel;
                DB::table('jurnal')
                    ->insert([
                        'tanggal' => date('Y-m-d'),
                        'jadwal_id' => $request->id_jadwal,
                        'inval' => 0,
                        'transport' => 1,
                        'materi' => ''
                    ]);
                return back()->with('inserted', 'Selamat mengajar!');
            }
        }else{ 
            return back()->with('filled', 'Kelas sudah terisi!');
        }
    }
}
