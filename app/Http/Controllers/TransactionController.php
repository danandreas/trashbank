<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Bank;
use App\Models\Saving;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customer;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data['title'] = "Transaksi";
        return view('page_dashboard.transaction', $data);
    }

    public function data()
    {
        # Get Bank ID from Employee Logged
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $query = Transaction::where('bank_id',$bank_id)->orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $record[$i] = [];
            $record[$i]['id'] = $d->id;
            $record[$i]['created_at'] = myDate($d->created_at);
            $record[$i]['bank_name'] = $d->bank->name;
            $record[$i]['name'] = $d->name;
            $record[$i]['description'] = $d->description;
            $record[$i]['price_per_weight'] = myCurrency($d->price_per_weight);
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

        /* Insert Transaction */
        $record = [
            'bank_id' => $bank_id,
            'name' => $request['name'],
            'description' => $request['description'],
            'price_per_weight' => $request['price_per_weight'],
        ];
        $insert = Transaction::create($record);
        $newTransactionId = $insert->id;

        /* Insert Transaction Detail */
        $savingSelection = Saving::where('transaction_status','0')->where('bank_id',$bank_id)->get();
        foreach ($savingSelection as $d) {
            $addSaldo = $d->weight * $request['price_per_weight'];
            $recordDetail = [
                'transaction_id' => $newTransactionId,
                'saving_id' => $d->id,
                'income' => $addSaldo,
            ];
            $insertDetail = TransactionDetail::create($recordDetail);

            /* Update Field Saldo at Customer */
            $customer = Customer::where('id', $d->customer_id);
            $customer->update([
                'saldo' => $addSaldo
            ]);

            /* Update Field 'transaction_status' at Saving */
            $saving = Saving::where('id', $d->id);
            $saving->update([
                'transaction_status' => '1'
            ]);
        }

        if ($insert === TRUE && $insertDetail === TRUE) {
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
            $record = Transaction::find($request->input('id'));
            return response()->json([
                'code' => '200',
                'data' => $record,
            ]);
        }
    }

    public function detail($id)
    {
        $data['title'] = "Transaksi";
        $data['parameterId'] = $id;
        return view('page_dashboard.transaction_detail', $data);
    }

    public function detail_data($id)
    {
        $query = TransactionDetail::where('transaction_id',$id)->orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $customerId = Saving::where('id', $d->saving_id)->first()->customer_id;
            $customer = Customer::where('id',$customerId)->first();
            $record[$i]['id'] = $d->id;
            $record[$i]['created_at'] = myDate($d->created_at);
            $record[$i]['account_number'] = $customer->account_number;
            $record[$i]['customer_name'] = $customer->name;
            $record[$i]['income'] = myCurrency($d->income);
        }
        return response()->json([
            'code' => '200',
            'data' => $record,
        ]);
    }

    public function update(Request $request)
    {
        if($request->has('id')){
            $record = Transaction::find($request->input('id'));
            $record->update([
                'name' => $request['name'],
                'description' => $request['description'],
            ]);
            if ($record === TRUE) {
                return response()->json([
                    'code' => '200',
                    'data' => 'Update Success',
                ]);
            } else {
                return response()->json([
                    'code' => '500',
                    'data' => 'Update Failed',
                ]);
            }
        }
    }

    // public function delete(Request $request)
    // {
    //     if($request->has('id')){
    //         $record = Saving::where('id',$request->input('id'));
    //         $record->delete();
    //         return response()->json([
    //             'code' => '200',
    //             'data' => 'Delete Success',
    //         ]);
    //     }
    // }
}
