<?php

namespace App\Http\Controllers;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = "Bank";
        return view('page_dashboard.bank', $data);
    }

    public function data()
    {
        $record = Bank::orderBy('id', 'desc')->get();
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    public function store(Request $request)
    {
        return Bank::create($request->all());
    }

    public function edit(Request $request)
    {
        if($request->has('id')){
            $record = Bank::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Bank::find($request->input('id'));
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
            $record = Bank::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }
}
