<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function sinkronisasi()
    {
        // Contoh menggunakan mysqldump dan mysql shell commands
        $localDatabase = 'laravel';
        $host = '127.0.0.1';
        $username = 'root';
        $password = '';

        $remoteDatabase = 'smas5845_remote';
        $remoteHost = '103.247.10.175';
        $remoteUsername = 'smas5845_admin';
        $remotePassword = 'parlaungan1980';

        // Ekspor database lokal
        $localDumpCommand = "mysqldump -h{$host} -u{$username} -p{$password} {$localDatabase} > local_backup.sql";
        exec($localDumpCommand);

        // Impor database ke server hosting
        $remoteImportCommand = "mysql -h{$remoteHost} -u{$remoteUsername} -p{$remotePassword} {$remoteDatabase} < local_backup.sql";
        exec($remoteImportCommand);

        // Hapus file backup setelah sinkronisasi
        unlink('local_backup.sql');

        dd($remoteImportCommand);
    }
}
