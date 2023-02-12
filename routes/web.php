<?php

use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\TransactionController;
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

//homepage
Route::get('/', function () {
    return redirect()->route('dashboard');
    // return view('welcome');
});

//dashboard
Route::prefix('dashboard')
    ->middleware(['auth:sanctum', 'admin'])
    ->group(function(){
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('food', FoodController::class);

        Route::get('transactions/{id}/status/{status}', [TransactionController::class, 'changeStatus'])
            ->name('transactions.changeStatus');
        Route::resource('transactions', TransactionController::class);
    });

//Midtrans related
Route::get('midtrans/success', [MidtransController::class,'success']);
Route::get('midtrans/unfinish', [MidtransController::class,'unfinish']);
Route::get('midtrans/error', [MidtransController::class,'error']);

// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
