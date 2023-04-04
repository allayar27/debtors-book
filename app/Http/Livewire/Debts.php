<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
 

class Debts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'delete'];
    private $transactions;
    public $search;
    public $from, $to;
    public  $user_id, $debtor_id, $pay_amount,  $transaction_remark, $transaction_type, $transaction_id;
    



    protected function rules()
    {
        $this->user_id = Auth::id();
        $this->transaction_type = 'credit';
        return [
            'pay_amount' => 'required',
            'transaction_remark' => 'required',
            'debtor_id' => 'required|numeric|exists:debtors,id',
            'user_id' => 'required|numeric|exists:users,id',
            'transaction_type' => 'required'
        ];
    }


    public function resetInput()
    {
        $this->debtor_id = '';
        $this->pay_amount = '';
        $this->transaction_remark = '';
    }


    public function addNew()
    {
        $this->resetInput();
        $this->emit('open-create-modal');
    }


    public function create()
    {
        $validate = $this->validate();
        $debtor =  Debtor::find($this->debtor_id);
        $debtor->update(['balance' => $debtor->balance - $validate['pay_amount']]);
        Transaction::create($validate);
        $this->resetInput();
        $this->dispatchBrowserEvent('created', ['message' => 'долг создан успешно!']);
    }



    public function edit(int $id)
    {
        $this->resetInput();
        $debt = Transaction::findOrFail($id);
        $this->transaction_id = $debt->id;
        $this->debtor_id = $debt->debtor_id;
        $this->pay_amount = $debt->pay_amount;
        $this->transaction_remark = $debt->transaction_remark;
        $this->emit('open-edit-modal');
    }


    public function update()
    {
        $validate = $this->validate();

        $transaction = Transaction::find($this->transaction_id);
        if($validate['pay_amount'] > 0)
        {
            if($validate['pay_amount'] > $transaction->pay_amount){
                $increment = $validate['pay_amount'] - $transaction->pay_amount;
                $transaction->debtor->update(['balance' => $transaction->debtor->balance - $increment]);
            }
            elseif($validate['pay_amount'] < $transaction->pay_amount){
                $decrement = $transaction->pay_amount - $validate['pay_amount'];
                $transaction->debtor->update(['balance' => $transaction->debtor->balance + $decrement]);
            }

            Transaction::where('id', $this->transaction_id)->update($validate);

            $this->dispatchBrowserEvent('updated', ['message' => 'долг обновлено успешно!']);
            $this->resetInput();
        }
        else
        {
            $this->dispatchBrowserEvent('error updating', ['message' => 'сумма долга не может быть меньше меньше или равен 0!']);
            $this->resetInput();
        }

    }


    public function deleteConfirm(int $id)
    {
        $this->transaction_id = $id;
        $this->dispatchBrowserEvent('delete-confirm');
    }


    public function delete()
    {
        $transaction = Transaction::findOrFail($this->transaction_id);
        $transaction->debtor->update(['balance' => $transaction->debtor->balance + $transaction->pay_amount]);
        $transaction->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'долг удалено успешно!']);
    }



    public function getBetweenTwoDate()
    {
        $this->transactions = Transaction::when($this->from, function($query, $from) {
            return $query->whereDate('created_at', '>=', $from)->where('transaction_type', 'credit');
        })->when($this->to, function($query, $to) {
            return $query->whereDate('created_at', '<=', $to)->where('transaction_type', 'credit');
        });
    }


    public function search()
    {
        $this->transactions = Transaction::when($this->search, function($query) {
            $query->where('transaction_type', 'credit')->search(trim($this->search));
        });
    }


    public function render()
    {
        if ($this->transactions === null){
            $this->transactions = Transaction::where('transaction_type', 'credit')
                ->orderBy('created_at', 'DESC');
        }
        return view('livewire.transactions.debts', [
            'transactions' => $this->transactions->paginate(5),
            'debtors' => Debtor::orderBy('created_at', 'DESC')->get()
        ]);
    }


}
