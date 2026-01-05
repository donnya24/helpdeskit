<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function mount()
    {
        // Cek autentikasi
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first.');
        }
        
        // Cek role - hanya admin yang boleh akses
        if (!Auth::user()->isAdmin()) {
            // Redirect user biasa ke tickets dengan pesan error
            session()->flash('error', 'Access denied. Only administrators can access dashboard.');
            return redirect('/tickets');
        }
    }

    public function render()
    {
        // Double check di render juga
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('livewire.access-denied');
        }
        
        // Stats untuk admin
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_tickets' => \App\Models\Ticket::count(),
            'open_tickets' => \App\Models\Ticket::where('status', 'open')->count(),
            'resolved_tickets' => \App\Models\Ticket::where('status', 'resolved')->count(),
        ];
        
        $recentTickets = \App\Models\Ticket::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'stats' => $stats,
            'recentTickets' => $recentTickets
        ]);
    }
}