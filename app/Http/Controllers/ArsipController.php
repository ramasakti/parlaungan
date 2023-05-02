<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        //Upload File Baru
        $ext = $request->file('surat')->getClientOriginalExtension();
        $filename = $request->perihal . '_' . date('YmdHis') . '.' . $ext;
        $request->file('surat')->storeAs('/arsip', $filename);

        DB::table('arsip_surat')
            ->insert([
                'tanggal' => $request->tanggal,
                'jenis' => $request->jenis,
                'nomor' => $request->nomor,
                'perihal' => $request->perihal,
                'url' => $filename
            ]);

        return back()->with('add-arsip', 'Berhasil menambahkan arsip!');
    }

    public function update(Request $request)
    {
        $detailArsip = DB::table('arsip_surat')->where('id_arsip', $request->id_arsip)->first();

        if ($request->file('surat')) {
            //Hapus File Lama
            Storage::delete('arsip/' . $detailArsip->url);
    
            //Upload File Baru
            $ext = $request->file('surat')->getClientOriginalExtension();
            $filename = $request->perihal . '_' . date('YmdHis') . '.' . $ext;
            $request->file('surat')->storeAs('/arsip', $filename);
            
            DB::table('arsip_surat')
                ->where('id_arsip', $request->id_arsip)
                ->update([
                    'tanggal' => $request->tanggal,
                    'nomor' => $request->nomor,
                    'perihal' => $request->perihal,
                    'url' => $filename
                ]);
        }else{
            DB::table('arsip_surat')
                ->where('id_arsip', $request->id_arsip)
                ->update([
                    'tanggal' => $request->tanggal,
                    'nomor' => $request->nomor,
                    'perihal' => $request->perihal,
                ]);
        }

        return back()->with('update-arsip', 'Berhasil mengedit arsip!');
    }

    public function delete(Request $request)
    {
        $detailArsip = DB::table('arsip_surat')->where('id_arsip', $request->id_arsip)->first();

        //Hapus File Lama
        Storage::delete('arsip/' . $detailArsip->url);

        DB::table('arsip_surat')
            ->where('id_arsip', $request->id_arsip)
            ->delete();

        return back()->with('delete-arsip', 'Berhasil menghapus arsip!');
    }
}
