<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $dataJurnal = DB::table('jurnal')
                        ->where('jurnal.tanggal', request('tanggal'))
                        ->select('jurnal.id', 'jurnal.lama', 'jadwal.hari', 'jadwal.mapel', 'jadwal.mulai', 'jadwal.sampai', 'kelas.tingkat', 'kelas.jurusan', 'guru.nama_guru')
                        ->join('jadwal', 'jurnal.jadwal_id', '=', 'jadwal.id')
                        ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                        ->join('guru', 'jadwal.guru_id', '=', 'guru.id_guru')
                        ->get();

        return view('kbm.jurnal', [
                "title" => "Jurnal",
                "active" => "kbm",
                "username" => $request->session()->get('username'),
                "statusUser" => $statusUser[0]->status,
                "dataJurnal" => $dataJurnal
            ]);
    }
}
