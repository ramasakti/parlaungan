<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function add(Request $request)
    {
        return view('web.home.add-hp', [
            'ai' => 1,
            'title' => 'Web',
            'navactive' => 'web',
        ]);
    }

    public function store(Request $request)
    {
        
    }
}
