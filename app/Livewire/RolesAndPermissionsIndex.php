<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class RolesAndPermissionsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $searchQuery = '';

    public function performSearch()
    {
        $this->search = $this->searchQuery;
    }
    public int $perPage = 10;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // public function deleteUser($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     session()->flash('message', 'User deleted successfully.');
    // }

    public function render()
    {
        $roles = Role::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.roles-and-permissions-index', [
            'roles' => $roles
        ]);
    }
}
