<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Procurement;
use App\User;

class StatisticController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
    	$userStatistics = Procurement::leftjoin('users', 'procurements.users_id', 'users.id')
    		->leftjoin('results', 'results.procurement_id', 'procurements.id')
    		->groupBy('users.id')
    		->orderBy('proc_count', 'desc')
    		->selectRaw('users.*, count(procurements.id) as proc_count, 
    			sum(procurements.statuses_id = 2) as non_participation, 
    			sum(procurements.statuses_id = 1) as participate,
				sum(case when results.statuses_id = 1 then  results.winner_amount  else 0 end) as sum_total,
				sum(results.statuses_id = 1) as proc_wining,
				sum(results.statuses_id = 2) as proc_losing
    			')
    		->get();
    	return view('dashboard.statistic.statistic', ['userStatistics' => $userStatistics]);
    }
}
