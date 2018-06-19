<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Procurement;
use App\Models\Subject;
use App\Models\Type;
use App\Models\Result;
use App\Models\Participant;
use App\Models\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProcurementsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

    	$procurements = Procurement::search($search)
        ->paginate(10);
    	$participants = Participant::all();   
        $users = User::all();   
        $subjects = Subject::all();
        $types = Type::all();
        $statuses = Status::all();

        return view('dashboard.procurements.index', compact('procurements', 'participants', 'users', 'types', 'subjects', 'statuses', 'search'));
    }

    public function create()
    {
        $users = User::all();
        $subjects = Subject::all();
        $types = Type::all();
        return view('dashboard.procurements.create', [
                "users" => $users,
                "subjects" => $subjects,
                "types" => $types,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer' => 'required|max:255',
            'id_procurement' => 'required|unique:procurements',
            'offers_period_end' => 'required|date',
            'amount' => 'required|max:12',
            'subjects_id' => 'required',
            'types_id' => 'required',
            'identifier' => 'max:8'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            
            Procurement::create([
                'customer' => $request->customer,
                'id_procurement' => $request->id_procurement,
                'offers_period_end' => Carbon::parse($request->offers_period_end)->format('Y-m-d H:i'),
                'auction_period_end' => ($request->auction_period_end != null) ? Carbon::parse($request->auction_period_end)->format('Y-m-d H:i') : null,
                'amount' => $request->amount,
                'users_id' => $request->users_id,
                'subjects_id' => $request->subjects_id,
                'types_id' => $request->types_id,
                'identifier' => $request->identifier,
                'description' => $request->description
            ]);
            return redirect("/admin");
        }
    }

    public function edit($id) {
        $procurement = Procurement::with('users')->where('id', $id)->first(); 

        return response()->json($procurement);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer' => 'required|max:255',
            'id_procurement' => 'required',
            'offers_period_end' => 'required|date',
            'amount' => 'required|max:12',
            'subjects_id' => 'required',
            'types_id' => 'required',
            'identifier' => 'max:8'
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            Procurement::find($request->id)->update([
                'customer' => $request->customer,
                'id_procurement' => $request->id_procurement,
                'offers_period_end' => $request->offers_period_end,
                'auction_period_end' => ($request->auction_period_end != null) ? $request->auction_period_end : null,
                'amount' => $request->amount,
                'users_id' => $request->users_id,
                'subjects_id' => $request->subjects_id,
                'types_id' => $request->types_id,
                'identifier' => $request->identifier,
                'statuses_id' => $request->statuses_id,
                'description' => $request->description
            ]);
        }
    }

    public function destroy($id)
    {
        dd($id);
        Procurement::find($id)->delete();
        return redirect("/admin");
    }


}
