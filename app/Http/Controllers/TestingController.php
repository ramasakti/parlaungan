<?php

namespace App\Http\Controllers;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;

class TestingController extends Controller
{
    public function index(Request $request)
    {
        $connector = new WindowsPrintConnector("pos-58"); // Ganti "printer_name" dengan nama printer Anda
        $printer = new Printer($connector);

        try {
            $printer->text("Contoh teks yang akan dicetak\n");
            $printer->text("Baris berikutnya\n");
            $printer->cut();
            $printer->close();

            return "Cetak berhasil";
        } catch (Exception $e) {
            return "Cetak gagal: " . $e->getMessage();
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
