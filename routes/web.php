<?php

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#Auth
Route::get('auth/admin','App\Http\Controllers\AuthController@loginAdmin');
Route::get('auth/pengurus','App\Http\Controllers\AuthController@loginEmployee');
Route::post('auth/check-admin','App\Http\Controllers\AuthController@checkAdmin');
Route::post('auth/check-employee','App\Http\Controllers\AuthController@checkEmployee');

# Trash
Route::get('trash','App\Http\Controllers\TrashController@index');
Route::get('trash/data','App\Http\Controllers\TrashController@data');
Route::post('trash/store','App\Http\Controllers\TrashController@store');
Route::post('trash/edit','App\Http\Controllers\TrashController@edit');
Route::post('trash/update','App\Http\Controllers\TrashController@update');
Route::post('trash/delete','App\Http\Controllers\TrashController@delete');

# Admin
Route::get('admin','App\Http\Controllers\AdminController@index');
Route::get('admin/data','App\Http\Controllers\AdminController@data');
Route::post('admin/store','App\Http\Controllers\AdminController@store');
Route::post('admin/edit','App\Http\Controllers\AdminController@edit');
Route::post('admin/update','App\Http\Controllers\AdminController@update');
Route::post('admin/delete','App\Http\Controllers\AdminController@delete');

# Bank
Route::get('bank','App\Http\Controllers\BankController@index');
Route::get('bank/data','App\Http\Controllers\BankController@data');
Route::post('bank/store','App\Http\Controllers\BankController@store');
Route::post('bank/edit','App\Http\Controllers\BankController@edit');
Route::post('bank/update','App\Http\Controllers\BankController@update');
Route::post('bank/delete','App\Http\Controllers\BankController@delete');

# Employee
Route::get('employee','App\Http\Controllers\EmployeeController@index');
Route::get('employee/data','App\Http\Controllers\EmployeeController@data');
Route::post('employee/store','App\Http\Controllers\EmployeeController@store');
Route::post('employee/edit','App\Http\Controllers\EmployeeController@edit');
Route::post('employee/update','App\Http\Controllers\EmployeeController@update');
Route::post('employee/delete','App\Http\Controllers\EmployeeController@delete');
