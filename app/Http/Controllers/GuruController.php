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
        $jampel = DB::table('hari')
                    ->select(DB::raw('TIME_TO_SEC(jampel)/60 as jampel'))
                    ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                    ->get();
        return intval(array_column($jampel->toArray(), 'jampel')[0]);
    }
    
    public function nominal()
    {
        return DB::table('nominal')->get();
    }

    public function keuangan(Request $request)
    {
        return view('guru.keuangan.index', [
            'title' => 'Keuangan Guru',
            'navactive' => 'guru',
            'dataGuru' => DB::table('guru')->get(),
            'jampel' => $this->jampel(),
            'dataNominal' => $this->nominal(),
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

        DB::table('absen_guru')
            ->insert([
                'id_guru' => $request->id_guru,
                'waktu_absen' => NULL,
                'keterangan' => ''
            ]);

        DB::table('user')
            ->insert([
                'username' => $request->id_guru,
                'password' => bcrypt($request->password),
                'foto' => '',
                'status' => 'Guru'
            ]);

        return back()->with('success', 'Berhasil menambah data guru!');
    }

    public function absenGuru()
    {
        return view('guru.absen.index', [
            'title' => 'Absen Guru',
            'navactive' => 'guru',
            'ai' => 1,
            'dataAbsenGuru' => DB::table('absen_guru')->join('guru', 'guru.id_guru', '=', 'absen_guru.id_guru')->get()
        ]);
    }

    public function updateAbsenGuru(Request $request)
    {
        DB::table('absen_guru')
            ->where('id_guru', $request->id_guru)
            ->update([
                'keterangan' => $request->keterangan
            ]);
        return back()->with('success', 'Berhasil update absen!');
    }

    public function deleteGuru(Request $request)
    {
        DB::table('guru')
            ->where('id_guru', $request->id_guru)
            ->delete();
        DB::table('user')
            ->where('username', $request->id_guru)
            ->delete();
        return back()->with('success', 'Berhasil delete guru');
    }

    public function index()
    {
        return view('guru.data.index', [
            'title' => 'Data Guru',
            'navactive' => 'guru',
            'ai' => 1,
            'dataGuru' => DB::table('guru')->join('user', 'user.username', '=', 'guru.id_guru')->get()
        ]);
    }

    public function mengajar()
    {
        $dataMengajar = DB::table('guru')
                            ->select(
                                'guru.id_guru', 'guru.nama_guru',
                                DB::raw('COUNT(jadwal.id_jadwal) as jumlah_jam'), 
                                DB::raw('SUM(jurnal.lama) as tertunaikan'), 
                                DB::raw('SUM(jurnal.transport) as transport')
                            )
                            ->join('jadwal', 'jadwal.guru_id', '=', 'guru.id_guru')
                            ->join('jurnal', 'jurnal.jadwal_id', '=', 'jadwal.id_jadwal')
                            ->groupBy('jadwal.guru_id')
                            ->get();
    }
}
