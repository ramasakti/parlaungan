<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $with = 'kelas';
    protected $fillable = [
        'id_siswa', 'rfid', 'nama_siswa', 'kelas_id', 'alamat', 'telp', 'tempat_lahir', 'tanggal_lahir'
    ];                                                                           
}
