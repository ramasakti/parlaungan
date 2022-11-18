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
            'id' => '',
            'foto' => '',
            'status' => 'Admin',
        ]);

        DB::table('user')->insert([
            'username' => 'adminabsen',
            'password' => bcrypt('parlaungan1980'),
            'id' => '',
            'foto' => '',
            'status' => 'Admin'
        ]);

        DB::table('user')->insert([
            'username' => 'alfansasmiko',
            'password' => bcrypt('alfansasmiko'),
            'id' => '',
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
            'piket' => 'alfansasmiko'
        ]);
        
        DB::table('hari')->insert([
            'nama_hari' => 'Selasa',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko'
        ]);
        
        DB::table('hari')->insert([
            'nama_hari' => 'Rabu',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko'
        ]);

        DB::table('hari')->insert([
            'nama_hari' => 'Kamis',
            'masuk' => '06:50:00',
            'pulang' => '14:40:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko'
        ]);
        
        DB::table('hari')->insert([
            'nama_hari' => 'Jumat',
            'masuk' => '06:50:00',
            'pulang' => '10:20:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko'
        ]);

        DB::table('hari')->insert([
            'nama_hari' => 'Sabtu',
            'masuk' => '06:50:00',
            'pulang' => '13:00:00',
            'jampel' => '00:40:00',
            'piket' => 'alfansasmiko'
        ]);

        DB::table('nominal')->insert([
            'jenis' => 'Mengajar',
            'harga' => 33000
        ]);
        
        DB::table('nominal')->insert([
            'jenis' => 'Transport',
            'harga' => 5000
        ]);
    }
}
