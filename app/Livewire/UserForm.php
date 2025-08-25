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

    public function updatedUserDeactivate($value)
    {
        // Ensure boolean, then persist
        $this->user->deactivate = (bool) $value;
        $this->user->save();

        session()->flash(
            'message',
            $this->user->deactivate ? 'User deactivated successfully.' : 'User activated successfully.'
        );
    }

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

    public function mount(User $user)
    {
        $this->user = $user;
        $this->roles = Role::all();
        // Fetch permissions in descending order by name
        $this->permissions = Permission::orderBy('name', 'desc')->get();

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
        $this->user->save(); // saves name, email, is_active, etc.
        $this->user->syncRoles([$this->selectedRole]);
        $this->user->syncPermissions($this->selectedPermissions);

        session()->flash('message', 'Roles and permissions updated successfully.');
        $this->mode = 'view';
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}

// namespace App\Livewire;

// use Livewire\Component;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
// use App\Models\User;

// class UserForm extends Component
// {
//     public User $user;

//     public $roles;
//     public $permissions;

//     public $selectedRole;
//     public $inheritedPermissions = [];
//     public $extraPermissions = [];

//     public $mode = 'view';

//     public function mount(User $user)
//     {
//         $this->user = $user;
//         $this->roles = Role::all();
//         $this->permissions = Permission::all();

//         // Load user’s role
//         $this->selectedRole = $user->roles->pluck('name')->first();

//         // Load inherited from role
//         if ($this->selectedRole) {
//             $role = Role::where('name', $this->selectedRole)->first();
//             $this->inheritedPermissions = $role?->permissions->pluck('name')->toArray() ?? [];
//         }

//         // Load only the user's extra (direct) permissions
//         $this->extraPermissions = $user->permissions->pluck('name')->diff($this->inheritedPermissions)->toArray();
//     }

//     public function updatedSelectedRole($roleName)
//     {
//         // When role changes → reload inherited + reset extra if overlapping
//         $role = Role::where('name', $roleName)->first();

//         $this->inheritedPermissions = $role?->permissions->pluck('name')->toArray() ?? [];

//         // Remove inherited ones from extra to avoid duplicates
//         $this->extraPermissions = collect($this->extraPermissions)
//             ->diff($this->inheritedPermissions)
//             ->toArray();
//     }

//     public function save()
//     {
//         $this->user->save();

//         // Sync role
//         $this->user->syncRoles([$this->selectedRole]);

//         // Apply inherited + extra permissions
//         $finalPermissions = array_merge($this->inheritedPermissions, $this->extraPermissions);
//         $this->user->syncPermissions($finalPermissions);

//         session()->flash('message', 'Roles and permissions updated successfully.');
//         $this->mode = 'view';
//     }

//     public function toggleEdit()
//     {
//         $this->mode = $this->mode === 'view' ? 'edit' : 'view';
//     }

//     public function cancel()
//     {
//         $this->mode = 'view';
//     }

//     public function render()
//     {
//         return view('livewire.user-form');
//     }
// }