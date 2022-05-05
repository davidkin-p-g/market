<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboard_controller extends Controller
{
    //

    public function dachboard()
    {
        return view('admin.dachboard');
    }
}
