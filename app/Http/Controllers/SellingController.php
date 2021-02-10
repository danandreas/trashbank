<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Selling;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    public function index()
    {
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $data['title'] = "Penjualan";
        return view('page_dashboard.selling', $data);
    }

    public function data()
    {
        # Get Bank ID from Employee Logged
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $query = Selling::where('bank_id',$bank_id)->orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $record[$i]['id'] = $d->id;
            $record[$i]['created_at'] = myDate($d->created_at);
            $record[$i]['name'] = $d->name;
            $record[$i]['bank_id'] = $d->bank_id;
            $record[$i]['bank_name'] = $d->bank->name;
            $record[$i]['date_start'] = myDate($d->date_start);
            $record[$i]['date_end'] = myDate($d->date_end);
            $record[$i]['status'] = $d->status;
        }
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    public function store(Request $request)
    {
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $record = [
            'bank_id' => $bank_id,
            'name' => $request['name'],
            'date_start' => $request['date_start'],
            'date_end' => $request['date_end'],
            'status' => "1",
        ];
        $insert = Selling::create($record);
        if ($insert === TRUE) {
            return response()->json([
                'code' => '200',
                'data' => 'Create Success',
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => 'Create Failed',
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->has('id')){
            $record = Selling::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Selling::find($request->input('id'));
            $record->update($request->all());
            return response()->json([
                'code' => '200',
                'data' => 'Update Success',
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->has('id')){
            $record = Selling::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        Selling::where("id", $id)->update(["status" => $status]);
    }
}