<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
       
        $residents = Resident::with([
             'takht.otagh.vahed'
        ])
            ->where(function($query) use ($search) {
                $query->where('full_name', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%");
            })
            ->get()
            ->map(function($resident) {
                return [
                    'full_name' => $resident->full_name,
                    'phone' => $resident->phone,
                    'takht_name' => $resident->takht->name,
                    'otagh_name'  => $resident->takht->otagh->name,
                ];
            });
            
        return response()->json($residents);
    }

    public function showList(Request $request)
    {
        return view('Search.SearchList');
    }
    
}
