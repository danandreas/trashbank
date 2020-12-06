<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#Auth
// Route::post('logout', function(){
//     if(Auth::guard('admin'))
//     return redirect()->route('auth.admin');
// })->name('logout.admin');
// Auth::guard('admin')->sess

Route::post('admin-logout', function(){// localhost::8000/emplooyee-logout
    \Auth::guard('admin')->logout();
    return redirect()->route('auth.admin');
})->name('admin.logout');
Route::post('employee-logout', function(){
    \Auth::guard('employee')->logout();
    return redirect()->route('auth.employee');
})->name('employee.logout');

Route::group(['prefix' => 'auth'], function(){
    Route::get('admin', [ AuthController::class, 'loginAdmin' ])->name('auth.admin');
    Route::get('pengurus', [ AuthController::class, 'loginEmployee' ])->name('auth.employee');
    Route::post('check-admin', [ AuthController::class, 'checkAdmin' ])->name('auth.check-admin');
    Route::post('check-employee', [ AuthController::class, 'checkEmployee' ])->name('auth.check-employee');
});


// Route::get('auth/admin','App\Http\Controllers\AuthController@loginAdmin');
// Route::get('auth/pengurus','App\Http\Controllers\AuthController@loginEmployee');
// Route::post('auth/check-admin','App\Http\Controllers\AuthController@checkAdmin');
// Route::post('auth/check-employee','App\Http\Controllers\AuthController@checkEmployee');

# Trash
Route::get('trash','App\Http\Controllers\TrashController@index');
Route::get('trash/data','App\Http\Controllers\TrashController@data');
Route::post('trash/store','App\Http\Controllers\TrashController@store');
Route::post('trash/edit','App\Http\Controllers\TrashController@edit');
Route::post('trash/update','App\Http\Controllers\TrashController@update');
Route::post('trash/delete','App\Http\Controllers\TrashController@delete');

# Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin'], 'except'=>['admin.logout']], function(){
    Route::get('/',[AdminController::class,'index']);
    Route::get('data',[AdminController::class,'data']);
    Route::post('store',[AdminController::class,'store']);
    Route::post('edit',[AdminController::class,'edit']);
    Route::post('update',[AdminController::class,'update']);
    Route::post('delete',[AdminController::class,'delete']);
});


# Bank
// Route::get('bank','App\Http\Controllers\BankController@index');
// Route::get('bank/data','App\Http\Controllers\BankController@data');
// Route::post('bank/store','App\Http\Controllers\BankController@store');
// Route::post('bank/edit','App\Http\Controllers\BankController@edit');
// Route::post('bank/update','App\Http\Controllers\BankController@update');
// Route::post('bank/delete','App\Http\Controllers\BankController@delete');

Route::group(['prefix' => 'bank', 'middleware' => ['auth:employee'], 'except'=>['employee.logout']], function(){
    Route::get('/',[AdminController::class,'index']);
    Route::get('data',[AdminController::class,'data']);
    Route::post('store',[AdminController::class,'store']);
    Route::post('edit',[AdminController::class,'edit']);
    Route::post('update',[AdminController::class,'update']);
    Route::post('delete',[AdminController::class,'delete']);
});

# Employee
Route::group(['prefix' => 'employee', 'middleware' => ['auth:employee'], 'except'=>['employee.logout']], function(){
    Route::get('',[EmployeeController::class,'index']);
    Route::get('data',[EmployeeController::class,'data']);
    Route::post('store',[EmployeeController::class,'store']);
    Route::post('edit',[EmployeeController::class,'edit']);
    Route::post('update',[EmployeeController::class,'update']);
    Route::post('delete',[EmployeeController::class,'delete']);
});
