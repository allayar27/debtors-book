<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class DebtorReport extends Component
{
    use WithPagination;

    public $search;
    public $currentPage = 1;
    
    public function render()
    {
        return view('livewire.debtor-report', [
            'transactions' => Transaction::where(function($q) {
                $q->search(trim($this->search));
            })->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }


    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function() {
            return $this->currentPage;
        });
    }

}
