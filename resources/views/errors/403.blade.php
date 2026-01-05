<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - Help Desk IT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full text-center">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-ban text-red-600 text-3xl"></i>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Access Denied</h1>
            <p class="text-gray-600 mb-6">
                @if(auth()->check())
                    You are logged in as <span class="font-semibold">{{ auth()->user()->name }}</span> 
                    ({{ auth()->user()->role }}), but you don't have permission to access this page.
                @else
                    Please login to access this page.
                @endif
            </p>
            
            <div class="space-y-3">
                @if(auth()->check())
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" 
                           class="block w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-tachometer-alt mr-2"></i> Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('tickets') }}" 
                           class="block w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-ticket-alt mr-2"></i> Go to Tickets
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" 
                       class="block w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Go to Login
                    </a>
                @endif
                
                <a href="javascript:history.back()" 
                   class="block w-full bg-gray-200 text-gray-800 py-3 px-4 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Go Back
                </a>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    Need help? Contact your system administrator.
                </p>
            </div>
        </div>
    </div>
</body>
</html>