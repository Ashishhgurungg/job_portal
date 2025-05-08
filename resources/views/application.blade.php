<x-app-layout>
<link rel="stylesheet" href="{{ asset('css/application-styles.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Applications') }}
        </h2>
    </x-slot>
    
    <div class="applications-container">
        <h1 class="page-title">Applications</h1>
        
        <div class="applications-grid">
            @forelse($applications as $application)
                <div class="application-card">
                    <div class="card-left-section">
                        <span class="job-title">{{ $application->vacancy->title }}</span>
                        
                        <span class="section-title">Cover Letter:</span>
                        <div class="cover-letter">{{ $application->cover_letter }}</div>
                    </div>
                    
                    <div class="card-middle-section">
                        <span class="section-title">Resume:</span>
                        <div class="file-display">
                            @php
                                $filePath = asset('uploads/resumes/' . $application->resume);
                                $fileName = $application->resume;
                                $extension = pathinfo($application->resume, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($extension, ['jpeg', 'jpg', 'png']))
                                <img src="{{ $filePath }}" alt="Uploaded Image">
                                <div class="file-info">
                                    <span class="file-name">{{ $fileName }}</span>
                                    <a href="{{ $filePath }}" target="_blank" class="document-link">View</a>
                                </div>
                            @elseif(in_array($extension, ['pdf']))
                                <embed src="{{ $filePath }}" type="application/pdf" width="100%" height="150px">
                                <div class="file-info">
                                    <span class="file-name">{{ $fileName }}</span>
                                    <a href="{{ $filePath }}" target="_blank" class="document-link">View PDF</a>
                                </div>
                            @elseif(in_array($extension, ['doc', 'docx']))
                                <div class="file-info">
                                    <span class="file-icon">📄</span>
                                    <span class="file-name">{{ $fileName }}</span>
                                    <a href="{{ $filePath }}" target="_blank" class="document-link">Download</a>
                                </div>
                            @else
                                <div class="file-info">
                                    <span class="file-icon">📎</span>
                                    <span class="file-name">{{ $fileName }}</span>
                                    <a href="{{ $filePath }}" download class="document-link">Download</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-right-section">
                        <span class="section-title">Status:</span>
                        <select name="status" id="status-{{ $application->id }}" class="status-select
                            @if ($application->status == 0) status-pending
                            @elseif ($application->status == 1) status-reviewing
                            @elseif ($application->status == 2) status-selected
                            @elseif ($application->status == 3) status-rejected
                            @endif" disabled>
                            <option value="0" @if ($application->status == 0) selected @endif>Pending</option>
                            <option value="1" @if ($application->status == 1) selected @endif>Reviewing</option>
                            <option value="2" @if ($application->status == 2) selected @endif>Selected</option>
                            <option value="3" @if ($application->status == 3) selected @endif>Rejected</option>
                        </select>
                        <button onclick="confirmDelete({{ $application->id }})" class="flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p>You haven't applied for any jobs yet.</p>
                </div>
            @endforelse
        </div>
        
        <div class="pagination">
            {{ $applications->links() }}
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 90%; max-width: 400px; margin: 0 auto;">
            <div style="padding: 24px;">
                <h3 style="font-size: 18px; font-weight: 500; color: #1f2937; margin-bottom: 16px;">Confirm Deletion</h3>
                <p style="margin-bottom: 24px; color: #4b5563;">Are you sure you want to delete this Application? This action cannot be undone.</p>
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
        let deleteApplicationId = null;
        
        function confirmDelete(applicationId) {
            deleteApplicationId = applicationId;
            const modal = document.getElementById('deleteConfirmationModal');
            modal.classList.remove('hidden');
            return false;
        }
        
        function executeDelete() {
            if (deleteApplicationId) {
                window.location.href = '/delete-application/' + deleteApplicationId;
            }
        }
        
        function closeDeleteModal() {
            const modal = document.getElementById('deleteConfirmationModal');
            modal.classList.add('hidden');
            deleteApplicationId = null;
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