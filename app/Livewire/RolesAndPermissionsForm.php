<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsForm extends Component
{
    public Role $role;
    public $name;
    public $permissions = [];
    public $selectedPermissions = [];
    public $mode;

    public function mount(Role $role, $mode = 'create')
    {
        $this->role = $role;
        $this->mode = $mode;

        $this->permissions = Permission::all();

        if ($mode === 'edit' || $mode === 'view') {
            $this->initializeForEdit($role);
        }
    }

    public function initializeForEdit(Role $role)
    {
        $this->name = $role->name; // <-- this populates the input field
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
    }
    public function toggleEdit()
    {
        $this->mode = $this->mode === 'view' ? 'edit' : 'view';
    }

    public function cancel()
    {
        if ($this->mode === 'create') {
            return redirect()->route('roles.index');
        }
        if ($this->mode === 'edit') {
            $this->mode = 'view';
        }
    }

    public function rules()
    {
        return [
            'name' => $this->mode === 'create'
                ? 'required|string|unique:roles,name'
                : 'required|string|unique:roles,name,' . ($this->role->id ?? 'null'),
            'selectedPermissions' => 'array|min:1',
            'selectedPermissions.*' => 'string|exists:permissions,name',
        ];
    }

    public function save()
    {
        logger('Save method called', [
            'mode' => $this->mode,
            'name' => $this->name,
            'selectedPermissions' => $this->selectedPermissions,
            'roleId' => $this->role->id ?? null,
        ]);

        $validated = $this->validate();
        logger('Validation passed', $validated);

        if ($this->mode === 'create') {
            $this->role = Role::create(['name' => $this->name]);
            logger('Role created', ['id' => $this->role->id, 'name' => $this->role->name]);
        } else {
            $this->role->update(['name' => $this->name]);
            logger('Role updated', ['id' => $this->role->id, 'name' => $this->role->name]);
        }

        $this->role->syncPermissions($this->selectedPermissions);
        logger('Permissions synced', [
            'roleId' => $this->role->id,
            'permissions' => $this->selectedPermissions
        ]);

        $this->mode = 'view';
        session()->flash('success', 'Role permissions updated successfully.');
    }

    public function render()
    {
        return view('livewire.roles-and-permissions-form');
    }

    public function update()
    {
        logger('Update method called', [
            'name' => $this->name,
            'selectedPermissions' => $this->selectedPermissions,
            'roleId' => $this->role->id ?? null,
        ]);

        $validated = $this->validate();
        logger('Validation passed in update', $validated);

        $this->role->update(['name' => $this->name]);
        logger('Role updated', ['id' => $this->role->id, 'name' => $this->role->name]);

        $this->role->syncPermissions($this->selectedPermissions);
        logger('Permissions synced in update', [
            'roleId' => $this->role->id,
            'permissions' => $this->selectedPermissions
        ]);

        $this->mode = 'view';
        session()->flash('success', 'Role updated successfully.');
    }


    public function delete()
    {
        if ($this->role->id) {
            $this->role->delete();
            session()->flash('success', 'Role deleted successfully.');
            return redirect()->route('roles.index');
        } else {
            session()->flash('error', 'Role not found.');
        }
    }
}
