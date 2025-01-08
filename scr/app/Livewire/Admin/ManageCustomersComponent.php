<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;




class ManageCustomersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagesize = 5;
    public function changepageSize($size)
    {
        $this->pagesize  = $size;
        $this->resetPage();
    }
    public function blockUser($userId)
    {
        $user = User::find($userId);
        $user->status = 0;  // Set status to 0 to block the user
        $user->save();
    }

    public function unblockUser($userId)
    {
        $user = User::find($userId);
        $user->status = 1;  // Set status to 1 to unblock the user
        $user->save();
    }

    public function render()
    {
        $users = User::paginate($this->pagesize);
        $this->resetPage();
        return view('livewire.admin.manage-customers-component', ['users' => $users]);
    }
}
