<?php

namespace App\Http\Controllers;

use App\Services\DataServices;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MainController extends Controller
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
        $paginatedResidents = $this->dataAll->getResidentsWithPagination($result, 10); // 10 آیتم در هر صفحه

        return view('main.main', data: ['data' => $result, 'residents' => $residents]);
    }
}
