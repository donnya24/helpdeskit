<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
                <p class="text-sm text-gray-500">Role:
                    <span class="font-semibold {{ auth()->user()->isAdmin() ? 'text-purple-600' : 'text-blue-600' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Tickets -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg mr-4">
                            <i class="fas fa-ticket-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Tickets</p>
                            <p class="text-2xl font-bold">{{ $stats['total'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Open Tickets -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg mr-4">
                            <i class="fas fa-folder-open text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Open</p>
                            <p class="text-2xl font-bold">{{ $stats['open'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- In Progress -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                            <i class="fas fa-cog text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">In Progress</p>
                            <p class="text-2xl font-bold">{{ $stats['in_progress'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Resolved -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg mr-4">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Resolved</p>
                            <p class="text-2xl font-bold">{{ $stats['resolved'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Closed -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-gray-100 rounded-lg mr-4">
                            <i class="fas fa-archive text-gray-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Closed</p>
                            <p class="text-2xl font-bold">{{ $stats['closed'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Tickets -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Tickets</h2>
                </div>

                <div class="overflow-x-auto">
                    @if($recentTickets->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentTickets as $ticket)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ str_pad($ticket->id, 6, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $ticket->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($ticket->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $priorityColors = [
                                                'low' => 'bg-green-100 text-green-800',
                                                'medium' => 'bg-yellow-100 text-yellow-800',
                                                'high' => 'bg-orange-100 text-orange-800',
                                                'critical' => 'bg-red-100 text-red-800'
                                            ];
                                            $color = $priorityColors[$ticket->priority] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'open' => 'bg-blue-100 text-blue-800',
                                                'in_progress' => 'bg-yellow-100 text-yellow-800',
                                                'resolved' => 'bg-green-100 text-green-800',
                                                'closed' => 'bg-gray-100 text-gray-800'
                                            ];
                                            $statusColor = $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                            {{ str_replace('_', ' ', ucfirst($ticket->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $ticket->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-ticket-alt text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">No tickets found</p>
                        </div>
                    @endif
                </div>

                @if($recentTickets->count() > 0)
                <div class="px-6 py-4 border-t border-gray-200">
                    <a href="{{ route('tickets') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View all tickets →
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
