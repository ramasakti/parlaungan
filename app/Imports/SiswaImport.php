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
            'nama_siswa' => $row[1],
            'kelas_id' => $row[2],
            'alamat' => $row[3],
            'telp' => $row[4],
            'tempat_lahir' => $row[5],
            'tanggal_lahir' => $row[6],
        ]);
    }
}
