<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KeuanganSiswa extends Controller
{
    public function index(Request $request)
    {
        $dataSiswa = DB::table('siswa')->where('id_siswa', request('siswa_id'))->get();
        if (count($dataSiswa) < 1) {
            $dataSiswa = array(
                (object) array('nama_siswa' => 'undefined')
            );
        }
        return view('siswa.keuangan.index', [
            'title' => 'Keuangan Siswa',
            'navactive' => 'siswa',
            'ai' => 1,
            'dataKelas' => DB::table('kelas')->get(),
            'allPembayaran' => DB::table('pembayaran')->get(),
            'detailPembayaran' => $this->detailPembayaran(),
            'allTransaksi' => $this->allTransaksi(),
            'detailTransaksi' => $this->detailTransaksi(),
            'dataSiswa' => $dataSiswa[0]
        ]);
    }

    public function kwitansi(Request $request)
    {
        $detailTransaksi = DB::table('transaksi')
                        ->select(
                            '*',
                            DB::raw('SUM(terbayar) as total_transaksi')
                        )
                        ->where('transaksi.kwitansi', request('id'))
                        ->join('siswa', 'siswa.id_siswa', '=', 'transaksi.siswa_id')
                        ->orderBy('transaksi.waktu_transaksi', 'desc')
                        ->groupBy('transaksi.kwitansi')
                        ->get();
        return view('siswa.keuangan.transaksi.kwitansi', [
            'data' => $detailTransaksi,
        ]);
    }

    public function addPembayaran(Request $request)
    {
        if ($request->kelas == null) {
            return back()->with('fail', 'Gagal menambah pembayaran! Wajib menentukan kelas pembayaran');
        }
        $kelas = implode('#', $request->kelas);
        DB::table('pembayaran')
            ->insert([
                'nama_pembayaran' => $request->nama_pembayaran,
                'nominal' => preg_replace('/[^0-9]/', '', $request->nominal),
                'kelas' => '#' .$kelas
            ]);
        return back()->with('success', 'Berhasil menambahkan pembayaran baru!');
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
        if (!request('siswa_id')) {
            return [];
        }
        $siswa = DB::table('siswa')->where('id_siswa', request('siswa_id'))->get();
        if (count($siswa) < 1) {
            return [];
        }
        $kelas = '%' .$siswa[0]->kelas_id. '%';
        $detilPembayaran = DB::table('pembayaran')
                                ->where('pembayaran.kelas', 'like', $kelas)
                                ->get();
        return $detilPembayaran;
    }

    public function allTransaksi()
    {
        $transaksi = DB::table('transaksi')
                        ->select(
                            '*',
                            DB::raw('SUM(terbayar) as terbayar')
                        )
                        ->whereBetween('transaksi.waktu_transaksi', [request('tanggal') . ' 00:00:00', request('tanggal') . ' 23:59:59'])
                        ->join('siswa', 'siswa.id_siswa', '=', 'transaksi.siswa_id')
                        ->orderBy('transaksi.waktu_transaksi', 'desc')
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
                        ->orderBy('transaksi.waktu_transaksi', 'desc')
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
                        ->where('pembayaran_id', $this->detailPembayaran()->id_pembayaran)
                        ->groupBy('pembayaran_id')
                        ->get();
        return $terbayar;
    }

    public function engineTransaction(Request $request)
    {
        return view('siswa.keuangan.transaksi.checkout', [
            'title' => 'Siswa',
            'navactive' => 'siswa',
            'id_siswa' => $request->id_siswa,
            'detailPembayaran' => DB::table('pembayaran')->whereIn('id_pembayaran', $request->pembayaran)->get()
        ]);
    }

    public function payment(Request $request)
    {
        $kwitansi = 'K' . date('Ymdhis');
        $jenisPem = count($request->id_pembayaran);

        for ($i=0; $i < $jenisPem; $i++) {
            $pembayaran_terbayar = DB::table('transaksi')
                                    ->select(
                                        DB::raw('SUM(terbayar) as pembayaran_terbayar')
                                    )
                                    ->where('siswa_id', $request->id_siswa)
                                    ->where('pembayaran_id', $request->id_pembayaran[$i])
                                    ->groupBy('pembayaran_id')
                                    ->first();

            $nominal = preg_replace('/[^0-9]/', '', $request->nominal[$i]);
            $terbayar = preg_replace('/[^0-9]/', '', $request->terbayar[$i]);
            $pembayaran_terbayar = preg_replace('/[^0-9]/', '', $pembayaran_terbayar->pembayaran_terbayar ?? 0);
            $selisih = $nominal - $pembayaran_terbayar - $terbayar;

            if ($selisih < 0 || $terbayar > $nominal) {
                return redirect('/siswa/keuangan?siswa_id='.$request->id_siswa)->with('fail', 'Jumlah pembayaran melebihi jumlah kekurangan pembayaran');
            }

            DB::table('transaksi')
                ->insert([
                    'kwitansi' => $kwitansi,
                    'waktu_transaksi' => date('Y-m-d H:i:s'),
                    'siswa_id' => $request->id_siswa,
                    'pembayaran_id' => $request->id_pembayaran[$i],
                    'terbayar' => $terbayar
                ]);
        }

        return redirect('/siswa/keuangan?siswa_id='.$request->id_siswa)->with('success', 'Berhasil melakukan transaksi!');
    }

    public function numberFormat($angka)
    {
        return number_format($angka,0,'','.');
    }
}
