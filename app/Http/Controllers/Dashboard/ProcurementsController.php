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
use App\Models\ProcurementStatus;
use App\Models\ProcurementsDeteil;
use App\User;
use Carbon\Carbon;
use App\Mail\MailSendProcurement;
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
        $procurement_statuses = ProcurementStatus::all();

        return view('dashboard.procurements.index', compact('procurements', 'participants', 'users', 'types', 'subjects', 'statuses', 'procurement_statuses', 'search'));
    }

    public function create()
    {
        $users = User::all();
        $subjects = Subject::all();
        $types = Type::all();
        $statuses = Status::all();
        return view('dashboard.procurements.create', compact('users', 'subjects', 'types', 'statuses'));
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
            'identifier' => 'max:8',
            'details.*.offers_period_end_lot' => 'date|nullable',
            'details.*.auction_period_end_lot' => 'date|nullable',
            'details.*.amount_lot' => 'max:12',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            if($request->users_id != null)
            {
                $user = User::find($request->users_id);
                \Mail::to($user)->send(new MailSendProcurement($request));
                
                $this->addNewProcurements($request);
                return redirect("/admin");

            } else {
                $this->addNewProcurements($request);
                return redirect("/admin");
            }
        }
    }

    public function edit($id) {
        $procurement = Procurement::where('id', $id)->first(); 
        $procurementDeteils = ProcurementsDeteil::where('procurement_id', $id)->get();
        return response()->json(compact('procurement', 'procurementDeteils'));
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
            'identifier' => 'max:8',
            'details.*.name' => 'max:255',
            'details.*.offers_period_end_lot' => 'date',
            'details.*.auction_period_end_lot' => 'date',
            'details.*.amount_lot' => 'max:12',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            Procurement::find($request->id)->update([
                'customer' => $request->customer,
                'id_procurement' => $request->id_procurement,
                'offers_period_end' => Carbon::parse($request->offers_period_end)->format('Y-m-d H:i'),
                'auction_period_end' => ($request->auction_period_end != null) ? Carbon::parse($request->auction_period_end)->format('Y-m-d H:i') : null,
                'amount' => $request->amount,
                'users_id' => $request->users_id,
                'subjects_id' => $request->subjects_id,
                'types_id' => $request->types_id,
                'identifier' => $request->identifier,
                'statuses_id' => $request->statuses_id,
                'description' => $request->description
            ]);

            $this->updateOrCreateLot($request, $request); 
        }
    }

    public function deleteProcurements($id)
    {
        Procurement::find($id)->delete();
    }

    public function deleteLot($id)
    {
        ProcurementsDeteil::find($id)->delete();
    }

    private function addNewProcurements(Request $request) 
    {
        $procurement = Procurement::create([
            'customer' => $request->customer,
            'id_procurement' => $request->id_procurement,
            'offers_period_end' => Carbon::parse($request->offers_period_end)->format('Y-m-d H:i'),
            'auction_period_end' => ($request->auction_period_end != null) ? Carbon::parse($request->auction_period_end)->format('Y-m-d H:i') : null,
            'amount' => $request->amount,
            'users_id' => $request->users_id,
            'subjects_id' => $request->subjects_id,
            'types_id' => $request->types_id,
            'identifier' => $request->identifier,
            'statuses_id' => $request->statuses_id,
            'description' => $request->description,
        ]);
        
        if($procurement)
        {
            $this->updateOrCreateLot($request, $procurement);
        }   
    }

    private function updateOrCreateLot(Request $request, $procurement)
    {
        $details = $request->details;
        if(is_array($details)) {
           foreach ($details as $value) {
                $data = ProcurementsDeteil::updateOrCreate(
                [
                    'id' => $value['id'],
                ],
                [   
                    'name' => $value['name'],
                    'offers_period_end_lot' => Carbon::parse($value['offers_period_end_lot'])->format('Y-m-d H:i'),
                    'auction_period_end_lot' => Carbon::parse($value['auction_period_end_lot'])->format('Y-m-d H:i'),
                    'amount_lot' => $value['amount_lot'],
                    'procurement_id' => $procurement->id,
                ]); 
            }
        }
                     
    }        
}
