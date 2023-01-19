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
}
