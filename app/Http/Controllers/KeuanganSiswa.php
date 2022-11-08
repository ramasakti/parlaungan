<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KeuanganSiswa extends Controller
{
    public function index()
    {
        return view('siswa.keuangan.index', [
            'title' => 'Keuangan Siswa',
            'navactive' => 'siswa',
            'ai' => 1,
            'dataKelas' => DB::table('kelas')->get(),
            'allPembayaran' => DB::table('pembayaran')->get(),
            'detailPembayaran' => $this->detailPembayaran(),
            'allTransaksi' => $this->allTransaksi(),
            'detailTransaksi' => $this->detailTransaksi()
        ]);
    }

    public function addPembayaran(Request $request)
    {
        $kelas = implode('#', $request->kelas);
        DB::table('pembayaran')
            ->insert([
                'nama_pembayaran' => $request->nama_pembayaran,
                'nominal' => $request->nominal,
                'kelas' => '#' .$kelas
            ]);
        return back();
    }

    public function updatePembayaran(Request $request)
    {
        $kelas = implode('#', $request->kelas);
        DB::table('pembayaran')
            ->where('id_pembayaran', $request->id_pembayaran)
            ->update([
                'nama_pembayaran' => $request->nama_pembayaran,
                'nominal' => $request->nominal,
                'kelas' => '#' .$kelas
            ]);
        return back();
    }

    public function deletePembayaran(Request $request)
    {
        DB::table('pembayaran')
            ->where('id_pembayaran', $request->id_pembayaran)
            ->delete();
        return back();
    }

    public function detailPembayaran()
    {
        $siswa = DB::table('siswa')->where('id_siswa', request('siswa_id'))->get()[0]->kelas_id;
        $kelas = '%' .$siswa. '%';
        $detilPembayaran = DB::table('pembayaran')
                                ->where('pembayaran.kelas', 'like', $kelas)
                                ->get();
        return $detilPembayaran;
    }

    public function allTransaksi()
    {
        $transaksi = DB::table('transaksi')
                        ->join('siswa', 'siswa.id_siswa', '=', 'transaksi.siswa_id')
                        ->groupBy('transaksi.kwitansi')
                        ->get();
        return $transaksi;
    }

    public function detailTransaksi()
    {
        $detailTransaksi = DB::table('transaksi')
                        ->select(
                            '*',
                            DB::raw('SUM(terbayar) as total_transaksi')
                        )
                        ->where('transaksi.siswa_id', request('siswa_id'))
                        ->join('siswa', 'siswa.id_siswa', '=', 'transaksi.siswa_id')
                        ->groupBy('transaksi.kwitansi')
                        ->get();
        return $detailTransaksi;
    }

    public function pembayaranTerbayar()
    {
        $terbayar = DB::table('transaksi')
                        ->select(
                            '*',
                            DB::raw('SUM(terbayar) as pembayaran_terbayar')
                        )
                        ->where('siswa_id', request('siswa_id'))
                        ->where('pembayaran_id', $this->detailPembayaran())
                        ->groupBy('pembayaran_id')
                        ->get();
        return $terbayar;
    }

    public function numberFormat($angka)
    {
        return number_format($angka,0,'','.');
    }
}
