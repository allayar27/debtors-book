<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class DebtorHistory extends Component
{
    public $debtor;
    public $search;
    public $from;
    public $to;
    
   
    public function mount($id)
    {
        $this->debtor = Debtor::findOrFail($id);
    }


    public function getPaidDebts()
    { 
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)
                                                 ->where('transaction_type', 'debit')
                                                 ->get();
    }


    public function getUnpaidDebts()
    {
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)
                                                 ->where('transaction_type', 'credit')
                                                 ->get();
    }

    
    public function getTodayTransactions()
    {
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)
                                                 ->whereDate('created_at', Carbon::today())
                                                 ->orderBy('created_at', 'desc')->get();
    }


    public function getYesterdayTransactions()
    {
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)
                                                 ->whereDate('created_at', Carbon::yesterday())
                                                 ->orderBy('created_at', 'desc')
                                                 ->get();
    }


    public function getCurrentMonthTransactions()
    {
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)
                                                 ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                                                 ->get();
    }


    public function getPreviousMonthTransactions()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonth();
        $lastDayofPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)
                                                 ->whereBetween('created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
                                                 ->get();
    }


    public function getLastSevenDaysTransactions()
    {
        $date = Carbon::today()->subDays(7);
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)
                                                 ->whereDate('created_at', '>=', $date)
                                                 ->get();
    }


    public function getBetweenTwoDate()
    {
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)->when($this->from, function($query, $from) {
             $query->whereDate('created_at', ">=", $from);
        })->when($this->to, function($query, $to) {
             $query->whereDate('created_at', "<=", $to);
        })->get();
    }


    public function searchByTransactionAmount()
    {
        $this->debtor->transactions = Transaction::whereBelongsTo($this->debtor)->when($this->search, function($query, $search) {
            $query->where('pay_amount', 'like', '%'. $search.'%')
                  ->orWhere('received_amount', 'like', '%'. $search.'%');
        })->get();
    }

    

    public function render()
    {
        return view('livewire.reports.debtor-history');
    }
}
