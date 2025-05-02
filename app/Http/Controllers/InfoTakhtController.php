<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoTakhtController extends Controller
{
    public function showList()
    {
        return view('takhts.amartakhts');
    }
}
