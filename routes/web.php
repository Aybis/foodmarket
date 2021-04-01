<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Api\MidtransController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
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

//Homepage
Route::get('/', function () {
    return redirect()->route('dashboard');
});

//Dashboard
Route::prefix('dashboard')->middleware(['auth:sanctum', 'admin'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('foods', FoodController::class);

    Route::get('transactions/{id}/status/{status}', [TransactionController::class, 'changeStatus'])->name('transactions.changeStatus');
    Route::resource('transactions', TransactionController::class);
    Route::resource('absensis', AbsensiController::class);
});

Route::resource('units', UnitController::class);
Route::get('units/list', [UnitController::class, 'getUnitAndSubUnit']);

// Midtrans related
Route::get('midtrans/success', [MidtransController::class, 'success']);
Route::get('midtrans/unfinish', [MidtransController::class, 'unfinish']);
Route::get('midtrans/error', [MidtransController::class, 'error']);

Route::get('test-api', [MidtransController::class, 'api']);

Route::get('/ui', function() {
    return view('ui.index');
});