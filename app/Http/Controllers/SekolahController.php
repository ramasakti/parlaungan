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
        return back();
    }

    public function storeLibur(Request $request)
    {
        DB::table('libur')
            ->insert([
                'keterangan' => $request->keterangan,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
            ]);
        return back();
    }

    public function updateLibur(Request $request)
    {
        DB::table('libur')
            ->where('id_libur', $request->id_libur)
            ->update([
                'keterangan' => $request->keterangan,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
            ]);
        return back();
    }

    public function destroyLibur(Request $request)
    {
        DB::table('libur')
            ->where('id_libur', $request->id_libur)
            ->delete();
        return back();
    }
}
