<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Participant;
use App\Models\Procurement;
use Illuminate\Support\Facades\Validator;


class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function get()
    {
    	$results = Result::with('participants')->get();
    	
    	return response()->json($results);
    }

    public function show($id)
    {
        $result = Result::with('winners', 'wonByPrice', 'results_statuses')->where('procurement_id', $id)->get();
        
        return response()->json($result);
    }

    public function updateOrCreate(Request $request)
    {       
        $result = $request->results;
        foreach ($result as $value) {
            
            $winner_id = Participant::firstOrCreate([
                'name' => $value['winners']
            ]); 

            $results = Result::updateOrCreate([
                'id' => $value['id']
            ],
            [
                'results' => $value['results'],
                'winner_amount' => $value['winner_amount'],
                'procurement_id' => $request['procurement_id'],
                'winners_id' => $winner_id->id,
                'statuses_id' => $value['statuses_id'],
            ]); 
        } 
    }

    public function deleteLotResult($id)
    {
        Result::find($id)->delete();
    }

    public function deleteResult($id)
    {
        Result::where('procurement_id', $id)->delete();
    }
}