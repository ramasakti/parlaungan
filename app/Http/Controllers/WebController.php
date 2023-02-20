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
            'dataBlog' => DB::table('blog')->get()
        ]);
    }
    
    public function about()
    {
        return view('about', [
            'title' => 'About',
            'navactive' => 'about',
        ]);
    }
}
