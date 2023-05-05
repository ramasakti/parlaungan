<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KelulusanImport;
use App\Models\Kelulusan;
use DB;

class KelulusanController extends Controller
{
    public function index()
    {
        return view('siswa.kelulusan.index', [
            
        ]);
    }

    public function dataKelulusan()
    {
        return DB::table('kelulusan')->join('siswa', 'siswa.id_siswa', '=', 'kelulusan.siswa_id')->get();
    }

    public function engine(Request $request)
    {
        $data = DB::table('kelulusan')
                    ->where('nisn', $request->nisn)
                    ->where('lulus', TRUE)
                    ->join('siswa', 'siswa.id_siswa', '=', 'kelulusan.siswa_id')
                    ->first();
        if ($data) {
            return back()->with('lulus', $data->nama_siswa);
        }else{
            $x = DB::table('kelulusan')
                    ->whereNotIn('nisn', $request->nisn)
                    ->first();
            if (!$x) {
                return back()->with('wrong', 'NISN tidak terdaftar!');
            }
            return back()->with('gagal', 'Tidak Lulus');
        }
    }

    public function import(Request $request)
    {
        Excel::import(new KelulusanImport, request()->file('kelulusan')); //'file' diisi dengan name uploader
        return back()->with('imported', 'Berhasil import data kelulusan!');
    }

    public function update(Request $request)
    {
        DB::table('kelulusan')
            ->where('nisn', $request->nisn)
            ->update([
                'lulus' => $request->lulus[0]
            ]);
        return back()->with('success', 'Berhasil update kelulusan!');
    }
}
