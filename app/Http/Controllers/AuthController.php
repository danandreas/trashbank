<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:employee')->except('logout');
    }

    public function loginAdmin()
    {
        $data['title'] = "Login Admin";
        $data['post_url'] = url('auth/check-admin');
        return view('layout_auth', $data);
    }

    public function loginEmployee()
    {
        $data['title'] = "Login Pengurus";
        $data['post_url'] = url('auth/check-employee');
        return view('layout_auth', $data);
    }

    public function checkAdmin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/auth-admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
