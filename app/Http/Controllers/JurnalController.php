<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $dataJurnal = DB::table('jurnal')
                        ->where('jurnal.tanggal', request('tanggal'))
                        ->select('jurnal.id_jurnal', 'jurnal.lama', 'jadwal.hari', 'jadwal.mapel', 'jadwal.mulai', 'jadwal.sampai', 'kelas.tingkat', 'kelas.jurusan', 'guru.nama_guru')
                        ->join('jadwal', 'jurnal.jadwal_id', '=', 'jadwal.id_jadwal')
                        ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                        ->join('guru', 'jadwal.guru_id', '=', 'guru.id_guru')
                        ->get();

        return view('jurnal.index', [
                'title' => 'Jurnal',
                'navactive' => 'akademik',
                'ai' => 1,
                'dataJurnal' => $dataJurnal
        ]);
    }
}
