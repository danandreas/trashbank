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
        $data['trash'] = Trash::orderBy('id', 'desc')->get();
        return view('page_dashboard.saving', $data);
    }

    public function data()
    {
        # Get Bank ID from Employee Logged
        if(Auth::guard('employee')->check()) {
            $bank_id = Auth::guard('employee')->user()->bank_id;
        } else {
            $bank_id = 0;
        }

        $query = Saving::where('bank_id',$bank_id)->where('transaction_status','0')->orderBy('id', 'desc')->get();
        $record = [];
        foreach($query as $i => $d){
            $record[$i]['id'] = $d->id;
            $record[$i]['created_at'] = myDate($d->created_at);
            $record[$i]['account_number'] = $d->customer->account_number;
            $record[$i]['customer_name'] = $d->customer->name;
            $record[$i]['bank_name'] = $d->bank->name;
            $record[$i]['trash_name'] = $d->trash->name;
            $record[$i]['trash_detail'] = $d->trash_detail;
            $record[$i]['weight'] = $d->weight;
            $record[$i]['buying_price'] = $d->buying_price;
            $record[$i]['selling_price'] = $d->selling_price;
            $record[$i]['bank_total_price'] = $d->bank_total_price;
            $record[$i]['customer_total_price'] = $d->customer_total_price;
            $record[$i]['profit'] = $d->profit;
            $record[$i]['payment_method'] = myPaymentMethod($d->payment_method);
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

        /* ------- Calculation Price ------- */
        $weight = $request['weight'];
        $buying_price = $request['buying_price'];
        $selling_price = $request['selling_price'];
        $bank_total_price = $weight * $buying_price;
        $customer_total_price = $weight * $selling_price;
        $profit = $customer_total_price - $bank_total_price;

        $record = [
            'customer_id' => $request['customer_id'],
            'bank_id' => $bank_id,
            'trash_id' => $request['trash_id'],
            'trash_detail' => $request['trash_detail'],
            'weight' => str_replace(',', '.', $weight),
            'buying_price' => $buying_price,
            'selling_price' => $selling_price,
            'bank_total_price' => $bank_total_price,
            'customer_total_price' => $customer_total_price,
            'profit' => $profit,
            'payment_method' => $request['payment_method'],
            'description' => $request['description'],
            'transaction_status' => "0",
        ];
        $insert = Saving::create($record);

        /* ------- Payment Method == Ditabung ------- */
        $pm = $request['payment_method'];
        if ($pm == 2) {
            /* Update Field Saldo at Customer */
            $currentSaldo = Customer::where('id',$request['customer_id'])->first()->saldo;
            $newSaldo = $currentSaldo + $customer_total_price;        
            $customer = Customer::where('id', $request['customer_id']);
            $customer->update([
                'saldo' => $newSaldo
            ]);
        }        

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
                'trash_detail' => $request['trash_detail'],
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
