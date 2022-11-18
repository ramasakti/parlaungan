<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class GuruController extends Controller
{
    public function jampel()
    {
        return DB::table('hari')
                    ->select(DB::raw('TIME_TO_SEC(jampel)/60 as jampel'))
                    ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                    ->get();
    }

    public function dataJadwal()
    {
        $jampel = $this->jampel()[0]->jampel;
        $dataJadwal = DB::table('jadwal')
                        ->crossJoin('guru')
                        ->select('guru.id_guru', 'guru.nama_guru', DB::raw("SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/$jampel/60 as jumlah_jam"))
                        ->where('guru.id_guru','=',DB::raw('jadwal.guru_id'))
                        ->groupBy('jadwal.guru_id')
                        ->get();
        return $dataJadwal;
    }
    
    public function nominal()
    {
        return DB::table('nominal')->get();
    }

    public function dataTransport()
    {
        if (count($this->dataJadwal()) < 1) {
            return [];
        }
        $dataTransport = DB::table('jurnal')
                            ->crossJoin('jadwal')
                            ->select('jurnal.id_jurnal')
                            ->where('jadwal.guru_id', $this->dataJadwal()[0]->id_guru)
                            ->where('jurnal.tanggal', '>=', request('dari'))
                            ->where('jurnal.tanggal', '<=', request('sampai'))
                            ->get();
        return $dataTransport;
    }

    public function tertunaikan()
    {
        if (count($this->dataJadwal()) < 1) {
            return [];
        }
        $dataTertunaikan = DB::table('jurnal')
                            ->crossJoin('jadwal') 
                            ->select('jadwal.guru_id', DB::raw('SUM(jurnal.lama) as tertunaikan'))
                            ->where('jadwal.guru_id', $this->dataJadwal()[0]->id_guru)
                            ->where('jurnal.jadwal_id', '=', DB::raw('jadwal.id_jadwal'))
                            ->where('jurnal.tanggal', '>=', request('dari'))
                            ->where('jurnal.tanggal', '<=', request('sampai'))
                            ->groupBy('jurnal.jadwal_id')
                            ->get();
        return ($dataTertunaikan);
    }

    public function total()
    {
        if (count($this->tertunaikan()) < 1) {
            return [];
        }
        return $this->tertunaikan()[0]->tertunaikan * ($this->nominal()[0]->harga / 4);
    }

    public function keuangan(Request $request)
    {
        return view('guru.keuangan.index', [
            'title' => 'Keuangan Guru',
            'navactive' => 'guru',
            'dataTertunaikan' => $this->tertunaikan(),
            'dataJadwal' => $this->dataJadwal(),
            'dataTransport' => $this->dataTransport(),
            'dataNominal' => $this->nominal(),
            'total' => $this->total()
        ]);
    }

    public function index()
    {
        return view('guru.data.index', [
            'title' => 'Data Guru',
            'navactive' => 'guru',
            'ai' => 1,
            'dataGuru' => DB::table('guru')->get()
        ]);
    }

    public function addGuru(Request $request)
    {
        DB::table('guru')
            ->insert([
                'id_guru' => $request->id_guru,
                'nama_guru' => $request->nama_guru,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);
        return back()->with('success', 'Berhasil menambah data guru!');
    }
}
