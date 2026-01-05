<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

#[Layout('layouts.app')]
class Tickets extends Component
{
    public function mount()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
    }

    public function render()
    {
        $user = Auth::user();
        
        // Jika admin, tampilkan semua tickets
        // Jika user biasa, tampilkan hanya tickets miliknya
        if ($user->isAdmin()) {
            $tickets = Ticket::with('user')->latest()->get();
        } else {
            $tickets = Ticket::where('user_id', $user->id)->latest()->get();
        }

        return view('livewire.tickets', [
            'tickets' => $tickets,
            'user' => $user
        ]);
    }
}