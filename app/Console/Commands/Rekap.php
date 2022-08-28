<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Rekap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekap:exec';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Cek Pengondisian Hari Libur/Minggu
        $cekHari = Hari::all()->where('nama_hari', Carbon::now()->isoFormat('dddd'));
        $cekLibur = Libur::all()
                        ->where('mulai', '<=', date('Y-m-d'))
                        ->where('sampai', '>=', date('Y-m-d'));

        if (count($cekHari) > 0){
            if (count($cekLibur) == 0){
                //Update ke alfa jika belum diset status hadirnya
                DB::table('absen')
                    ->where('waktu_absen', '=', NULL)
                    ->where('keterangan', '=', '')
                    ->update([
                        'keterangan' => 'A'
                    ]);

                //Ambil data keterangan absen siswa untuk direkap
                $dataRekap = DB::table('absen')
                    ->select('kode_siswa','rekap', 'keterangan')
                    ->where('keterangan', '!=', '')
                    ->get();

                //Ambil data jadwal yang notset untuk direkap ketidakhadirannya
                $dataJadwal = DB::table('jadwal')
                    ->select('id', 'mulai', 'sampai')
                    ->where('hari', Carbon::now()->isoFormat('dddd'))
                    ->get();

                foreach ($dataRekap as $updateRekap){
                    DB::table('absen')
                        ->where('kode_siswa', $updateRekap->kode_siswa)
                        ->update([
                            'rekap' => $updateRekap->rekap ."". $updateRekap->keterangan
                        ]);
                }        
            }else{
                //Jika libur masukkan data jadwal di hari tsb ke jurnal
                foreach ($dataJadwal as $insertJadwal){
                    DB::table('jurnal')
                        ->insert([
                            'tanggal' => date('Y-m-d'),
                            'jadwal_id' => $insertJadwal->id,
                            'masuk' => $insertJadwal->mulai,
                            'lama' => (strtotime($insertJadwal->sampai)-strtotime($insertJadwal->mulai))/40/60,
                            'transport' => 0,
                            'materi' => "Libur"
                        ]);
                } 
            }
        }
    }
}
