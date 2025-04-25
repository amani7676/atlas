<?php

namespace App\Http\Controllers;

use App\Services\DataService;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // protected $DataService;
    // public function __construct(DataService $dataService)
    // {
    //     $this->DataService = $dataService;
    // }
    // public function index()
    // {
    //     $result = $this->DataService->getVahedWithResidents();
    //     $residents = $this->DataService->getResidentsFromVahedData($result);
    //     return view("pages/list/mainlist",  data: ['data' => $result, 'residents' => $residents]);
    // }
}
