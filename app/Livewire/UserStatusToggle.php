<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserStatusToggle extends Component
{
    public $user;
    public $mode = 'view'; // Optional, depends on your setup

    public function mount(User $user, $mode = 'view')
    {
        $this->user = $user;
        $this->mode = $mode;
    }

    public function updatedUserDeactivate($value)
    {
        $this->user->update([
            'deactivate' => (bool) $value
        ]);
    }

    public function render()
    {
        return view('livewire.user-status-toggle');
    }
}
