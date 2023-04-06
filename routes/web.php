<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Livewire\DebtorHistory;
use App\Http\Livewire\DebtorReport;
use App\Http\Livewire\Debtors;
use App\Http\Livewire\Debts;
use App\Http\Livewire\Home;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\PaidDebts;
use App\Http\Livewire\TransactionHistory;
use App\Http\Livewire\UserProfile;
use App\Http\Livewire\Users;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'index'])->name('/');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/forgot', [AuthController::class, 'showForgotForm'])->name('forgot');
    Route::post('/forgot_process', [AuthController::class, 'forgot'])->name('forgot_process');

});

Route::middleware('auth')->prefix('home')->group(function () {

    Route::get('/', Home::class)->name('dashboard');
    Route::get('/transactions_history', TransactionHistory::class)->name('transaction-history');
    Route::get('debtor_history/{id}', DebtorHistory::class)->name('debtor-history');
    Route::get('/debtor_report', DebtorReport::class)->name('debtor-report');
    Route::get('/debtors', Debtors::class)->name('debtors');
    Route::get('/users', Users::class)->name('users');
    Route::get('/debts', Debts::class)->name('debts');
    Route::get('/paid_debts', PaidDebts::class)->name('paid-debts');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/user/profile', UserProfile::class)->name('user.profile');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


