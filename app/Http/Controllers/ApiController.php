<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function userAPI()
    {
        return response([
            'success' => TRUE,
            'data' => DB::table('user')->get(),
        ], 200);
    }
}
