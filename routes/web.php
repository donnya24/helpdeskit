<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Tickets;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard - pengecekan di component
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // Tickets - untuk semua user
    Route::get('/tickets', Tickets::class)->name('tickets');
    
    // Profile
    Route::view('/profile', 'profile')->name('profile');
    
    // Admin pages dengan pengecekan manual
    Route::get('/users', function () {
        // Cek role
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Admin access only.');
        }
        return view('admin.users.index');
    })->name('users');
    
    Route::get('/reports', function () {
        // Cek role
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Admin access only.');
        }
        return view('admin.reports.index');
    })->name('reports');
    
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});

Route::fallback(function () {
    return redirect('/login');
});