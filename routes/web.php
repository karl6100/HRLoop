<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Livewire\UserForm;
use App\Livewire\UserIndex;

use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth',/* 'verified'*/])
    ->name('dashboard');

Route::middleware(['auth','role:admin|hr'])->group(function () {
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::get('/employee/{employee_id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employee/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::delete('/employee/{employee_id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});

Route::get('/test-dropdown', function () {
    return view('test');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    Route::get('/users/{user}/edit', UserForm::class)->name('users.edit');
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/users/create', UserForm::class)->name('users.create');
    Route::post('/users/{user}/update', UserForm::class)->name('users.update');
    Route::post('/users/store', UserForm::class)->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
});


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
