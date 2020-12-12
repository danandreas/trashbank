<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['title'] = "Pegurus Bank";
        $data['bank'] = Bank::orderBy('name', 'asc')->get();
        return view('page_dashboard.employee', $data);
    }

    public function data()
    {
        $query = Employee::orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $record[$i] = [];
            $record[$i]['id'] = $d->id;
            $record[$i]['name'] = $d->name;
            $record[$i]['phone'] = $d->phone;
            $record[$i]['email'] = $d->email;
            $record[$i]['bank_name'] = $d->bank->name;
        }
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    protected function store(Request $request)
    {
        $record = Employee::create([
            'bank_id' => $request['bank_id'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        if ($record == TRUE) {
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
            $record = Employee::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Employee::find($request->input('id'));
            $record->update([
                'bank_id' => $request['bank_id'],
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email']
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
                    'code' => '200',
                    'data' => 'Update Failed',
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
        if($request->has('id')){
            $record = Employee::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }
}
