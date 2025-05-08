@if (Auth::check() && Auth::user()->role == 2)
<link rel="stylesheet" href="{{ asset('css/inquiry-styles.css') }}">
<x-app-layout>
    <x-slot name="header">
        <div class="header">
            <div class="header-content">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Inquiries') }}
                </h2>
            </div>
        </div>
    </x-slot>
    

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse($inquiries as $inquiry)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-semibold">{{ $inquiry->name }}</h3>
                                <p class="text-blue-600">{{ $inquiry->email }}</p>
                            </div>
                            <button onclick="confirmDelete({{ $inquiry->id }})" class="flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </div>
                        
                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <p class="whitespace-pre-line">{{ $inquiry->message }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-gray-600">No inquiries right now</p>
                    </div>
                </div>
            @endforelse
            
            <div class="mt-4">
                {{ $inquiries->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 90%; max-width: 400px; margin: 0 auto;">
            <div style="padding: 24px;">
                <h3 style="font-size: 18px; font-weight: 500; color: #1f2937; margin-bottom: 16px;">Confirm Deletion</h3>
                <p style="margin-bottom: 24px; color: #4b5563;">Are you sure you want to delete this inquiry? This action cannot be undone.</p>
                <div style="display: flex; justify-content: flex-end; gap: 16px;">
                    <button onclick="closeDeleteModal()" style="padding: 8px 16px; background-color: #e5e7eb; color: #111827; border-radius: 4px; font-weight: 500; cursor: pointer; border: none;">
                        No, Cancel
                    </button>
                    <button onclick="executeDelete()" style="padding: 8px 16px; background-color: #dc2626; color: white; border-radius: 4px; font-weight: 500; display: flex; align-items: center; cursor: pointer; border: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px; margin-right: 4px;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteInquiryId = null;
        
        function confirmDelete(inquiryId) {
            deleteInquiryId = inquiryId;
            const modal = document.getElementById('deleteConfirmationModal');
            modal.classList.remove('hidden');
            return false;
        }
        
        function executeDelete() {
            if (deleteInquiryId) {
                window.location.href = '/delete-inquiry/' + deleteInquiryId;
            }
        }
        
        function closeDeleteModal() {
            const modal = document.getElementById('deleteConfirmationModal');
            modal.classList.add('hidden');
            deleteInquiryId = null;
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteConfirmationModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>
@else
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
        <div class="flex items-center justify-center text-red-600 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h2 class="text-center text-xl font-bold text-gray-800 mb-4">Access Denied</h2>
        <p class="text-center text-gray-600">
            Hello! Please don't try these kind of actions kindly.
        </p>
        <div class="mt-6 text-center">
            <a href="/" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Go Back Home
            </a>
        </div>
    </div>
</div>
@endif