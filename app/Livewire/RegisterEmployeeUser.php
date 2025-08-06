<?php

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class RegisterEmployeeUser extends Component
{
    public $employee_id;
    public $email;
    public $password;

    public $employees;

    public function mount()
    {
        // Only employees who are not yet users
        $this->employees = Employee::doesntHave('user')->get();
    }

    public function register()
    {
        $this->validate([
            'employee_id' => 'required|exists:employees,id',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::defaults()],
        ]);

        $employee = Employee::findOrFail($this->employee_id);

        $user = User::create([
            'name' => $employee->first_name . ' ' . $employee->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'employee_id' => $employee->id, // assuming this column exists in `users` table
        ]);

        // Optional: Assign default role
        $user->assignRole('employee'); // If you're using Spatie

        session()->flash('success', 'Employee registered successfully.');
        return redirect()->route('login'); // or wherever you want
    }

    public function render()
    {
        return view('livewire.register-employee-user');
    }
}

