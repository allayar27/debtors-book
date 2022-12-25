<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use Illuminate\Auth\Events\Validated;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class Payment extends Component
{
    use WithPagination;

    public $currentPage = 1;

    public $selected = '';
    public $debtors;
    public $from;
    public $to;
    public $transactions;
    

    
    public function sort()
    {
        
        $transaction = Transaction::query();
        $this->transactions = $transaction;
        
        if(!empty($this->from) && !empty($this->to)) {

            $transaction = $transaction->whereBetween('created_at', [$this->from. '00:00:00', $this->to. '23:59:59']);
        }
        elseif(!empty($this->from))
        {
            $transaction = $transaction->whereDate('created_at', '>=', $this->from);
            //dd($transaction);
        }
        elseif(!empty($this->to))
        {
            $transaction = $transaction->whereDate('created_at', '<=', $this->to);
        }

        
    }
    
    
    public function render()
    {
        $this->debtors = Debtor::orderBy('id', 'DESC')->get();
        $this->transactions = Transaction::where('transaction_type', 'p')->orderBy('id', 'DESC')->get();
        return view('livewire.payments.payment');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function() {
            return $this->currentPage;
        });
    }
}
