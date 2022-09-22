<?php

namespace App\Controllers\SDM;

use App\Controllers\BaseController;

class AbsensiSDM extends BaseController
{
    public function index()
    {
        return view('pages/sdm/absensisdm');
    }
}