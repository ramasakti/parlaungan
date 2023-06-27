<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'ramasakti27',
            'password' => bcrypt('ramasakti27'),
            'foto' => '',
            'status' => 'Admin',
        ]);

        DB::table('user')->insert([
            'username' => 'adminabsen',
            'password' => bcrypt('parlaungan1980'),
            'foto' => '',
            'status' => 'Admin'
        ]);

        DB::table('user')->insert([
            'username' => 'alfansasmiko',
            'password' => bcrypt('alfansasmiko'),
            'foto' => '',
            'status' => 'Admin'
        ]);

        DB::table('guru')->insert([
            'id_guru' => 'alfansasmiko',
            'nama_guru' => 'Alfan Sasmiko, SH.I',
            'alamat' => 'Jl. Dukuh Pakis V / 35B',
            'telp' => '+62 812-3560-5030',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '1979-09-09'
        ]);
        
        DB::table('guru')->insert([
            'id_guru' => 'ramasakti27',
            'nama_guru' => 'Rama Sakti Hafidz FA',
            'alamat' => 'Kp. Baru Tb. Sumur Waru Sidoarjo',
            'telp' => '6285157177034',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2002-09-27'
        ]);

        DB::table('kelas')->insert([
            'tingkat' => 'XII',
            'jurusan' => 'MIA',
            'walas' => 'alfansasmiko'
        ]);

        DB::table('kelas')->insert([
            'tingkat' => 'XII',
            'jurusan' => 'IIS',
            'walas' => 'alfansasmiko'
        ]);

        DB::table('kelas')->insert([
            'tingkat' => 'XI',
            'jurusan' => 'SP 2021 1',
            'walas' => 'alfansasmiko'
        ]);

        DB::table('kelas')->insert([
            'tingkat' => 'XI',
            'jurusan' => 'SP 2021 2',
            'walas' => 'alfansasmiko'
        ]);
        DB::table('kelas')->insert([
            'tingkat' => 'X',
            'jurusan' => 'SP 2022 1',
            'walas' => 'alfansasmiko'
        ]);
        DB::table('kelas')->insert([
            'tingkat' => 'X',
            'jurusan' => 'SP 2022 2',
            'walas' => 'alfansasmiko'
        ]);
            
        DB::table('hari')->insert([
            'nama_hari' => 'Senin',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko',
            'status' => TRUE
        ]);
            
        DB::table('hari')->insert([
            'nama_hari' => 'Selasa',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko',
            'status' => TRUE
        ]);
            
        DB::table('hari')->insert([
            'nama_hari' => 'Rabu',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko',
            'status' => TRUE
        ]);
            
        DB::table('hari')->insert([
            'nama_hari' => 'Kamis',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko',
            'status' => TRUE
        ]);
            
        DB::table('hari')->insert([
            'nama_hari' => 'Jumat',
            'masuk' => '06:30:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko',
            'status' => TRUE
        ]);
            
        DB::table('hari')->insert([
            'nama_hari' => 'Sabtu',
            'masuk' => '06:30:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko',
            'status' => TRUE
        ]);
            
        DB::table('hari')->insert([
            'nama_hari' => 'Minggu',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko',
            'status' => FALSE
        ]);

        DB::table('nominal')->insert([
            'jenis' => 'Mengajar',
            'harga' => 33000
        ]);
        
        DB::table('nominal')->insert([
            'jenis' => 'Transport',
            'harga' => 5000
        ]);

        DB::table('transportasi')->insert([
            'transport' => 'Jalan Kaki',
        ]);

        DB::table('transportasi')->insert([
            'transport' => 'Sepeda',
        ]);

        DB::table('transportasi')->insert([
            'transport' => 'Sepeda Motor',
        ]);

        DB::table('transportasi')->insert([
            'transport' => 'Antar Jemput',
        ]);

        DB::table('transportasi')->insert([
            'transport' => 'Transportasi Umum (Ojek Online/Bus/Angkot/KRL)',
        ]);

        DB::table('jenis_tinggal')->insert([
            'jeting' => 'Bersama Orang Tua',
        ]);
        
        DB::table('jenis_tinggal')->insert([
            'jeting' => 'Bersama Kakek/Nenek/Kerabat',
        ]);
        
        DB::table('jenis_tinggal')->insert([
            'jeting' => 'Pondok Pesantren',
        ]);
        
        DB::table('jenis_tinggal')->insert([
            'jeting' => 'Kos / Kontrak',
        ]);

        DB::table('profesi')->insert([
            'profesi' => 'Karyawan Swasta',
        ]);

        DB::table('pendidikan')->insert([
            'pendidikan' => 'SD Sederajat / Paket A',
        ]);

        DB::table('pendidikan')->insert([
            'pendidikan' => 'SMP Sederajat / Paket B',
        ]);

        DB::table('pendidikan')->insert([
            'pendidikan' => 'SMA Sederajat / Paket C',
        ]);

        DB::table('pendidikan')->insert([
            'pendidikan' => 'S1',
        ]);

        DB::table('pendidikan')->insert([
            'pendidikan' => 'S2',
        ]);

        DB::table('pendidikan')->insert([
            'pendidikan' => 'S3',
        ]);

        DB::table('profesi')->insert([
            'profesi' => 'Nelayan',
        ]);

        DB::table('profesi')->insert([
            'profesi' => 'Petani',
        ]);

        DB::table('profesi')->insert([
            'profesi' => 'Peternak',            
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'PNS/TNI/Polri',
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'Pedagang',
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'Wiraswasta ([Usaha] Warung Kopi/Penyetan/Bakso/dll)',
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'Wirausaha ([Usaha] Distributor/Produsen/Agen/dll)',
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'Pensiunan',
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'TKI / TKW',
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'Freelance / Serabutan',
        ]);

        DB::table('profesi')->insert([
            'profesi' => 'Tidak Berkerja / Sakit / Ibu Rumah Tangga',
        ]);
        
        DB::table('profesi')->insert([
            'profesi' => 'Sudah Meninggal',
        ]);

        DB::table('pembayaran')->insert([
            'nama_pembayaran' => 'Tunggakan',
            'nominal' => NULL,
            'kelas' => ''
        ]);
    }
}
