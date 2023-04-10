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
    private $debtors;


    public function search()
    {
       $this->debtors = Debtor::when($this->search, function($query) {
            $query->where('name', 'like', '%'. $this->search.'%');
        });
    }




    public function render()
    {
        if($this->debtors === null){
           $debtors = $this->debtors = Debtor::whereHas('transactions')->select(['id', 'name', 'balance']);
        }
        return view('livewire.reports.debtor-report', [
            'debtors' => $debtors->paginate(2)
        ]);
    }


}
