<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>
    
    @if(Auth::check() && Auth::user()->role == 2)
    <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <form action="{{ route('jobs.deleteToday') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" id="delete-button" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md transition-colors duration-200 flex items-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Delete Today's Deadline Jobs
            </button>
        
            <!-- Confirmation Modal positioned near the button -->
            <div id="confirmationModal" class="hidden absolute top-full left-0 mt-2 z-50 w-72 md:w-80">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-red-200">
                    <div class="bg-red-100 p-3 border-b border-red-200">
                        <h3 class="text-lg font-medium text-red-800">Confirm Deletion</h3>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-700 mb-4">Are you sure you want to delete all jobs with today's deadline? This action cannot be undone.</p>
                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancelDelete" class="px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-md transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit" id="confirmDelete" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md transition-colors duration-200">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts Section -->
            @if(session('message') || session('success') || session('error') || session('log') || session('reg') || session('deleteInquiry') || session('deleteApp') || session('review') || session('successd') || session('successn'))
            <div class="mb-6">
                @if(session('success') || session('successd') || session('successn'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm" role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p>{{ session('success') }}{{ session('successd') }}{{ session('successn') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm" role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if(session('message') || session('log') || session('reg') || session('deleteInquiry') || session('deleteApp') || session('review'))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded shadow-sm" role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p>{{ session('message') }}{{ session('log') }}{{ session('reg') }}{{ session('deleteInquiry') }}{{ session('deleteApp') }}{{ session('review') }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif

            @if(Auth::check() && Auth::user()->role == 2)
            <!-- Stats Dashboard -->
            <div class="space-y-8">
                <!-- Users Statistics -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Users Statistics
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-6 rounded-lg shadow-sm border border-indigo-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-indigo-600">Normal Users</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $normalUsers }}</p>
                                    </div>
                                    <div class="bg-indigo-100 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-purple-50 to-indigo-50 p-6 rounded-lg shadow-sm border border-purple-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-purple-600">Employers</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $employers }}</p>
                                    </div>
                                    <div class="bg-purple-100 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-blue-50 to-teal-50 p-6 rounded-lg shadow-sm border border-blue-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-blue-600">Total Users</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $total }}</p>
                                    </div>
                                    <div class="bg-blue-100 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jobs and Applications Statistics -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Jobs and Applicants Statistics
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-6 rounded-lg shadow-sm border border-emerald-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-emerald-600">Total Jobs</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $jobs }}</p>
                                    </div>
                                    <div class="bg-emerald-100 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9.5 15v-3M14.5 15v-3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 p-6 rounded-lg shadow-sm border border-teal-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-teal-600">Total Applicants</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $applications }}</p>
                                    </div>
                                    <div class="bg-teal-100 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inquiries and Reviews Statistics -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            Inquiries and Reviews Statistics
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-amber-50 to-yellow-50 p-6 rounded-lg shadow-sm border border-amber-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-amber-600">Total Inquiries</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $inquiries }}</p>
                                    </div>
                                    <div class="bg-amber-100 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-6 rounded-lg shadow-sm border border-yellow-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-yellow-600">Total Reviews</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $reviews }}</p>
                                    </div>
                                    <div class="bg-yellow-100 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Delete confirmation modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.getElementById('delete-button');
            const modal = document.getElementById('confirmationModal');
            const cancelButton = document.getElementById('cancelDelete');
            const confirmButton = document.getElementById('confirmDelete');
            
            if (deleteButton) {
                deleteButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.classList.remove('hidden');
                });
            }
            
            if (cancelButton) {
                cancelButton.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });
            }
            
            // Click outside to close modal
            document.addEventListener('click', function(e) {
                if (modal && !modal.classList.contains('hidden')) {
                    // Check if the click is outside the modal and not on the delete button
                    if (!modal.contains(e.target) && e.target !== deleteButton) {
                        modal.classList.add('hidden');
                    }
                }
            });
            
            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>