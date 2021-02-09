<?php

namespace App\Http\Controllers;
use App\Models\Trash;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $data['title'] = "Jenis Sampah";
        return view('page_dashboard.trash', $data);
    }

    public function data()
    {
        $record =  Trash::orderBy('id', 'desc')->get();
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    public function store(Request $request)
    {
        return Trash::create($request->all());
    }

    public function edit(Request $request)
    {
        if($request->has('id')){
            $record = Trash::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Trash::find($request->input('id'));
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
            $record = Trash::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }
}
