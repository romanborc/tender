<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Procurement;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
    	return view('dashboard.calendar');
    }

    public function getEvents()
    {
    	$events = Procurement::all();
    	return response()->json($events->map(function ($event) {
    		return [
    			'title' => $event->id_procurement,
    			'start' => $event->auction_period_end,
    			'url' => "https://zakupki.prom.ua/gov/tenders/" . $event->id_procurement,
    		];
    	}));
    }
}
