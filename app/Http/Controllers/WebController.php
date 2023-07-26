<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WebController extends Controller
{
    public function index()
    {
        return view('web.index', [
            'ai' => 1,
            'title' => 'Web',
            'navactive' => 'web',
            'homePage' => DB::table('home_page')->get(),
            'dataBlog' => DB::table('blog')->get(),
            'dataGaleri' => DB::table('galeri')->get()
        ]);
    }
}
