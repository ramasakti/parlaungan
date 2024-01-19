<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FaceRecognitionController extends Controller
{
    public function index()
    {
        return view('absen.recognition');
    }

    public function api()
    {  
        $path = public_path().'/face';
        $directories = array_diff(scandir($path), ['.', '..']); // Exclude . and ..

        $data = [];

        foreach ($directories as $directory) {
            $directoryPath = $path . '/' . $directory;
            $files = array_diff(scandir($directoryPath), ['.', '..']);
            $fileCount = count($files);

            $data[] = [
                'label' => $directory,
                'path' => "./storage/profil/face/{$directory}/",
                'count' => $fileCount,
            ];
        }

        return response()->json([
            'payload' => $data
        ]);
    }
}
