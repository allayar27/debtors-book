<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class TransactionHistory extends Component
{
    public $transactions;
    public $from, $to;
    public $search;


    public function mount()
    {
        $this->transactions = Transaction::orderBy('created_at', 'desc')->get();
    }


    public function getpaidDebts()
    {
        $this->transactions = Transaction::where('transaction_type', 'debit')->orderBy('created_at', 'desc')->get();
    }


    public function getUnpaidDebts()
    {
        $this->transactions = Transaction::where('transaction_type', 'credit')->orderBy('created_at', 'desc')->get();
    }

    
    public function getTodayTransactions()
    {
        $this->transactions = Transaction::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get();
    }


    public function getYesterdayTransactions()
    {
        $this->transactions = Transaction::whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->get();
    }


    public function getCurrentMonthTransactions()
    {
        $this->transactions = Transaction::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
    }


    public function getPreviousMonthTransactions()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonth();
        $lastDayofPreviousMonth = Carbon::now()->subMonth()->endOfMonth();
        $this->transactions = Transaction::whereBetween('created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->get();
    }


    public function getLastSevenDaysTransactions()
    {
        $date = Carbon::today()->subDays(7);
        $this->transactions = Transaction::whereDate('created_at', '>=', $date)->get();
    }


    public function getBetweenTwoDate()
    {
        $this->transactions = Transaction::when($this->from, function($query, $from) {
            return $query->whereDate('created_at', '>=', $from);
        })->when($this->to, function($query, $to) {
            return $query->whereDate('created_at', '<=', $to);
        })->get();
    }


    public function search()
    {
        $this->transactions = Transaction::when($this->search, function($query) {
            $query->search(trim($this->search));
        })->get();
    }


    public function render()
    {
        return view('livewire.transactions.transaction-history');
    }
}
