<?php

namespace App\Http\Controllers;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
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
            'allPembayaran' => DB::table('pembayaran')->where('nama_pembayaran', '!=', 'Tunggakan')->get(),
            'detailPembayaran' => $this->detailPembayaran(),
            'tunggakanPembayaran' => $this->tunggakanPembayaran(),
            'allTransaksi' => $this->allTransaksi(),
            'detailTransaksi' => $this->detailTransaksi(),
            'dataSiswa' => $dataSiswa[0],
            'listSiswa' => DB::table('siswa')->get()
        ]);
    }

    public function editTransaksi(Request $request, $kwitansi)
    {
        return view('siswa.keuangan.transaksi.edit-transaksi', [
            'title' => 'Edit Transaksi',
            'navactive' => 'siswa',
            'data' => DB::table('transaksi')->join('pembayaran', 'pembayaran.id_pembayaran', '=', 'transaksi.pembayaran_id')->where('kwitansi', $kwitansi)->get()
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
        $siswa = DB::table('siswa')->where('id_siswa', request('siswa_id'))->first();
        if (!$siswa) {
            return [];
        }
        $kelas = '%' .$siswa->kelas_id. '%';
        $detilPembayaran = DB::table('pembayaran')
                                ->where('kelas', 'like', $kelas)
                                ->get();
        return $detilPembayaran;
    }

    public function tunggakanPembayaran()
    {
        if (!request('siswa_id')) {
            return [];
        }
        $siswa = DB::table('siswa')->where('id_siswa', request('siswa_id'))->first();
        if (!$siswa) {
            return [];
        }

        $tunggakanPembayaran = DB::table('tunggakan')->where('siswa_id', request('siswa_id'))->first();

        return $tunggakanPembayaran;
    }

    public function updateTransaksi(Request $request)
    {
        $jenisPem = count($request->id_pembayaran);
        for ($i=0; $i < $jenisPem; $i++) {
            $pembayaran_terbayar = DB::table('transaksi')
                                    ->select(
                                        DB::raw('SUM(terbayar) as pembayaran_terbayar')
                                    )
                                    ->where('kwitansi', '!=', $request->kwitansi)
                                    ->where('siswa_id', $request->id_siswa)
                                    ->where('pembayaran_id', $request->id_pembayaran[$i])
                                    ->groupBy('pembayaran_id')
                                    ->first();

            if ($request->terbayar[$i] === null) {
                return back()->with('fail', 'Wajib mengisi nominal yang dibayarkan');
            }

            $nominal = preg_replace('/[^0-9]/', '', $request->nominal[$i]);
            $terbayar = preg_replace('/[^0-9]/', '', $request->terbayar[$i]);
            $pembayaran_terbayar = preg_replace('/[^0-9]/', '', $pembayaran_terbayar->pembayaran_terbayar ?? 0);
            $selisih = $nominal - $pembayaran_terbayar - $terbayar;

            if ($selisih < 0 || $terbayar > $nominal) {
                return back()->with('fail', 'Jumlah pembayaran melebihi jumlah kekurangan pembayaran');
            }
        }

        for ($i=0; $i < count($request->id_transaksi); $i++) {
            DB::table('transaksi')
                ->where('id_transaksi', $request->id_transaksi[$i])
                ->update([
                    'waktu_transaksi' => date('Y-m-d H:i:s'),
                    'terbayar' => preg_replace('/[^0-9]/', '', $request->terbayar[$i])
                ]);
        }

        return redirect('/siswa/keuangan?siswa_id='.$request->id_siswa)->with('success', 'Berhasil update transaksi!');
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
        if (!$request->pembayaran) {
            return back()->with('fail', 'Gagal Checkout! Tidak ada pembayaran yang terdeteksi');
        }
        return view('siswa.keuangan.transaksi.checkout', [
            'title' => 'Siswa',
            'navactive' => 'siswa',
            'id_siswa' => $request->id_siswa,
            'tunggakanPembayaran' => $this->tunggakanPembayaran(),
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

            if ($request->terbayar[$i] === null) {
                return redirect('/siswa/keuangan?siswa_id='.$request->id_siswa)->with('fail', 'Wajib mengisi nominal yang dibayarkan');
            }

            $nominal = preg_replace('/[^0-9]/', '', $request->nominal[$i]);
            $terbayar = preg_replace('/[^0-9]/', '', $request->terbayar[$i]);
            $pembayaran_terbayar = preg_replace('/[^0-9]/', '', $pembayaran_terbayar->pembayaran_terbayar ?? 0);
            $selisih = $nominal - $pembayaran_terbayar - $terbayar;

            if ($selisih < 0 || $terbayar > $nominal) {
                return redirect('/siswa/keuangan?siswa_id='.$request->id_siswa)->with('fail', 'Jumlah pembayaran melebihi jumlah kekurangan pembayaran');
            }
        }
        for ($i=0; $i < $jenisPem; $i++) {
            DB::table('transaksi')
                ->insert([
                    'kwitansi' => $kwitansi,
                    'waktu_transaksi' => date('Y-m-d H:i:s'),
                    'siswa_id' => $request->id_siswa,
                    'pembayaran_id' => $request->id_pembayaran[$i],
                    'terbayar' => preg_replace('/[^0-9]/', '', $request->terbayar[$i])
                ]);
        }

        return redirect('/siswa/keuangan?siswa_id='.$request->id_siswa)->with('success', 'Berhasil melakukan transaksi!');
    }

    public function print(Request $request)
    {
        //Setup Printer
        $connector = new WindowsPrintConnector("pos-58"); // Ganti "printer_name" dengan nama printer Anda
        $printer = new Printer($connector);
        $maxTextLength = 13;

        //Data
        $data = DB::table('transaksi')
                    ->select(
                        '*',
                        DB::raw('SUM(terbayar) as total_transaksi')
                    )
                    ->where('transaksi.kwitansi', $request->id)
                    ->join('siswa', 'siswa.id_siswa', '=', 'transaksi.siswa_id')
                    ->orderBy('transaksi.waktu_transaksi', 'desc')
                    ->groupBy('transaksi.kwitansi')
                    ->first();
        $trx = DB::table('transaksi')->select('pembayaran_id', 'terbayar')->where('kwitansi', $data->kwitansi)->get()->toArray();
        $newArr = array_map(function($item) {
            return $item->pembayaran_id;
        }, $trx);

        $newArr = array_values($newArr);
        $pmbyrn = DB::table('pembayaran')->whereIn('id_pembayaran', $newArr)->get();

        //Mencetak
        try {
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Kwitansi Pembayaran\n");
            $img = EscposImage::load(public_path('/lmbg.png'));
            $printer->bitImage($img);
            $printer->text("Jl. Berbek I No. 2 - 4 Sidoarjo\n");
            $printer->text("================================\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text(str_pad($request->id, $maxTextLength, " ", STR_PAD_RIGHT) . "\n");
            $printer->text(str_pad($data->nama_siswa, $maxTextLength, " ", STR_PAD_RIGHT) . "\n");
            $printer->text(str_pad($data->waktu_transaksi, $maxTextLength, " ", STR_PAD_RIGHT) . "\n");
            $printer->text(str_pad('Vinna Alviyatin, S.Sos', $maxTextLength, " ", STR_PAD_RIGHT) . "\n");
            $printer->text("================================\n");
            for ($i=0; $i < count($pmbyrn); $i++) { 
                $printer->text($pmbyrn[$i]->nama_pembayaran);
                $printer->text("\n");
                $printer->text("Nominal : Rp. " . number_format(intval($pmbyrn[$i]->nominal),0,'','.'));
                $printer->text("\n");
                $printer->text("Dibayar : Rp. " . number_format($trx[$i]->terbayar,0,'','.'));
                $printer->text("\n");
                $printer->text("\n");
            }
            $printer->text("Total : ");
            $total = array_reduce($trx, function($acc, $item) {
                return $acc + $item->terbayar;
            }, 0);
            $printer->text("Rp. ".number_format($total,0,'','.'));
            $printer->text("\n================================\n");
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->qrCode('https://smaispa.sch.id/transaksi/kwitansi?id='.$request->id, Printer::QR_ECLEVEL_L, 6);
            $printer->text("\nScan untuk melihat kwitansi digital");
            $printer->cut();
            $printer->close();

            return back()->with('success', 'Berhasil mencetak!');
        }catch (Exception $e){
            return "Cetak gagal: " . $e->getMessage();
        }
    }

    public function tunggakan(Request $request)
    {
        $siswa = DB::table('siswa', request('siswa_id'))->first();
        $kelas = '%' .$siswa->kelas_id. '%';
        $tunggakan = DB::table('transaksi')
                        ->join('pembayaran', 'pembayaran.kelas', 'like', '')
                        ->where('transaksi.siswa_id', request('siswa_id'))
                        ->get();

        return view('siswa.keuangan.pembayaran.tunggakan', [
            'title' => 'Tunggakan',
            'dataTunggakan' => $tunggakan
        ]);
    }
}
