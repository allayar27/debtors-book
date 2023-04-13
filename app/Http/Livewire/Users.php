<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Users extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public $search;
    public $orderBy = 'ASC';
    public $perPage = 5;
    public $from, $to;
    public $user;
    public $user_id , $name, $email, $password, $password_confirmation, $photo, $db_photo;
    public $selectedRows = [];
    public $selectPageRows = false;


    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->photo = '';
    }

    public function addNew()
    {
        $this->resetInput();
    }



    public function create()
    {
        $validate = $this->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if($this->photo) {
            $avatar = $this->photo->getClientOriginalName();
            Storage::putFileAs('/public/avatars', $this->photo, $avatar);
            $validate['avatar'] = $avatar;
        }
        
        $validate['password'] = bcrypt($validate['password']);
        
        User::create($validate);
        $this->dispatchBrowserEvent('close-modal', ['message' => 'пользователь создан успешно!']);
        $this->resetInput();

    }


    public function closeModal()
    {
        $this->resetInput();
    }


    public function edit(int $id)
    {
        $this->resetInput();
        $user = User::findOrFail($id);
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->db_photo = $user->avatar_url;
    }



    public function update()
    {
        $validate = $this->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->id,
        ]);

        if($this->photo) {
            Storage::disk('avatars')->delete($this->user->avatar);
            $avatar = $this->photo->getClientOriginalName();
            Storage::putFileAs('/public/avatars', $this->photo, $avatar);
            $validate['avatar'] = $avatar;
        }


        DB::table('users')->where('id', $this->user->id)->update($validate);
        $this->dispatchBrowserEvent('hide-edit-modal', ['message' => 'пользователь обновлено успешно!']);
        $this->resetInput();

    }


    public function deleteConfirm(int $id)
    {
        $this->user = $id;
        $this->dispatchBrowserEvent('delete-confirm');
    }

    

    public function delete() 
    {
       $user = User::findOrFail($this->user);
       $user->delete();
       $this->dispatchBrowserEvent('deleted', ['message' => 'пользователь удалено успешно!']);
    }

    public function updatedSelectPageRows($value)
    {
        if($value) {
            $this->selectedRows = $this->users->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        }
        else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }

    }

    public function getUsersProperty()
    {
       return User::when($this->search, function($query, $search) {
            $query->where('name', 'like', '%'. $search.'%');
        })->select(['id', 'avatar', 'name', 'email', 'created_at'])
        ->orderBy('id', $this->orderBy)->paginate($this->perPage);

    }

    public function deleteSelectedRows()
    {
        User::whereIn('id', $this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'все выбранные пользователи удалены.']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }

    public function render()
    {
        $users = $this->users;
        return view('livewire.users.users', ['users' => $users]);
    }

}
