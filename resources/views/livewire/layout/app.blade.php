<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Help Desk IT') }}</title>

        <!-- Styles -->
        @livewireStyles

        <!-- Tailwind CSS via CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>

    <body class="font-sans antialiased">
        @auth
            <!-- Navigation untuk user yang login -->
            <nav class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-2">
                                        <i class="fas fa-headset text-white"></i>
                                    </div>
                                    <span class="text-xl font-bold text-gray-800">Help Desk IT</span>
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('dashboard') }}"
                                   class="{{ request()->routeIs('dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Dashboard
                                </a>
                                @endif

                                <a href="{{ route('tickets') }}"
                                   class="{{ request()->routeIs('tickets') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Tickets
                                </a>

                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('users.index') }}"
                                   class="{{ request()->routeIs('users.index') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Users
                                </a>

                                <a href="{{ route('reports.index') }}"
                                   class="{{ request()->routeIs('reports.index') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Reports
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <div class="relative ml-3">
                                <div>
                                    <button type="button" class="flex items-center text-sm rounded-full focus:outline-none" id="user-menu-button">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <span class="ml-2">{{ auth()->user()->name }}</span>
                                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Dropdown menu -->
                                <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="user-menu">
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        @endauth

        <!-- Page Content -->
        <div class="@auth py-6 @endauth">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts

        <script>
            // Toggle dropdown user menu
            document.getElementById('user-menu-button').addEventListener('click', function() {
                document.getElementById('user-menu').classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const userMenu = document.getElementById('user-menu');
                const userMenuButton = document.getElementById('user-menu-button');

                if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                    userMenu.classList.add('hidden');
                }
            });
        </script>
    </body>
</html>
