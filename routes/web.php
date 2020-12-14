<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\BankController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# Auth
Route::post('admin-logout', function(){
    \Auth::guard('admin')->logout();
    return redirect()->route('auth.admin');
})->name('admin.logout');
Route::post('employee-logout', function(){
    \Auth::guard('employee')->logout();
    return redirect()->route('auth.employee');
})->name('employee.logout');

# Login
Route::group(['prefix' => 'auth'], function(){
    Route::get('admin', [ AuthController::class, 'loginAdmin' ])->name('auth.admin');
    Route::get('pengurus', [ AuthController::class, 'loginEmployee' ])->name('auth.employee');
    Route::post('check-admin', [ AuthController::class, 'checkAdmin' ])->name('auth.check-admin');
    Route::post('check-employee', [ AuthController::class, 'checkEmployee' ])->name('auth.check-employee');
});

# Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin'], 'except'=>['admin.logout']], function(){
    Route::get('/',[AdminController::class,'index'])->name('admin.index');
    Route::get('data',[AdminController::class,'data'])->name('admin.data');
    Route::post('store',[AdminController::class,'store'])->name('admin.store');
    Route::post('edit',[AdminController::class,'edit'])->name('admin.edit');
    Route::post('update',[AdminController::class,'update'])->name('admin.update');
    Route::post('delete',[AdminController::class,'delete'])->name('admin.delete');
});

# Employee
Route::group(['prefix' => 'employee', 'middleware' => ['auth:admin'], 'except'=>['admin.logout']], function(){
    Route::get('/',[EmployeeController::class,'index'])->name('employee.index');
    Route::get('data',[EmployeeController::class,'data'])->name('employee.data');
    Route::post('store',[EmployeeController::class,'store'])->name('employee.store');
    Route::post('edit',[EmployeeController::class,'edit'])->name('employee.edit');
    Route::post('update',[EmployeeController::class,'update'])->name('employee.update');
    Route::post('delete',[EmployeeController::class,'delete'])->name('employee.delete');
});

# Customer
Route::group(['prefix' => 'customer', 'middleware' => ['auth:employee'], 'except'=>['employee.logout']], function(){
    Route::get('/',[CustomerController::class,'index'])->name('customer.index');
    Route::get('data',[CustomerController::class,'data'])->name('customer.data');
    Route::post('store',[CustomerController::class,'store'])->name('customer.store');
    Route::post('edit',[CustomerController::class,'edit'])->name('customer.edit');
    Route::post('update',[CustomerController::class,'update'])->name('customer.update');
    Route::post('delete',[CustomerController::class,'delete'])->name('customer.delete');
    Route::post('status',[CustomerController::class,'status'])->name('customer.status');
});

// Route::get('auth/admin','App\Http\Controllers\AuthController@loginAdmin');
// Route::get('auth/pengurus','App\Http\Controllers\AuthController@loginEmployee');
// Route::post('auth/check-admin','App\Http\Controllers\AuthController@checkAdmin');
// Route::post('auth/check-employee','App\Http\Controllers\AuthController@checkEmployee');

# Trash
Route::group(['prefix' => 'trash', 'middleware' => ['auth:admin'], 'except'=>['admin.logout']], function(){
    Route::get('/',[TrashController::class,'index'])->name('trash.index');
    Route::get('data',[TrashController::class,'data'])->name('trash.data');
    Route::post('store',[TrashController::class,'store'])->name('trash.store');
    Route::post('edit',[TrashController::class,'edit'])->name('trash.edit');
    Route::post('update',[TrashController::class,'update'])->name('trash.update');
    Route::post('delete',[TrashController::class,'delete'])->name('trash.delete');
});

# Bank
Route::group(['prefix' => 'bank', 'middleware' => ['auth:admin'], 'except'=>['admin.logout']], function(){
    Route::get('/',[BankController::class,'index'])->name('bank.index');
    Route::get('data',[BankController::class,'data'])->name('bank.data');
    Route::post('store',[BankController::class,'store'])->name('bank.store');
    Route::post('edit',[BankController::class,'edit'])->name('bank.edit');
    Route::post('update',[BankController::class,'update'])->name('bank.update');
    Route::post('delete',[BankController::class,'delete'])->name('bank.delete');
});

# Saving
Route::group(['prefix' => 'saving', 'middleware' => ['auth:employee'], 'except'=>['employee.logout']], function(){
    Route::get('/',[CustomerController::class,'index'])->name('saving.index');
    Route::get('data',[CustomerController::class,'data'])->name('saving.data');
    Route::post('store',[CustomerController::class,'store'])->name('saving.store');
    Route::post('edit',[CustomerController::class,'edit'])->name('saving.edit');
    Route::post('update',[CustomerController::class,'update'])->name('saving.update');
    Route::post('delete',[CustomerController::class,'delete'])->name('saving.delete');
});
