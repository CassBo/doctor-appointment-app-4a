<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DoctorController;

Route::redirect('/', '/admin');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/user/profile', [\Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('admin/roles', RoleController::class)->names('admin.roles');
    Route::resource('admin/users', UserController::class)->names('admin.users');
    Route::resource('admin/patients', PatientController::class)->names('admin.patients');
    Route::resource('admin/doctors', DoctorController::class)->names('admin.doctors');

    // Rutas para citas médicas y calendario
    Route::get('admin/appointments', function () {
        return view('admin.appointments.index');
    })->name('admin.appointments.index');

    Route::get('admin/calendar', function () {
        return view('admin.calendar.index');
    })->name('admin.calendar.index');

    Route::get('admin/support', function () {
        return view('admin.support.index');
    })->name('admin.support.index');
});
