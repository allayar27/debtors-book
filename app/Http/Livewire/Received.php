<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class Received extends Component
{
    use WithPagination;

    public $select = '';
    public $debtors;

    public $currentPage = 1;

    public function render()
    {
        $this->debtors = Debtor::orderBy('id', 'DESC')->get();
        return view('livewire.received.received', [
            'transactions' => Transaction::where('transaction_type', 'r')->orderBy('id', 'DESC')->paginate(5)
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
