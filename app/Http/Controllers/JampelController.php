<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JampelController extends Controller
{
    public function storeJampel(Request $request)
    {
        $result = DB::table('jam_pelajaran')
                    ->where(function($query) use ($request) {
                        $query->whereBetween('mulai', [$request->mulai, $request->selesai])
                            ->orWhereBetween('selesai', [$request->mulai, $request->selesai]);
                    })
                    ->where('hari', $request->hari)
                    ->get();

        if (count($result) < 1) {
            DB::table('jam_pelajaran')
                ->insert([
                    'hari' => $request->hari,
                    'keterangan' => $request->keterangan,
                    'mulai' => $request->mulai,
                    'selesai' => $request->selesai . ':59',
                ]);
            return back()->with('success', 'Berhasil menambahkan data!');
        }

        return back()->with('gagal', 'Gagal menambahkan data! Jam berbentrokan');
    }
    
    public function updateJampel(Request $request)
    {
        $result = DB::table('jam_pelajaran')
                    ->where(function($query) use ($request) {
                        $query->whereBetween('mulai', [$request->mulai, $request->selesai])
                            ->orWhereBetween('selesai', [$request->mulai, $request->selesai]);
                    })
                    ->where('hari', $request->hari)
                    ->get();

        $hari = DB::table('jam_pelajaran')->where('id_jampel', $request->id_jampel)->first();

        if (count($result) < 1) {
            DB::table('jam_pelajaran')
                ->where('id_jampel', $request->id_jampel)
                ->update([
                    'hari' => $request->hari,
                    'keterangan' => $request->keterangan,
                    'mulai' => $request->mulai,
                    'selesai' => $request->selesai,
                ]);
            return back()->with('success', 'Berhasil update data!');
        }else{
            if ($hari->hari === $request->hari) {
                DB::table('jam_pelajaran')
                    ->where('id_jampel', $request->id_jampel)
                    ->update([
                        'hari' => $request->hari,
                        'keterangan' => $request->keterangan,
                        'mulai' => $request->mulai,
                        'selesai' => $request->selesai,
                    ]);
                return back()->with('success', 'Berhasil update data!');
            }
            return back()->with('gagal', 'Gagal! Jam berbentrokan!');
        }
        return back()->with('gagal', 'Gagal! Jam berbentrokan!');
    }

    public function destroyJampel(Request $request)
    {
        DB::table('jam_pelajaran')
            ->where('id_jampel', $request->id_jampel)
            ->delete();

        return back()->with('success', 'Berhasil delete data!');
    }
}
