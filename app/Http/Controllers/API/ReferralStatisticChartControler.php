<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Referral\ReferralStatisticChart;
use Illuminate\Http\Request;

class ReferralStatisticChartControler extends Controller
{

    private $chart;
    
    public function __construct(Request $request)
    {
        $this->chart = new ReferralStatisticChart($request);
    }

    public function getCities() 
    {
        return $this->chart->getReferralCititesStatistics();
    }

    public function getPartners() 
    {
        return $this->chart->getReferralTimeStatistic();
    }
}
