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
        //$data['bank'] = Bank::orderBy('name', 'asc')->get();
        return view('page_dashboard.customer', $data);
    }

    public function data()
    {
        # Get Bank ID from Employee Logged
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $query = Customer::where('bank_id',$bank_id)->orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $record[$i] = [];
            $record[$i]['id'] = $d->id;
            $record[$i]['account_number'] = $d->account_number;
            $record[$i]['name'] = $d->name;
            $record[$i]['gender'] = $d->gender;
            $record[$i]['phone'] = $d->phone;
            $record[$i]['address'] = $d->address;
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
        $emailExist = Customer::where('email', $request['email'])->first();
        if (!empty($request['email']) && $emailExist == TRUE){ // Jika email tidak kosong dan duplikat
            return response()->json([
                'code' => '302',
                'data' => 'Email Duplicated',
            ]);
        } else {
            # Get Bank ID from Employee Logged
            if(Auth::guard('employee')->check()) {
                $bank_id = Auth::guard('employee')->user()->bank_id;
            } else {
                $bank_id = 0;
            }

            # Generate Account Number"
            $bankCode = Bank::where('id',$bank_id)->first()->code;
            $maxCustomerId = Customer::where('bank_id',$bank_id)->max('id');
            $accountNumber = $bankCode . sprintf("%03d", $maxCustomerId + 1);

            $record = [
                'bank_id' => $bank_id,
                'account_number' => $accountNumber,
                'name' => $request['name'],
                'gender' => $request['gender'],
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
                    'code' => '500',
                    'data' => 'Create Failed',
                ]);
            }
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
        $emailExist = Customer::where('email', $request['email'])->first();
        $emailOwner = Customer::where('id', $request['id'])->first()->email;
        if (!empty($request['email']) && $emailExist == TRUE && $emailOwner !== $request['email']){ // Jika email tidak kosong dan duplikat dan email ownernya
            return response()->json([
                'code' => '302',
                'data' => 'Email Duplicated',
            ]);
        } else {
            if($request->has('id')){
                $record = Customer::find($request->input('id'));
                $record->update([
                    'name' => $request['name'],
                    'gender' => $request['gender'],
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
