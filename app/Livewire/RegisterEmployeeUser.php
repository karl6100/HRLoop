<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class RegisterEmployeeUser extends Component
{
    public $employee_id;
    public $email;
    public $password;

    public $employees;

    public string $mode;

    public function toggleMode()
    {
        $this->mode = $this->mode === 'view' ? 'edit' : 'view';
        Log::debug("Mode is now: " . $this->mode);
    }

    public function mount($mode)
    {
        Log::info("RegisterEmployeeUser mounted with mode: {$this->mode}");
        $this->mode = $mode;
        Log::info('RegisterEmployeeUser::mount() called');

        try {
            $this->employees = Employee::doesntHave('user')->get();
            Log::info('Employees fetched:', ['count' => $this->employees->count()]);
        } catch (\Exception $e) {
            Log::error('Error fetching employees in mount(): ' . $e->getMessage());
            $this->employees = collect(); // Set to empty collection to avoid breaking view
        }
    }

    public function register()
    {
        Log::info('RegisterEmployeeUser::register() called', [
            'employee_id' => $this->employee_id,
            'email' => $this->email
        ]);

        $this->validate([
            'employee_id' => 'required|exists:employees,id',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::defaults()],
        ]);

        try {
            $employee = Employee::findOrFail($this->employee_id);
            Log::info('Employee found:', ['id' => $employee->id]);

            $user = User::create([
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'employee_id' => $employee->id,
            ]);
            Log::info('User created:', ['id' => $user->id]);

            $user->assignRole('employee');
            Log::info('Role "employee" assigned to user');

            session()->flash('success', 'Employee registered successfully.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('Error in register(): ' . $e->getMessage());
            session()->flash('error', 'Something went wrong. Check logs.');
        }
    }

    public function render()
    {
        Log::info('RegisterEmployeeUser::render() called');
        return view('livewire.register-employee-user');
    }
}
