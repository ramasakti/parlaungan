<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'id_siswa' => $row[0],
            'rfid' => $row[1],
            'nama_siswa' => $row[2],
            'kelas_id' => $row[3],
            'alamat' => $row[4],
            'telp' => $row[5],
            'tempat_lahir' => $row[6],
            'tanggal_lahir' => $row[7]
        ]);
    }
}
