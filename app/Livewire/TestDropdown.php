<?php

namespace App\Livewire;

use Livewire\Component;

class TestDropdown extends Component
{
    public $selectedRole = '';
    public $roles = ['Admin', 'Editor', 'User'];

    public function render()
    {
        return view('livewire.test-dropdown');
    }
}
