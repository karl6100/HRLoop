<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserForm extends Component
{
public $user;

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
