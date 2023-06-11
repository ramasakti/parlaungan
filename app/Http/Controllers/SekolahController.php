<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SekolahController extends Controller
{
    public function dataHari()
    {
        $dataHari = DB::table('hari')
                        ->join('guru', 'guru.id_guru', '=', 'hari.piket')
                        ->get();
        return $dataHari;
    }

    public function index()
    {
        return view('sekolah.index', [
            'title' => 'Sekolah',
            'navactive' => 'sekolah',
            'ai' => 1,
            'dataHari' => $this->dataHari(),
            'dataGuru' => DB::table('guru')->get(),
            'dataLibur' => DB::table('libur')->get(),
            'dataJam' => DB::table('jam_pelajaran')->get()
        ]);
    }

    public function updateHari(Request $request)
    {
        DB::table('hari')
            ->where('id_hari', $request->id_hari)
            ->update([
                'masuk' => $request->masuk,
                'jampel' => $request->jampel,
                'piket' => $request->piket,
            ]);
        return back()->with('update-hari', 'Berhasil mengubah detail hari');;
    }

    public function storeLibur(Request $request)
    {
        if ($request->mulai > $request->sampai) {
            return back()->with('gagal', 'Gagal menambahkan / mengubah hari libur');
        }
        DB::table('libur')
            ->insert([
                'keterangan' => $request->keterangan,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
            ]);
        return back()->with('add-libur', 'Berhasil menambahkan hari libur');
    }

    public function updateLibur(Request $request)
    {
        if ($request->mulai > $request->sampai) {
            return back()->with('gagal', 'Gagal menambahkan / mengubah hari libur');
        }
        DB::table('libur')
            ->where('id_libur', $request->id_libur)
            ->update([
                'keterangan' => $request->keterangan,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
            ]);
        return back()->with('update-libur', 'Berhasil mengubah detail hari libur');
    }

    public function destroyLibur(Request $request)
    {
        DB::table('libur')
            ->where('id_libur', $request->id_libur)
            ->delete();
        return back()->with('delete-libur','Berhasil menghapus hari libur');
    }
}
