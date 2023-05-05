<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'kelulusan';
    protected $primaryKey = 'nisn';
    protected $fillable = [
        'nisn', 'lulus', 'siswa_id'
    ];   
}
