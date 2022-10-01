<?php

namespace App\Imports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;

class JadwalImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jadwal([
            'id_jadwal' => $row[0],
            'hari' => $row[1],
            'guru_id' => $row[2],
            'kelas_id' => $row[3],
            'mapel' => $row[4],
            'mulai' => $row[5],
            'sampai' => $row[6],
            'status' => $row[7]
        ]);
    }
}
