@if (Auth::check() && Auth::user()->role == 1)
<style>
    .session-message-container {
    width: 100%;
    max-width: 1280px;
    margin: 20px auto;
    padding: 0 16px;
}

@media (min-width: 640px) {
    .session-message-container {
        padding: 0 24px;
    }
}

@media (min-width: 1024px) {
    .session-message-container {
        padding: 0 32px;
    }
}

.session-message {
    background-color: #ffffff;
    border: 2px solid #10b981;
    border-radius: 6px;
    padding: 12px 16px;
    margin-bottom: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.session-message p {
    color: #047857;
    font-weight: 700;
    font-size: 1.125rem;
    line-height: 1.5;
    margin: 0;
}
</style>
<x-app-layout> 
<x-slot name="header"> 
    <h2 class="font-semibold text-xl text-gray-800 leading-tight"> 
        {{ __('Jobs Published By You') }} 
    </h2> 
</x-slot> 
<div class="session-message-container">
    @if(session('message'))
        <div class="session-message">
            <p>
                {{ session('message') }}
            </p>
        </div>
    @elseif(session('delete'))
    <div class="session-message delete">
        <p>{{ session('delete') }}</p>
    </div>
    @endif
</div>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @forelse($jobs as $job) 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
                    
                    <div class="mt-4">
                        <p><span class="font-medium">Salary:</span> <span class="text-green-600">Nrs {{ number_format($job->salary) }}</span></p>
                        <p><span class="font-medium">Type:</span> {{ $job->type }}</p>
                        <p><span class="font-medium">Category:</span> {{ $job->category->name }}</p>
                        <p><span class="font-medium">Deadline:</span> <span class="text-red-600">{{ $job->deadline->format('jS M Y') }}</span></p>
                        <p><span class="font-medium">Company:</span> {{ $job->user->name }}</p>
                        <p><span class="font-medium">Address:</span> {{ $job->user->address }}</p>
                        <p><span class="font-medium">Phone:</span> {{ $job->user->phone }}</p>
                        <p><span class="font-medium">Applicants:</span> {{ $job->applications_count }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <p><span class="font-medium">Description:</span></p>
                        <p class="mt-1">{{ $job->description }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <p><span class="font-medium">Company Description:</span></p>
                        <p class="mt-1">{{ $job->user->description }}</p>
                    </div>
                    
                    <!-- Fixed button display -->
                    <div class="flex mt-6 space-x-3">
                        <a href="{{ url('/edit-job/'.$job->id) }}" style="display: inline-flex; align-items: center; background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px; margin-right: 8px;" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit
                        </a>
                        <button onclick="confirmDelete({{ $job->id }})" style="display: inline-flex; align-items: center; background-color: #dc2626; color: white; padding: 8px 16px; border-radius: 4px; font-weight: bold; cursor: pointer; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px; margin-right: 8px;" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                        <a href="/appliers/{{ $job->id }}" style="display: inline-flex; align-items: center; background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px; margin-right: 8px;" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            Applicants
                        </a>
                    </div>
                </div>
            </div>
        @empty 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <p class="text-black-600"><b>No jobs found.</b></p>
                </div>
            </div>
        @endforelse 
        
        <div class="mt-4">
            {{ $jobs->links() }} 
        </div>
    </div>
</div>

<!-- Fixed Confirmation Modal with reduced width -->
<div id="deleteConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 90%; max-width: 400px; margin: 0 auto;">
        <div style="padding: 24px;">
            <h3 style="font-size: 18px; font-weight: 500; color: #1f2937; margin-bottom: 16px;">Confirm Deletion</h3>
            <p style="margin-bottom: 24px; color: #4b5563;">Are you sure you want to delete this job posting? This action cannot be undone.</p>
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
    let deleteJobId = null;
    
    function confirmDelete(jobId) {
        deleteJobId = jobId;
        const modal = document.getElementById('deleteConfirmationModal');
        modal.classList.remove('hidden');
        return false;
    }
    
    function executeDelete() {
        if (deleteJobId) {
            window.location.href = '/delete-job/' + deleteJobId;
        }
    }
    
    function closeDeleteModal() {
        const modal = document.getElementById('deleteConfirmationModal');
        modal.classList.add('hidden');
        deleteJobId = null;
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
<div>
    <p>
        Hello !!! Please don't try these kind of actions kindly !!!
    </p>
</div>
@endif