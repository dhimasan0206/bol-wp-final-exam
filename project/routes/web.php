<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\TransactionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('memberships', MembershipController::class);
Route::resource('customers', CustomerController::class);
Route::resource('exchangerates', ExchangeRateController::class);
Route::get('transactions/report', [TransactionController::class, 'report'])->name('transactions.report');
Route::resource('transactions', TransactionController::class);