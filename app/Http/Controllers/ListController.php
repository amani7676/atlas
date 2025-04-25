<?php

namespace App\Http\Controllers;

use App\Services\DataServices;
use Illuminate\Http\Request;

class ListController extends Controller
{

    protected $dataAll;
    public function __construct(DataServices $dataService)
    {
        $this->dataAll = $dataService;
    }
    public function index()
    {
        $result = $this->dataAll->getAllData();
        $residents = $this->dataAll->getResidents($result);
        return view("list/list",  data: ['data' => $result, 'residents' => $residents]);
    }
}
