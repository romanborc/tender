<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Procurement;

class UsersController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$count = User::leftjoin('procurements', 'procurements.users_id', 'users.id')
    		->groupBy('users.id')
    		->orderBy('proc_count', 'desc')
    		->selectRaw('users.*, count(procurements.id) as proc_count')
    		->get();
    	
    	$users = User::all();

    	return view('dashboard.users.index', [
    		'users' => $users,
    	]);
    }
}
