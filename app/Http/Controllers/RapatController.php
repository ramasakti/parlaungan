<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RapatController extends Controller
{
    public function index()
    {
        return view('rapat.index', [
            'title' => 'Absen Rapat',
            'navactive' => 'rapat',
            'ai' => 1,
            'dataRapat' => DB::table('rapat')->get()
        ]);
    }

    public function store(Request $request)
    {
        if ($request->mulai > $request->sampai) {
            return back()->with('failed', 'Format waktu rapat salah!');
        }

        DB::table('rapat')
            ->insert([
                'judul' => $request->judul,
                'slug' => $request->slug,
                'tanggal' => $request->tanggal,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
                'penyelenggara' => $request->penyelenggara,
                'peserta' => '',
            ]);
        return back()->with('success', 'Berhasil menambahkan jadwal rapat!');
    }

    public function detail(Request $request, $slug)
    {
        $dataRapat = DB::table('rapat')->where('slug', $slug)->get();
        $exploder = explode('#', $dataRapat[0]->peserta);   
        $arrayKosong = [''];
        $arrayUser = array_diff(array_unique($exploder), $arrayKosong);
        $dataUser = DB::table('user')->whereIn('username', $arrayUser)->get();
        if ($dataUser[0]->status === 'Siswa') {
            $pesertaRapat = DB::table('siswa')->where('');
        }
        return view('rapat.detail-rapat', [
            'title' => 'Sistem Absen Rapat',
            'ai' => 1,
            'dataRapat' => ''
        ]);
    }

    public function engine(Request $request, $slug)
    {
        $dataRapat = DB::table('rapat')
                        ->select(DB::raw("CONCAT(peserta, '#', '$request->userabsen') as peserta"))
                        ->get();
        DB::table('rapat')
            ->where('slug', $slug)
            ->update([
                'peserta' => $dataRapat[0]->peserta
            ]);
        return back();
    }

    public function delete(Request $request)
    {
        DB::table('rapat')
            ->where('id_rapat', $request->id_rapat)
            ->delete();
        return back()->with('deleted', 'Berhasil delete data');
    }
}
