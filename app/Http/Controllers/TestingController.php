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
        $api = DB::table('siswa')->get();
        return response()->json($api);
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
