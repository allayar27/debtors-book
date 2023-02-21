<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public $image;
    public  $name, $email;
    public $current_password;
    public $password;


    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;

    }

    public function updatedImage()
    {
        $avatar = $this->image->getClientOriginalName();
        Storage::putFileAs('/public/avatars', $this->image, $avatar);
        auth()->user()->update(['avatar' => $avatar]);
        $this->dispatchBrowserEvent('avatar updated', ['message' => 'аватар пользователя обновлено успешно!']);
    }

    public function updateProfile()
    {
        $validate = $this->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->user()->id,
        ]);

        auth()->user()->update($validate);

        $this->emit('nameChanged', auth()->user()->name);
        $this->dispatchBrowserEvent('profileUpdated', ['message' => 'профиль обновлено успешно!']);
    }


    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password'
        ]);

        if(Hash::check($this->current_password, auth()->user()->password))
        {
            $user = User::find(auth()->user()->id);
            $user->password = $this->password;
            $user->save();

            $this->reset();
            $this->dispatchBrowserEvent('password changed', ['message' => 'пароль успешно изменено!']);
        }
        else{
            $this->reset();
            $this->dispatchBrowserEvent('error updating password', ['message' => 'действующий пароль введен неправильно!']);
        }
    }
    public function render()
    {
        return view('livewire.users.user-profile');
    }
}
