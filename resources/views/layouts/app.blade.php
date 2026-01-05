<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Help Desk IT') }}</title>

        <!-- Tailwind CSS via CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @livewireStyles

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>

    <body class="font-sans antialiased">
        <!-- Navigation hanya untuk user yang login -->
        @auth
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="{{ auth()->user()->isAdmin() ? route('dashboard') : route('tickets') }}" class="flex items-center">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-headset text-white"></i>
                                </div>
                                <span class="text-xl font-bold text-gray-800">Help Desk IT</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden sm:flex sm:ml-6 sm:space-x-8">
                            <!-- Dashboard link hanya untuk admin -->
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('dashboard') }}"
                               class="{{ request()->routeIs('dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            @endif

                            <!-- Tickets link untuk semua user -->
                            <a href="{{ route('tickets') }}"
                               class="{{ request()->routeIs('tickets') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-ticket-alt mr-2"></i> Tickets
                            </a>

                            <!-- Users & Reports hanya untuk admin -->
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('users') }}"
                               class="{{ request()->routeIs('users') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-users mr-2"></i> Users
                            </a>

                            <a href="{{ route('reports') }}"
                               class="{{ request()->routeIs('reports') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-chart-bar mr-2"></i> Reports
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <div class="relative">
                            <button type="button" class="flex items-center text-sm rounded-full" id="user-menu-button">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold mr-2">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden" id="user-menu">
                                <div class="px-4 py-2 border-b">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                    <p class="text-xs mt-1">
                                        <span class="px-2 py-1 rounded-full {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst(auth()->user()->role) }}
                                        </span>
                                    </p>
                                </div>
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-circle mr-2"></i> Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        @endauth

        <!-- Page Content -->
        <main class="@auth py-6 @endauth">
            <div class="@auth max-w-7xl mx-auto sm:px-6 lg:px-8 @endauth">
                <!-- Flash Messages -->
                @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <span class="text-sm text-red-800">{{ session('error') }}</span>
                    </div>
                </div>
                @endif

                @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-sm text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        @livewireScripts

        <script>
            // Toggle dropdown user menu
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenu = document.getElementById('user-menu');

            if (userMenuButton && userMenu) {
                userMenuButton.addEventListener('click', function() {
                    userMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (userMenu && userMenuButton &&
                        !userMenu.contains(event.target) &&
                        !userMenuButton.contains(event.target)) {
                        userMenu.classList.add('hidden');
                    }
                });
            }
        </script>
    </body>
</html>
