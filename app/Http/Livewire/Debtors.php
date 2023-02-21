<?php

namespace App\Http\Livewire;

use App\Models\Debtor;
use Livewire\Component;
use Livewire\WithPagination;

class Debtors extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public $search;
    public $debtor;
    public $debtor_id, $name, $phone, $reserve_phone;
    public $selectedRows = [];
    public $selectPageRows = false;
    public $orderBy = 'ASC';
    public $perPage = 5;


    public function resetInput()
    {
        $this->name = '';
        $this->phone = '';
        $this->reserve_phone = '';
    }


    public function addNew()
    {
        $this->resetInput();
    }


    public function create()
    {
        $validate = $this->validate([
            'name' => 'required',
            'phone' => 'required|integer|min:9|unique:debtors'
        ]);

        Debtor::create($validate);
        $this->resetInput();
        $this->dispatchBrowserEvent('hide-create-modal', ['message' => 'должник создан успешно!']);
    }


    public function close()
    {
        $this->resetInput();
    }

    public function showDebtorInfo(int $id)
    {
        $debtor = Debtor::findOrFail($id);
        $this->debtor_id = $debtor->id;
        $this->name = $debtor->name;
        $this->phone = $debtor->phone;
        $this->reserve_phone = $debtor->reserve_phone;
        
    }


    public function edit(int $id)
    {
        $this->resetInput();
        $debtor = Debtor::findOrFail($id);
        $this->debtor = $debtor;
        $this->name = $debtor->name;
        $this->phone = $debtor->phone;
        $this->reserve_phone = $debtor->reserve_phone;
    }



    public function update()
    {
        $validate = $this->validate([
            'name' => 'required',
            'phone' => 'required|integer|min:9|unique:debtors,phone,'.$this->debtor->id,
        ]);

        if($this->reserve_phone){
            $validate['reserve_phone'] = $this->reserve_phone;
        }
        
        Debtor::where('id', $this->debtor->id)->update($validate);

        $this->dispatchBrowserEvent('hide-edit-modal', ['message' => 'должник обновлено успешно!']);
        $this->resetInput();
    }


    public function deleteConfirm(int $id)
    {
        $this->debtor = $id;
        $this->dispatchBrowserEvent('delete-confirm');
    }


    public function delete()
    {
        $debtor = Debtor::findOrFail($this->debtor);
        $debtor->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'должник удалено успешно!']);
    }


    public function updatedSelectPageRows($value)
    {
        if($value) {
            $this->selectedRows = $this->debtors->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        }
        else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
       
    }


    public function getDebtorsProperty()
    {
       return Debtor::when($this->search, function($query, $search) {
            $query->where('name', 'like', '%'. $search.'%');
        })->orderBy('id', $this->orderBy)->paginate($this->perPage);
    }


    public function deleteSelectedRows()
    {
        Debtor::whereIn('id', $this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'все выбранные должники удалены.']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }
    

    public function render()
    {
        $debtors = $this->debtors;
        return view('livewire.debtors.debtors', [
            'debtors' => $debtors
        ]);
    }

   
}
