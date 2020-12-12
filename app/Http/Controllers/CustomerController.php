<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $data['title'] = "Nasabah";
        $data['bank'] = Bank::orderBy('id', 'desc')->get();
        return view('page_dashboard.customer', $data);
    }

    public function data()
    {
        $query = Customer::orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $record[$i] = [];
            $record[$i]['id'] = $d->id;
            $record[$i]['name'] = $d->name;
            $record[$i]['phone'] = $d->phone;
            $record[$i]['email'] = $d->email;
            $record[$i]['bank_name'] = $d->bank->name;
            $record[$i]['status'] = $d->status;
            $record[$i]['created_at'] = myDate($d->created_at);
        }
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    protected function store(Request $request)
    {
        # Get Bank ID from Employee Logged
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $record = [
            'bank_id' => $bank_id,
            'account_number' => rand(1000,9999),
            'name' => $request['name'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'saldo' => "0",
            'status' => "1",
        ];

        if (!empty($request['email'])) {
                $record['email'] = $request['email'];
        }
        if (!empty($request['password'])) {
                $record['password'] = Hash::make($request['password']);
        }
        $insert = Customer::create($record);

        if ($insert == TRUE) {
            return response()->json([
                'code' => '200',
                'data' => 'Create Success',
            ]);
        } else {
            return response()->json([
                'code' => '405',
                'data' => 'Create Failed',
            ]);
        }
    }

    public function edit(Request $request)
    {
        if($request->has('id')){
            $record = Customer::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Customer::find($request->input('id'));
            $record->update([
                'bank_id' => $request['bank_id'],
                'name' => $request['name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'email' => $request['email'],
            ]);

            if (!empty($request['password'])) {
                $record->update([
                    'password' => Hash::make($request['password'])
                ]);
            }
            if ($record == TRUE) {
                return response()->json([
                    'code' => '200',
                    'data' => 'Update Success',
                ]);
            } else {
                return response()->json([
                    'code' => '405',
                    'data' => 'Update Failed',
                ]);
            }
        }
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        Customer::where("id", $id)->update(["status" => $status]);
    }

    public function delete(Request $request)
    {
        if($request->has('id')){
            $record = Customer::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }
}
