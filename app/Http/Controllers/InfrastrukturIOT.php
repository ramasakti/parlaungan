<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InfrastrukturIOT extends Controller
{
    public function restapi()
    {
        return response()->json(
            DB::table('infrastruktur')->get()
        );
    }
}
