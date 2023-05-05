<?php

namespace App\Imports;

use App\Models\Kelulusan;
use Maatwebsite\Excel\Concerns\ToModel;

class KelulusanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kelulusan([
            'nisn' => $row[0],
            'lulus' => $row[1],
            'siswa_id' => $row[2],
        ]);
    }
}
