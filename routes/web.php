<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth',/* 'verified'*/])
    ->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::get('/employee/{employee_id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employee/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::delete('/employee/{employee_id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});

// Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
// // Route::get('/employee', EmployeeIndex::class)->name('employee.index');
// Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
// // Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
// Route::get('/employee/{employee_id}', [EmployeeController::class, 'show'])->name('employee.show');
// Route::get('/employee/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
// // Route::put('/employee/{employee_id}', [EmployeeController::class, 'update'])->name('employee.update');
// Route::delete('/employee/{employee_id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
// // Route::get('/employee/search', [EmployeeController::class, 'search'])->name('employee.search');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
