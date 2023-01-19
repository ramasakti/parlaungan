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
        return response()->json($data);
    }
}
