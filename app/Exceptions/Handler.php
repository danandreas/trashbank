<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Auth\AuthenticationException;
use Auth;
use Illuminate\Support\Facades\Session;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = $exception->guards()[0];
        switch ($guard) {
            case 'admin':
                $login = 'auth.admin';
                break;
            default:
                $login = 'auth.employee';
                break;
        }
        Session::forget('url.intented');
        return redirect()->route($login);

        // if ($request->expectsJson()) {
        //     return response()->json(['error' => 'Unauthenticated.'], 401);
        // }
        // if ($request->is('admin') || $request->is('admin/*')) {
        //     return redirect()->guest('/auth/admin');
        // }
        // if ($request->is('employee') || $request->is('employee/*')) {
        //     return redirect()->guest('/auth/pengurus');
        // }

        // return response()->json(['error' => 'Unauthenticated.'], 401);
        // return redirect()->guest(route('login'));
    }
}
