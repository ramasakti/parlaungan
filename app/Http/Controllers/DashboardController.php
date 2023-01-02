<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
    public function jamSekarang()
    {
        $jamMasuk = DB::table('hari')
                        ->where('nama_hari', Carbon::now()->isoFormat('dddd'))
                        ->get();
        return $jamMasuk;
    }

    public function diagramAbsen()
    {
        $hadir = DB::table('absen')
                    ->where('waktu_absen', '<', $this->jamSekarang()[0]->masuk)
                    ->get();
        $terlambat = DB::table('absen')
                        ->where('waktu_absen', '>', $this->jamSekarang()[0]->masuk)
                        ->get();
        $izin = DB::table('absen')
                    ->where('keterangan', 'I')
                    ->get();
        $sakit = DB::table('absen')
                    ->where('keterangan', 'S')
                    ->get();
        $alfa = DB::table('absen')
                    ->where('waktu_absen', NULL)
                    ->orWhere('keterangan', 'A')
                    ->get();
        return [count($hadir), count($terlambat), count($izin), count($sakit), count($alfa)-(count($sakit)+count($izin))];
    }

    public function batasBawah()
    {
        $range = date('Y-m-d', strtotime('-7 day', strtotime(date('Y-m-d'))));
        return $range;
    }

    public function dataTerlambat()
    {
        $dataTerlambat = DB::table('rekap_siswa')
                            ->select('tanggal', DB::raw("COUNT(tanggal) as terlambat"))
                            ->where('tanggal', '>=', $this->batasBawah())
                            ->where('tanggal', '<=', date('Y-m-d'))
                            ->where('keterangan', 'T')
                            ->groupBy('tanggal')
                            ->get()->toArray();
        return $dataTerlambat;
    }

    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'navactive' => 'dashboard',
            'dataSiswa' => count(DB::table('siswa')->get()),
            'dataGuru' => count(DB::table('guru')->get()),
            'dataKelas' => count(DB::table('kelas')->get()),
            'detailUser' => $this->userCard(),
            'dataQR' => QrCode::size(200)->generate(session('username')),
            'dataAbsen' => $this->diagramAbsen(),
            'rangeTanggal' => $this->batasBawah(),
            'dataTerlambat' => $this->dataTerlambat(),
        ]);
    }

    public function userCard()
    {
        switch (session('status')) {
            case 'Siswa':
                $detailUser = DB::table('siswa')
                                ->where('id_siswa', session('username'))
                                ->get();
                return $detailUser;
                break;
            case 'Walmur':
                $detailUser = DB::table('walmur')
                                ->where('id_walmur', session('username'))
                                ->get();
                return $detailUser;
                break;
            default:
                $detailUser = DB::table('guru')
                                ->where('id_guru', session('username'))
                                ->get();
                return $detailUser;
                break;
        }
    }
}
