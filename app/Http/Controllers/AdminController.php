<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        //  $this->middleware('auth');
        // $this->middleware('guest:admin')->except('logout');
    }

    public function index()
    {
        $data['title'] = "Admin";
        return view('page_dashboard.admin', $data);
    }

    public function data()
    {
        $record =  Admin::all();
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    protected function store(Request $request)
    {
        $record = Admin::create([
            'name' => $request['name'],
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
            $record = Admin::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Admin::find($request->input('id'));
            $record->update([
                'name' => $request['name'],
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
            $record = Admin::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }
}
