<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class UserPagination extends Component
{
    use WithPagination;

    public $searchTerm;

    public $currentPage = 1;

    public $orderBy = 'ASC';
    public $perPage = 5;
    
    



    
    
    public function render()
    {
        return view('livewire.user-pagination', [
            'users' => User::where(function($sub_query)
            {
                $sub_query->where('name', 'like', '%'. $this->searchTerm.'%');
                
            })->orderBy('id', $this->orderBy)->paginate($this->perPage)

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
