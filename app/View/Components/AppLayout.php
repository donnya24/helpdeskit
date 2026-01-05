<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Pastikan user sudah login sebelum render layout
        if (!auth()->check()) {
            // Jika belum login, gunakan guest layout
            return view('layouts.guest');
        }

        return view('livewire.layout.app');
    }
}
