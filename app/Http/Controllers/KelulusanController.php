<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KelulusanController extends Controller
{
    public function index()
    {
        return view('kelulusan.index', [
            
        ]);
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
            return back()->with('gagal', 'ID anda telah diban');
        }
    }
}
