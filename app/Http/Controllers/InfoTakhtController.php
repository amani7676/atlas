<?php

namespace App\Http\Controllers;

use App\Services\DataServices;
use Illuminate\Http\Request;

class InfoTakhtController extends Controller
{
    protected $getDataAll ;
    public function __construct(DataServices $dataServices) {
        $this->getDataAll = $dataServices;
    }
    public function showList()
    {
        $data  = [
            'VahedPerTotalOtaghs' => $this->getDataAll->getVahedPerTotalOtaghs(),
            'TotalPerVahed' => $this->getDataAll->getTotalPerVahed(),
            'TotalTakhtsPerNumbers' => $this->getDataAll->getTotalTakhtsPerNumbers(),
        ];
        return view('takhts.amartakhts', data : ['data' => $data]);
    }
}
