<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ArsipController extends Controller
{
    public function index()
    {
        $lastData = DB::table('arsip_surat')
                        ->where('jenis', 'K')
                        ->orderBy('id_arsip', 'desc')
                        ->limit(1)
                        ->get();
        if (count($lastData) < 1) {
            $regex = 0;
        }else{
            $regex = substr($lastData[0]->nomor, 4, 3);
        }
        return view('surat.index', [
            'ai' => 1,
            'title' => 'Arsip Surat',
            'navactive' => 'sekolah',
            'dataKeluar' => DB::table('arsip_surat')->where('jenis', 'K')->orderBy('id_arsip', 'desc')->get(),
            'dataMasuk' => DB::table('arsip_surat')->where('jenis', 'M')->orderBy('id_arsip', 'desc')->get(),
            'lastData' => $regex
        ]);
    }

    public function store(Request $request)
    {
        DB::table('arsip_surat')
            ->insert([
                'tanggal' => date('Y-m-d'),
                'jenis' => $request->jenis,
                'nomor' => $request->nomor,
                'perihal' => $request->perihal,
                'url' => $request->url
            ]);

        return back()->with('add-arsip', 'Berhasil menambahkan arsip!');
    }

    public function update(Request $request)
    {
        DB::table('arsip_surat')
            ->where('id_arsip', $request->id_arsip)
            ->update([
                'tanggal' => date('Y-m-d'),
                'nomor' => $request->nomor,
                'nama' => $request->nama,
                'penerbit' => $request->penerbit,
                'url' => $request->url
            ]);

        return back()->with('update-arsip', 'Berhasil mengedit arsip!');
    }

    public function delete(Request $request)
    {
        DB::table('arsip_surat')
            ->where('id_arsip', $request->id_arsip)
            ->delete();

        return back()->with('delete-arsip', 'Berhasil menghapus arsip!');
    }
}
