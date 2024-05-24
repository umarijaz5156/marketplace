<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'users.id';
    public $sortAsc = false;
    public $filterDate;
    public $deleteConfirmModal = false;
    public $banModal = false;
    public $unbanModal = false;
    public $makeAdminModal = false;
    public $makeTicketManagerModal = false;
    public $makeAdminId;
    public $makeAdminStatus;
    public $makeTicketManagerId;
    public $makeTicketManagerStatus;

    // public $field = 'users.id';
    // public $sorting = 'desc';
    public $userId;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteUser($id)
    {
        $this->userId = $id;
        $this->deleteConfirmModal = true;
    }

    public function closeModal($modal)
    {
        $this->$modal = false;
    }

    public function banUserModal($id)
    {
        $this->userId = $id;
        $this->toggleModal();
    }

    public function unbanUserModal($id)
    {
        $this->userId = $id;
        $this->toggleModal2();
    }

    public function toggleModal()
    {
        $this->banModal = !$this->banModal;
    }

    public function toggleModal2()
    {
        $this->unbanModal = !$this->unbanModal;
    }

    public function toggleMakeAdminModal()
    {
        $this->makeAdminModal = !$this->makeAdminModal;
    }

    public function toggleMakeTicketManagerModal()
    {
        $this->makeTicketManagerModal = !$this->makeTicketManagerModal;
    }

    public function banUser()
    {
        $user = User::findOrFail($this->userId);

        $user->is_banned = true;
        $user->save();
        $this->toggleModal();
        session()->flash('success', 'User banned successfully');
        $this->userId = '';
    }

    public function unbanUser()
    {
        $user = User::findOrFail($this->userId);
        $user->is_banned = false;
        $user->save();
        $this->toggleModal2();
        session()->flash('success', 'User unBanned successfully');
        $this->userId = '';
    }

    // start make user as an admin
    public function makeAdminModalFun($user_id, $status)
    {
        $this->makeAdminId = $user_id;
        $this->makeAdminStatus = $status;
        $this->toggleMakeAdminModal();
    }

    public function makeAdmin()
    {
        $user = User::findOrFail($this->makeAdminId);
        $user->is_admin = !$this->makeAdminStatus;
        $user->save();

        $this->makeAdminId = "";
        $this->makeAdminStatus = "";
        $this->toggleMakeAdminModal();
    }
    // end make user as an admin

    // start make user as an ticket manager
    public function makeTicketManagerModalFun($user_id, $status)
    {
        $this->makeTicketManagerId = $user_id;
        $this->makeTicketManagerStatus = $status;
        $this->toggleMakeTicketManagerModal();
    }

    public function makeTicketManager()
    {
        $user = User::findOrFail($this->makeTicketManagerId);
        $user->is_ticket_manager = !$this->makeTicketManagerStatus;
        $user->save();
        $this->makeTicketManagerId = "";
        $this->makeTicketManagerStatus = "";
        $this->toggleMakeTicketManagerModal();
    }
    // end make user as an ticket manager
    public function delete() {
        User::find($this->userId)->delete();
        session()->flash('success', 'User deleted successfully');
        $this->userId = '';
        $this->deleteConfirmModal = false;
    }

    public function filterBy($field)
    {
        $this->sortAsc = false;

        if(empty($field)) {
            $this->sortField = 'users.id';
        } else {
            $this->sortField = $field;
        }
    }

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }


    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::selectRaw('users.id, users.name,users.email, users.created_at,users.is_banned, users.is_admin, users.is_ticket_manager, users.email_verified_at')
            ->withCount('reviewsReceived as total_reviews')
            ->withCount('order as total_orders')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
            })
            ->where(function($query) {
                $query->when($this->filterDate == 1, function($query){
                    $query->whereDate('users.created_at','=',Carbon::yesterday());
                })
                ->when($this->filterDate == 2, function($query){
                    $query->whereBetween('users.created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                })
                ->when($this->filterDate == 3, function($query){
                    $query->whereMonth('users.created_at','=',Carbon::now()->subMonth());
                })
                ->when($this->filterDate == 4, function($query){
                    $query->whereYear('users.created_at','=',Carbon::now()->subYear());
                });
            })
            ->when($this->sortField, function($query) {
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            })
            // ->orderBy('users.id', 'DESC')
            ->paginate(20)
        ]);
    }
}
