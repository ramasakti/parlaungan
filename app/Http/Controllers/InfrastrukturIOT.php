<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InfrastrukturIOT extends Controller
{
    public function restapi()
    {
        $data = DB::table('infrastruktur')->where('id_infrastruktur', request('id'))->get();
        return response()->json([
            'id_infrastruktur' => $data[0]->id_infrastruktur,
            'nama_infrastruktur' => $data[0]->nama_infrastruktur,
            'status' => $data[0]->status
        ]);
    }

    public function daftar()
    {
        DB::table('infrastruktur')
            ->insert([
                'tanggal' => date('Y-m-d'),
                'confirmed' => 0,
            ]);
        
        return DB::table('infrastruktur')->orderBy('id_infrastruktur', 'desc')->limit(1)->get()[0]->id_infrastruktur;
    }

    public function antrean($nomor)
    {
        $nomorAntrean = DB::table('infrastruktur')->where('id_infrastruktur', $nomor)->get();
        return view('antrean.index', [
            'nomorAntrean' => $nomorAntrean
        ]);
    }

}
