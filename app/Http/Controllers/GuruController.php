<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class GuruController extends Controller
{
    public function dataJadwal()
    {
        $dataJadwal = DB::table('jadwal')
                        ->crossJoin('guru')
                        ->select('guru.id_guru', 'guru.nama_guru', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/40/60 as jumlah_jam'))
                        ->where('guru.id_guru','=',DB::raw('jadwal.guru_id'))
                        ->groupBy('jadwal.guru_id')
                        ->get();
        return $dataJadwal;
    }

    public function keuangan(Request $request)
    {
        return view('guru.keuangan.index', [
            "title" => "Keuangan Guru",
            "navactive" => "guru",
            "dataJadwal" => $this->dataJadwal(),
        ]);
    }

    public function index()
    {
        return view('guru.data.index', [
            'title' => 'Data Guru',
            'navactive' => 'guru'
        ]);
    }
}
