<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Procurement;
use App\Models\Participant;
use App\Models\Subject;
use App\Models\Type;
use App\Models\Status;
use App\User;

class SearchController extends Controller
{
    public function filter(Request $request, Procurement $procurements)
    {
    	$participants = Participant::all();
    	$users = User::all();  
        $subjects = Subject::all();
        $types = Type::all();
        $statuses = Status::all();
    	$procurements = $procurements->newQuery();
    	$search = $request->input('search');

    	if($request->filled('id_procurement')) {
    		$procurements->where('id_procurement', $request->input('id_procurement'));
    	}

    	if ($request->filled('offers_period_from')<>'' && $request->filled('offers_period_to')<>'')
    	{    
	        $start = date("Y-m-d",strtotime($request->input('offers_period_from')));
	        $end = date("Y-m-d",strtotime($request->input('offers_period_to')."+1 day"));
	        $procurements->whereBetween('offers_period_end',[$start,$end]);
	    }

	    if ($request->filled('auction_period_from') && $request->filled('auction_period_to'))
    	{    
	        $start = date("Y-m-d",strtotime($request->input('auction_period_from')));
	        $end = date("Y-m-d",strtotime($request->input('auction_period_to')."+1 day"));
	        $procurements->whereBetween('auction_period_end',[$start,$end]);
	    }

	    if($request->filled('users_id')) {
	    	
    		if($request->input('users_id') == "null") {
    			$procurements->whereNull('users_id');	
    		} else {
    			$procurements->where('users_id', $request->input('users_id'));
    		}
    	} 


    	if ($request->filled('amout_from') && $request->filled('amout_to'))
    	{    
	        $start = $request->input('amout_from');
	        $end = $request->input('amout_to');
	        $procurements->whereBetween('amount',[$start,$end]);
	    }

	    if ($request->filled('identifier'))
    	{    
	        $procurements->where('identifier', $request->input('identifier'));
	    }

	    if ($request->filled('statuses_id'))
    	{    
	        $procurements->where('statuses_id', $request->input('statuses_id'));
	    }

	    if ($request->filled('types_id'))
    	{    
	        $procurements->where('types_id', $request->input('types_id'));
	    }
    	

    	return view('dashboard.procurements.index', [
            "procurements" => $procurements->paginate(10),
            "participants" => $participants,
            "users" => $users,
            "search" => $search,
            "subjects" => $subjects,
            "types" => $types,
            "statuses" => $statuses
        ]); 
    }
}
