<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Participant;
use Illuminate\Support\Facades\Validator;


class ResultsController extends Controller
{
    public function get()
    {
    	$results = Result::with('participants')->get();
    	
    	return response()->json($results);
    }

    public function show($id)
    {
        $result = Result::with('winners', 'wonByPrice')->where('procurement_id', $id)->first();
        
        return response()->json($result);
    }

    public function updateOrCreate(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'won_by_price' => 'required|max:255',
        ]);

        if($validator->fails()) {
           return response()->json(['errors'=>$validator->errors()]);
        } else {
            $won_by_price_id = Participant::firstOrCreate([
            'name' => request('won_by_price')
            ]);
            $winner_id = Participant::firstOrCreate([
            'name' => request('winners')
            ]); 

            $results = Result::updateOrCreate([
                'id' => request('id')
            ],
            [
                'results' => request('results'),
                'winner_amount' => request('winner_amount'),
                'amount' => request('amounts'),
                'procurement_id' => request('procurement_id'),
                'won_by_price_id' => $won_by_price_id->id,
                'winners_id' => $winner_id->id,
            ]); 
        }        
    }
}