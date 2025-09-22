<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.index'); // resources/views/admin/index.blade.php
});

Route::get('/admin/perfil', function () {
    return view('admin.profile'); // resources/views/admin/profile.blade.php
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
