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
            'hari' => $row[0],
            'guru_id' => $row[1],
            'kelas_id' => $row[2],
            'mapel' => $row[3],
            'mulai' => $row[4],
            'sampai' => $row[5]
        ]);
    }
}
