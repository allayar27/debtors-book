<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class DebtorPagination extends Component
{
    use WithPagination;

    public $searchTerm;
    public $currentPage = 1;


    public function render()
    {
        return view('livewire.debtor-pagination', [
            'debtors' => Debtor::where(function($sub_query) {
                $sub_query->where('name', 'like', '%'. $this->searchTerm.'%');
            })->orderBy('id', 'DESC')->paginate(7)
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
