<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class TestingController extends Controller
{
    public function jamSekarang()
    {
        $jamMasuk = DB::table('hari')
                        ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                        ->get();
        return $jamMasuk;
    }

    public function index()
    {
        $jamPelajaran = $this->jamSekarang()[0]->jampel;
        dd(intval(substr($jamPelajaran, 3, 2)));
    }
}
