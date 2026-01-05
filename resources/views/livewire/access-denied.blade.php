<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-ban text-red-600 text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Access Denied</h2>
                    <p class="text-gray-600 mb-4">You don't have permission to access this page.</p>
                    <p class="text-sm text-gray-500 mb-6">Required role: <span class="font-semibold">Administrator</span></p>
                    <a href="{{ route('tickets') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-arrow-left mr-2"></i> Go to Tickets
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>