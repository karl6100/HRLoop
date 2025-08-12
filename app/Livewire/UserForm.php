<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserForm extends Component
{
    public User $user;
    public $roles;
    public $permissions;

    public $selectedRole;
    public $selectedPermissions = [];

    public $mode = 'view';

    public function toggleEdit()
    {
        logger('toggleEdit clicked');
        $this->mode = $this->mode === 'view' ? 'edit' : 'view';
    }

    public function cancel()
    {
        if ($this->mode === 'create') {
            return redirect()->route('users.index');
        } elseif ($this->mode === 'edit') {
            $this->mode = 'view'; // Just go back to view mode
        }
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->roles = Role::all();
        $this->permissions = Permission::all();

        // Preload user role and permissions
        $this->selectedRole = $user->roles->pluck('name')->first();
        $this->selectedPermissions = $user->permissions->pluck('name')->toArray();
    }

    public function updatedSelectedRole($roleName)
    {
        if ($roleName) {
            $role = Role::where('name', $roleName)->first();
            $this->selectedPermissions = $role
                ? $role->permissions->pluck('name')->toArray()
                : [];
        }
    }

    public function save()
    {
        $this->user->syncRoles([$this->selectedRole]);
        $this->user->syncPermissions($this->selectedPermissions);
        session()->flash('message', 'Roles and permissions updated successfully.');
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
