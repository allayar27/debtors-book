<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $user;
    public $debtor; 
    public $transaction;

    
    public function mount()
    {
        $this->user = User::count();
        $this->debtor = new Debtor();
        $this->transaction = new Transaction();
    }

    
    
    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
