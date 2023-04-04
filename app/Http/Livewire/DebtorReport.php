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
            $this->debtors = Debtor::with('transactions')->orderBy('created_at', 'desc');
        }
        return view('livewire.reports.debtor-report', [
            'debtors' => $this->debtors->paginate(7)
        ]);
    }


}
