<?php

use App\Http\Controllers\Admin\DebtorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReceivedController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Livewire\DebtorReport;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;








Route::get('/', [AuthController::class, 'index'])->name('/');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->prefix('home')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('homeAdmin');
    Route::resource('user', UserController::class);
    Route::resource('debtor', DebtorController::class);

    Route::get('/transaction', function(){
        $transactions = Transaction::all();
        return view('admin.transactions.daybook', compact('transactions'));
    })->name('transaction.index');

    Route::resource('payment', PaymentController::class);
    Route::resource('received', ReceivedController::class);
    //Route::get('/debtor-report', DebtorReport::class)->name('debtor-report');
    Route::get('/debtor-report', function() {
        return view('admin.transactions.debtor_report');
    })->name('debtor-report');
});