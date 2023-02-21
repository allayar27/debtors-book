<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selectedRows = [];
    public $selectPageRows = false;
    public $user;
    public $orderBy = 'ASC';
    public $perPage = 5;
    
    public function markAsRead($id)
    {
       Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
    }


    public function delete($id)
    {
        Auth::user()->notifications()->where('id', $id)->get()->first()->delete();
    }


    public function updatedSelectPageRows($value)
    {
        if($value) {
            $this->selectedRows = $this->notifications->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        }
        else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
       
    }


    public function getNotificationsProperty()
    {
       return Auth::user()->notifications()->orderBy('created_at', $this->orderBy)->paginate($this->perPage);
    }


    public function deleteSelectedRows()
    {
        Auth::user()->notifications()->whereIn('id', $this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'все выбранные успешно удалены.']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }


    public function MarkAsReadSelectedRows()
    {
        Auth::user()->unreadNotifications->whereIn('id', $this->selectedRows)->markAsRead();
        $this->dispatchBrowserEvent('MarkedAsRead', ['message' => 'все выбранные помечены, как прочитанное.']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }


    public function render()
    {
        $notifications = $this->notifications;
        return view('livewire.notifications.all-notifications', [
            'notifications' => $notifications
        ]);
    }

    
}
