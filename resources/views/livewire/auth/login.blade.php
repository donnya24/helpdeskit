<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-blue-50 to-purple-50">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-headset text-4xl text-white"></i>
                    </div>
                </div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Help Desk IT System
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Masuk dengan akun Anda
                </p>

                <!-- Demo Accounts Info -->
                <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100">
                    <p class="text-xs font-medium text-blue-800 mb-1">Akun Demo:</p>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            <span class="text-gray-700">admin@example.com</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            <span class="text-gray-700">user@example.com</span>
                        </div>
                        <div class="col-span-2 text-center">
                            <span class="text-gray-600">Password: </span>
                            <span class="font-medium">password</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Form -->
            <form class="mt-8 space-y-6" wire:submit="login">
                <div class="rounded-md shadow-sm space-y-4">
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-1 text-gray-400"></i> Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input
                                id="email"
                                wire:model="email"
                                type="email"
                                required
                                autofocus
                                class="pl-10 appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                placeholder="admin@example.com">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-lock mr-1 text-gray-400"></i> Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <input
                                id="password"
                                wire:model="password"
                                type="password"
                                required
                                class="pl-10 appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input
                            id="remember"
                            wire:model="remember"
                            type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        <span wire:loading.remove wire:target="login">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Sistem
                        </span>
                        <span wire:loading wire:target="login">
                            <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                        </span>
                    </button>
                </div>

                <!-- Info -->
                <div class="text-center">
                    <p class="text-xs text-gray-500 mt-4">
                        Sistem ini hanya untuk penggunaan internal.
                        Hubungi admin jika lupa password.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
