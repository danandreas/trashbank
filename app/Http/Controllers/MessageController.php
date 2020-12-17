<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MessageController extends Controller
{
    public function index()
    {
        # Get Bank ID from Employee Logged
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $data['title'] = "Pesan";
        $data['customer'] = Customer::where('bank_id',$bank_id)->orderBy('name', 'asc')->get();
        return view('page_dashboard.message', $data);
    }

    public function data()
    {
        /*------------------------------- Join 2 Table Where ---------------------------------*/
        // $query = Message::where([['bank_id',$bank_id]])->whereHas('customer',function($q) {
        //     $q->where('status', '1');
        // })->orderBy('id', 'desc')->get();
        /*-----------------------------------------------------------------------------------*/

        //$query = Message::where('bank_id',$bank_id)->groupBy('customer_id')->orderBy('id', 'desc')->get();
        $query = Message::whereIn('id', function($q) {
            # Get Bank ID from Employee Logged
            if(Auth::guard('employee')->check()) {
                $bank_id = Auth::guard('employee')->user()->bank_id;
            } else {
                $bank_id = 0;
            }
            $q->from('messages')->where('bank_id',$bank_id)->groupBy('customer_id')->selectRaw('MAX(id)');
        })->orderBy('id', 'desc')->get();

        $record = [];
        foreach($query as $i => $d){
            $record[$i] = [];
            $record[$i]['id'] = $d->id;
            $record[$i]['bank_id'] = $d->bank_id;
            $record[$i]['bank_name'] = $d->bank->name;
            $record[$i]['customer_id'] = $d->customer_id;
            $record[$i]['customer_name'] = $d->customer->name;
            $record[$i]['message'] = $d->message;
            $record[$i]['created_at'] = myTime($d->created_at);
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
            'bank_id' => $bank_id,
            'customer_id' => $request['customer_id'],
            'sender' => 'bank',
            'message' => $request['message'],
        ];
        $insert = Message::create($record);

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

    public function detail(Request $request)
    {
        if($request->has('customer_id')){
            $user = Customer::where('id',$request['customer_id'])->get();
            $record = [];
            foreach($user as $i => $x){
                $content = Message::where('customer_id',$x['id'])->orderBy('id', 'asc')->get();
                $a['customer_id'] = $x['id'];
                $a['customer_name'] = $x['name'];
                $b = [];
                    foreach ($content as $j => $y) {
                        $b[$j]['sender'] = $y['sender'];
                        $b[$j]['message'] = $y['message'];
                        $b[$j]['created_at'] = myTime($y['created_at']);
                    }
            }
            $a['content'] = $b;
            $record = $a;

            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->has('id')){
            $record = Message::where('id',$request->input('id'));
            $record->delete();
            return response()->json([
                'code' => '200',
                'data' => 'Delete Success',
            ]);
        }
    }
}
