<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;


class ResultsController extends Controller
{
    public function get()
    {
    	$results = Result::with('participants')->get();
    	
    	return response()->json($results);
    }

    public function show($id)
    {
        $result = Result::with('participants')->where('procurement_id', $id)->first();
        
        return response()->json($result);
    }

    public function updateOrCreate(Request $request)
    {
    	$results = Result::updateOrCreate([
    		'id' => request('id')
    	],
    	[
    		'results' => request('results'),
    		'participants_id' => request('participants_id'),
    		'procurement_id' => request('procurement_id'),
    	]);    
    }

}
