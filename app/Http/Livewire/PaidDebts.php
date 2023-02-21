<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PaidDebts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public $transactions;
    public $debtors;
    public $from, $to;
    public $search;
    public  $user_id, $debtor_id, $received_amount, $transaction_type,  $transaction_remark, $transaction_id;



    public function mount()
    {
        $this->debtors = Debtor::orderBy('created_at', 'DESC')->get();
        $this->transactions = Transaction::where('transaction_type', 'debit')->orderBy('created_at', 'DESC')->get();
    }


    protected function rules()
    {
        $this->user_id = Auth::id();
        $this->transaction_type = 'debit';

        return [
            'received_amount' => 'required',
            'transaction_remark' => 'required',
            'debtor_id' => 'required|numeric|exists:debtors,id',
            'user_id' => 'required|numeric|exists:users,id',
            'transaction_type' => 'required'
        ];

    }


    public function addNew()
    {
        $this->resetInput();
    }
    

    public function create()
    {
        $validate = $this->validate();
        $debtor = Debtor::find($this->debtor_id);
        $debtor->update(['balance' => $debtor->balance + $validate['received_amount']]);
        Transaction::create($validate);
        $this->resetInput();
        $this->dispatchBrowserEvent('created', ['message' => 'оплата долга создан успешно!']);
    }


    public function resetInput()
    {
        $this->debtor_id = '';
        $this->received_amount = '';
        $this->transaction_remark = '';
    }


    public function close()
    {
        $this->resetInput();
    }


    public function edit(int $id)
    {
        $paid = Transaction::findOrFail($id);
        $this->transaction_id = $paid->id;
        $this->debtor_id = $paid->debtor_id;
        $this->received_amount = $paid->received_amount;
        $this->transaction_remark = $paid->transaction_remark;
    }


    public function update()
    {
        $validate = $this->validate();
        $transaction = Transaction::find($this->transaction_id);

        if($validate['received_amount'] > 0)
        {
            if($validate['received_amount'] > $transaction->received_amount){
                $increment = $validate['received_amount'] - $transaction->received_amount;
                $transaction->debtor->update(['balance' => $transaction->debtor->balance + $increment]);
            }
            elseif($validate['received_amount'] < $transaction->received_amount){
                $decrement = $transaction->received_amount - $validate['received_amount'];
                $transaction->debtor->update(['balance' => $transaction->debtor->balance - $decrement]);
            }
        }
        Transaction::where('id', $this->transaction_id)->update($validate);

        $this->dispatchBrowserEvent('updated', ['message' => 'оплата долга обновлено успешно!']);
        $this->resetInput();
    }


    public function deleteConfirm(int $id)
    {
        $this->transaction_id = $id;
        $this->dispatchBrowserEvent('delete-confirm');
    }


    public function delete()
    {
        $transaction = Transaction::findOrFail($this->transaction_id);
        $transaction->debtor->update(['balance' => $transaction->debtor->balance - $transaction->received_amount]);
        $transaction->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'оплата долга удалено успешно!']);
    }


    public function getBetweenTwoDate()
    {
       $this->transactions = Transaction::when($this->from, function($query, $from) {
            return $query->whereDate('created_at', '>=', $from)->where('transaction_type', 'debit');
        })->when($this->to, function($query, $to) {
            return $query->whereDate('created_at', '<=', $to)->where('transaction_type', 'debit');
        })->get();
    }


    public function search()
    {
        $this->transactions = Transaction::when($this->search, function($query) {
            return $query->where('transaction_type', 'debit')->search(trim($this->search));
        })->get();
    }

    public function render()
    {
        return view('livewire.transactions.payd-debts');
    }


}
