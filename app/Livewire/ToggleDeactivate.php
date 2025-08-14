<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ToggleDeactivate extends Component
{
    public $userId;
    public $deactivate; // true = deactivated
    public $view;

    public function mount(User $user)
    {
        $this->userId = $user->id;
        $this->deactivate = (bool) $user->deactivate;
    }

    public function toggle()
    {
        $this->deactivate = !$this->deactivate;

        $user = User::find($this->userId);
        if ($user) {
            $user->deactivate = $this->deactivate;
            $user->save();

            session()->flash(
                'message',
                $this->deactivate
                    ? 'User deactivated successfully.'
                    : 'User activated successfully.'
            );
        }
    }

    public function render()
    {
        return view('livewire.toggle-deactivate');
    }
}
