<?php

use App\Livewire\EmployeeAttendanceCrud;
use App\Livewire\EmployeeCrud;
use App\Livewire\EmployeeLeaveCrud;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
    Route::get('/employees', EmployeeCrud::class)->name('employees.index');
    // Employee Attendance Routes
    Route::get('/attendance', EmployeeAttendanceCrud::class)->name('employee-attendances.index');
    // Employee Leave Routes
    Route::get('/leaves', EmployeeLeaveCrud::class)->name('employee-leaves.index');
    Route::resource('tasks', App\Http\Controllers\TaskController::class)->only('index', 'store');
});

require __DIR__ . '/auth.php';



