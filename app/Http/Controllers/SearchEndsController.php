<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class SearchEndsController extends Controller
{
   

    public function showList(Request $request)
    {
        return view('ends.EndsSearchList');
    }
    
}
