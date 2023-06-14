<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $nwJurnal = DB::table('jurnal')
                        ->select(
                            'id_jurnal', 
                            'jam_pelajaran.hari', 
                            'jam_pelajaran.mulai', 
                            'jam_pelajaran.selesai', 
                            'jadwal.mapel', 
                            'kelas.tingkat', 
                            'kelas.jurusan', 
                            'guru.nama_guru',
                        )
                        ->where('jurnal.tanggal', request('tanggal'))
                        ->join('jadwal', 'jurnal.jadwal_id', '=', 'jadwal.id_jadwal')
                        ->join('jam_pelajaran', 'jam_pelajaran.id_jampel', '=', 'jadwal.jampel')
                        ->join('kelas', 'kelas.id_kelas', '=', 'jadwal.kelas_id')
                        ->join('guru', 'guru.id_guru', '=', 'jadwal.guru_id')
                        ->get();

        return view('jurnal.index', [
                'title' => 'Jurnal',
                'navactive' => 'akademik',
                'ai' => 1,
                'dataJurnal' => $nwJurnal
        ]);
    }
}
