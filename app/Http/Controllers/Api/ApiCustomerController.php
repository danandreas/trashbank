<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiCustomerController extends Controller
{
    protected function store(Request $request)
    {
        $emailExist = Customer::where('email', $request['email'])->first();
        if (!empty($request['email']) && $emailExist == TRUE){ // Jika email tidak kosong dan duplikat
            return response()->json(['message'=>'Email telah digunakan'], 409);
        } else {
            # Get Bank ID from Employee Logged
            //$bank_id = $request['bank_id'];

            # Generate Account Number"
            //$bankCode = Bank::where('id',$bank_id)->first()->code;
            //$maxCustomerId = Customer::where('bank_id',$bank_id)->max('id');
            //$accountNumber = $bankCode . sprintf("%03d", $maxCustomerId + 1);

            $record = [
                // 'bank_id' => $bank_id,
                // 'account_number' => $accountNumber,
                // 'name' => $request['name'],
                // 'gender' => $request['gender'],
                // 'phone' => $request['phone'],
                // 'address' => $request['address'],
                // 'email' => $request['email'],
                // 'password' => Hash::make($request['password']),
                // 'saldo' => "0",
                // 'status' => "0", // Belum Aktif
                'bank_id' => "0",
                'account_number' => date("Y-m-d h:i:a"),
                'name' => $request['name'],
                'gender' => "0",
                'phone' => $request['phone'],
                'address' => $request['address'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'saldo' => "0",
                'status' => "0", // Belum Aktif
            ];
            Customer::create($record);
			return response()->json(['message'=>'Berhasil registrasi, silahkan login'], 201);
        }
		return response()->json(['message'=>'Internal Server Error'], 501);
    }

    protected function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:3'
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            // Update Device Token
            $record = Customer::find($request['email']);
            $record->update([
                'device_token' => $request['device_token']
            ]);
            // Data Customer
            $d = Auth::guard('customer')->user();
            return response()->json([
                'status' => 200,
                'message' => 'Login Berhasil',
                'access_token' => $d->email,
                'customer' => array(
                    'id' => $d->id,
                    'name' => $d->name,
                )
            ], 200);
        }
        return response()->json(['status' => 401, 'message'=>'Kombinasi email dan password salah'], 401);
    }
}
