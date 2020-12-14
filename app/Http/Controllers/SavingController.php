<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Saving;
use App\Models\Customer;
use App\Models\Trash;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $data['title'] = "Tabungan";
        $data['customer'] = Customer::where('bank_id',$bank_id)->orderBy('name', 'asc')->get();
        $data['trash'] = Trash::orderBy('name', 'asc')->get();
        return view('page_dashboard.saving', $data);
    }

    public function data()
    {
        $query = Saving::orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $record[$i] = [];
            $record[$i]['id'] = $d->id;
            $record[$i]['created_at'] = myDate($d->created_at);
            $record[$i]['customer_name'] = $d->customer->name;
            $record[$i]['bank_name'] = $d->bank->name;
            $record[$i]['trash_name'] = $d->trash->name;
            $record[$i]['weight'] = $d->weight;
            $record[$i]['description'] = $d->description;
            $record[$i]['transaction_status'] = $d->transaction_status;
        }
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    protected function store(Request $request)
    {
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $record = [
            'customer_id' => $request['customer_id'],
            'bank_id' => $bank_id,
            'trash_id' => $request['trash_id'],
            'weight' => str_replace(',', '.', $request['weight']),
            'description' => $request['description'],
            'transaction_status' => "0",
        ];
        $insert = Saving::create($record);

        if ($insert == TRUE) {
            return response()->json([
                'code' => '200',
                'data' => 'Create Success',
            ]);
        } else {
            return response()->json([
                'code' => '200',
                'data' => 'Create Failed',
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->has('id')){
            $record = Saving::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Saving::find($request->input('id'));
            $record->update([
                'trash_id' => $request['trash_id'],
                'weight' => str_replace(',', '.', $request['weight']),
                'description' => $request['description'],
            ]);
            if ($record == TRUE) {
                return response()->json([
                    'code' => '200',
                    'data' => 'Update Success',
                ]);
            } else {
                return response()->json([
                    'code' => '200',
                    'data' => 'Update Failed',
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
        if($request->has('id')){
            $record = Saving::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }
}
