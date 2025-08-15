<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsForm extends Component
{
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
        if ($this->mode === 'view') {
            return redirect()->route('users.index');
        } elseif ($this->mode === 'edit') {
            $this->mode = 'view'; // Just go back to view mode
        }
    }

    public function mount(Role $roles)
    {
        $this->roles = $roles;
        $this->roles = Role::all();
        $this->permissions = Permission::all();

        // Preload user role and permissions
        $this->selectedRole = $roles->roles->pluck('name')->first();
        $this->selectedPermissions = $roles->permissions->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.roles-and-permissions-form');
    }
}
