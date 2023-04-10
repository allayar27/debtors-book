<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionHistory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $transactions;
    public $from, $to;
    public $search;


    
    public function getpaidDebts()
    {
        $this->transactions = Transaction::where('transaction_type', 'debit')->orderBy('created_at', 'desc');
    }


    public function getUnpaidDebts()
    {
        $this->transactions = Transaction::where('transaction_type', 'credit')->orderBy('created_at', 'desc');
    }

    
    public function getTodayTransactions()
    {
        $this->transactions = Transaction::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc');
    }


    public function getYesterdayTransactions()
    {
        $this->transactions = Transaction::whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc');
    }


    public function getCurrentMonthTransactions()
    {
        $this->transactions = Transaction::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }


    public function getPreviousMonthTransactions()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonth();
        $lastDayofPreviousMonth = Carbon::now()->subMonth()->endOfMonth();
        $this->transactions = Transaction::whereBetween('created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth]);
    }


    public function getLastSevenDaysTransactions()
    {
        $date = Carbon::today()->subDays(7);
        $this->transactions = Transaction::whereDate('created_at', '>=', $date);
    }


    public function getBetweenTwoDate()
    {
        $this->transactions = Transaction::when($this->from, function($query, $from) {
            return $query->whereDate('created_at', '>=', $from);
        })->when($this->to, function($query, $to) {
            return $query->whereDate('created_at', '<=', $to);
        });
    }


    public function search()
    {
        $this->transactions = Transaction::when($this->search, function($query) {
            $query->search(trim($this->search));
        });
    }


    public function render()
    {
        if($this->transactions === null){
           $this->transactions = Transaction::query()->withAggregate('debtor', 'name')->orderByDesc('created_at');
        }
        return view('livewire.transactions.transaction-history', [
            'transactions' => $this->transactions->paginate(5)
        ]);
    }
}
