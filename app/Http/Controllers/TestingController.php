<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Http;

class TestingController extends Controller
{
    public function index(Request $request)
    {
        $absen = DB::table('absen')
                    ->select('id_siswa', 'keterangan')
                    ->where('keterangan', '!=', '')
                    ->get();
        foreach ($absen as $siswa) {
            $data =  '#'. $siswa->id_siswa .':'. $siswa->keterangan;
            DB::table('rekap_siswa')
                ->upsert([
                    [
                        'tanggal' => date('Y-m-d'),
                        'rekapitulasi' => $data,
                    ]
                ],
                ['tanggal', 'rekapitulasi']
                );
            
        }
    }

    public function getApi(Request $request)
    {
        return view('tesapi', [
            'data' => $api
        ]);
    }

    public function csv()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->get('https://127.0.0.1:8000/template/jadwal.csv');
        $content = (string) $res->getBody();
        return view('csv', [
            'title' => 'CSV',
            'navactive' => 'csv',
            'ai' => 1,
            'dataJadwal' => $content
        ]);
    }
}
