<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use Livewire\Component;
use Livewire\WithPagination;

class DebtorReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $debtors;


    public function mount()
    {
        $this->debtors = Debtor::with('transactions')->orderBy('created_at', 'desc')->get();
    }



    public function search()
    {
       $this->debtors = Debtor::when($this->search, function($query) {
            $query->where('name', 'like', '%'. $this->search.'%');
        })->get();
    }




    public function render()
    {
        return view('livewire.reports.debtor-report');
    }


}
