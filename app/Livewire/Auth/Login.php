<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.guest')]  // ← INI DI COMPONENT, BUKAN DI VIEW
class Login extends Component
{
    public LoginForm $form;

    public function mount()
    {
        // Jika sudah login, redirect berdasarkan role
        if (auth()->check()) {
            $this->redirectBasedOnRole();
        }
    }

    public function login()
    {
        try {
            $this->form->login();

            // Setelah login sukses, redirect berdasarkan role
            $this->redirectBasedOnRole();

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Error sudah di-handle oleh Livewire
        }
    }

    private function redirectBasedOnRole(): void
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $this->redirect('/dashboard', navigate: true);
        } else {
            $this->redirect('/tickets', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
