<?php

declare(strict_types=1);

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

    
    public function mount(User $user, Debtor $debtor, Transaction $transaction)
    {
        $this->user = $user->count();
        $this->debtor = $debtor;
        $this->transaction = $transaction;
        
    }

    
    
    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
