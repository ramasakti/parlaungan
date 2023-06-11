<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JampelController extends Controller
{
    public function validator($request)
    {
        return [
            'hari' => 'required',
            'mulai' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    $existingJampel = DB::table('jam_pelajaran')
                        ->where('hari', $request->input('hari'))
                        ->where(function ($query) use ($value, $request) {
                            $query->where(function ($query) use ($value, $request) {
                                $query->where('mulai', '<=', $value)
                                    ->where('selesai', '>=', $value);
                            })
                            ->orWhere(function ($query) use ($value, $request) {
                                $query->where('mulai', '>=', $value)
                                    ->where('mulai', '<', $request->input('selesai'));
                            });
                        })
                        ->first();
        
                    if ($existingJampel) {
                        $fail('Range jam sudah terisi pada hari yang sama.');
                    }
                },
            ],
            'selesai' => [
                'required',
                'date_format:H:i',
            ],
        ];
    }
    public function storeJampel(Request $request)
    {
        $validatedJampel = $request->validate($this->validator($request));

        if ($validatedJampel->fails) {
            return back()->with('gagal', 'Gagal insert data! Jam bertabrakan');
        }

        DB::table('jam_pelajaran')
            ->insert([
                'hari' => $validatedJampel['hari'],
                'keterangan' => $request->keterangan,
                'mulai' => $validatedJampel['mulai'],
                'selesai' => $validatedJampel['selesai'],
            ]);

        return back()->with('success', 'Berhasil menambahkan jam pelajaran!');
    }
    
    public function updateJampel(Request $request)
    {
        $validatedJampel = $request->validate($this->validator($request));

        if (validate()->errors) {
            return back()->with('gagal', 'Gagal insert data! Jam bertabrakan');
        }

        DB::table('jam_pelajaran')
            ->where('id_jampel', $request->id_jampel)
            ->update([
                'hari' => $validatedJampel['hari'],
                'keterangan' => $request->keterangan,
                'mulai' => $validatedJampel['mulai'],
                'selesai' => $validatedJampel['selesai']
            ]);

        return back()->with('success', 'Berhasil mengedit data jam');
    }

    public function destroyJampel(Request $request)
    {
        DB::table('jam_pelajaran')
            ->where('id_jampel', $request->id_jampel)
            ->delete();

        return back()->with('success', 'Berhasil delete data!');
    }
}
