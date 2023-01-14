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
        $kategori = implode('#', $request->kategori);
        DB::table('rapat')
            ->insert([
                'judul' => $request->judul,
                'slug' => $request->slug,
                'tanggal' => $request->tanggal,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
                'penyelenggara' => $request->penyelenggara,
                'kategori_peserta' => '#' .$kategori,
                'peserta' => '',
            ]);
        return back()->with('success', 'Berhasil menambahkan jadwal rapat!');
    }

    public function userRapat(Request $request, $slug)
    {
        $dataRapat = DB::table('rapat')->where('slug', $slug)->get();
        $pesertaRapat = explode('#', $dataRapat[0]->peserta);
        $userRapat = DB::table('user')->whereIn('username', $pesertaRapat)->get();

    }

    public function detail(Request $request, $slug)
    {
        $dataRapat = DB::table('rapat')->where('slug', $slug)->get();
        return view('rapat.detail-rapat', [
            'title' => 'Sistem Absen Rapat',
            'ai' => 1,
            'dataRapat' => $dataRapat,
            'dataPeserta' => $dataUser
        ]);
    }

    public function engine(Request $request, $slug)
    {
        $rapat = DB::table('rapat')->where('slug', $slug)->get();
        $userabsen = DB::table('user')
                        ->where('username', $request->userabsen)
                        ->get();
        $kategoriPeserta = explode('#', $rapat[0]->kategori_peserta);
        array_push($kategoriPeserta, 'Admin');
        if (count($userabsen) < 1) {
            return back()->with('fail', 'ID anda tidak terdaftar!');
        }
        if (!array_search($userabsen[0]->status, $kategoriPeserta)) {
            return back()->with('nonpeserta', 'Anda bukan kategori peserta rapat!');
        }
        if (array_search($request->userabsen, explode('#', $rapat[0]->peserta))) {
            return back()->with('bePresent', 'Anda sudah absen pada rapat ini!');
        }
        DB::table('rapat')
            ->where('slug', $slug)
            ->update([
                'peserta' => '#'.$request->userabsen
            ]);
        return back()->with('success', 'Berhasil absen!');
    }

    public function delete(Request $request)
    {
        DB::table('rapat')
            ->where('id_rapat', $request->id_rapat)
            ->delete();
        return back()->with('deleted', 'Berhasil delete data');
    }

    public function update(Request $request)
    {
        DB::table('rapat')
            ->where('slug', $request->slug)
            ->update([
                'judul' => $request->judul,
                'slug' => $request->slug,
                'tanggal' => $request->tanggal,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
                'penyelenggara' => $request->penyelenggara,
                'kategori_peserta' => '#' .$kategori,
            ]);
    }
}
