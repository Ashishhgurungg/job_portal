<x-app-layout>
<!-- Add font awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Laravel Red Theme - Updated Applicant Details Page Styling */

/* Base styles & typography */
:root {
  --primary: #f05340; /* Laravel red */
  --primary-hover: #e0321c; /* Darker Laravel red */
  --gray-50: #f9fafb;
  --gray-100: #f3f4f6;
  --gray-200: #e5e7eb;
  --gray-300: #d1d5db;
  --gray-500: #6b7280;
  --gray-700: #374151;
  --gray-900: #111827;
}

body {
  font-family: 'Inter', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  line-height: 1.6;
  color: var(--gray-700);
  background-color: var(--gray-50);
  padding: 0;
  margin: 0;
}

/* Container */
.app-container {
  max-width: 1000px;
  margin: 40px auto;
  padding: 30px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

/* Page header */
h1 {
  font-size: 28px;
  font-weight: 700;
  color: var(--gray-900);
  margin-bottom: 30px;
  padding-bottom: 15px;
  border-bottom: 2px solid var(--gray-200);
  position: relative;
}

h1::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  width: 80px;
  height: 2px;
  background-color: var(--primary);
}

/* Applicant details card */
.applicant-card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
  padding: 25px;
  margin-bottom: 30px;
  border: 1px solid var(--gray-200);
}

/* Info rows */
.info-row {
  display: flex;
  margin-bottom: 16px;
  align-items: baseline;
}

.info-label {
  font-weight: 600;
  font-size: 15px;
  color: var(--gray-700);
  width: 180px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
}

.info-label svg {
  margin-right: 8px;
  color: var(--primary);
}

.info-value {
  flex-grow: 1;
  font-size: 15px;
}

/* Document viewer section */
.document-viewer {
  margin: 24px 0;
  border: 1px solid var(--gray-200);
  border-radius: 8px;
  overflow: hidden;
}

.document-header {
  background-color: var(--gray-100);
  padding: 12px 20px;
  border-bottom: 1px solid var(--gray-200);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.document-title {
  font-weight: 600;
  color: var(--gray-700);
  display: flex;
  align-items: center;
}

.document-title svg {
  margin-right: 8px;
}

.document-content {
  padding: 20px;
  background-color: #fff;
}

/* Image styling */
.resume-image {
  max-width: 100%;
  height: auto;
  border-radius: 4px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

/* PDF viewer */
.pdf-viewer {
  width: 100%;
  height: 500px;
  border: none;
  border-radius: 4px;
}

/* Cover letter section */
.cover-letter {
  margin-top: 24px;
  padding: 20px;
  background-color: var(--gray-50);
  border-radius: 8px;
  border-left: 4px solid var(--primary);
}

.cover-letter-header {
  font-weight: 600;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
}

.cover-letter-header svg {
  margin-right: 8px;
}

.cover-letter-content {
  font-size: 15px;
  line-height: 1.7;
  white-space: pre-line;
}

/* Form styling */
.status-form {
  margin-top: 30px;
  padding: 24px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
  border: 1px solid var(--gray-200);
}

.form-row {
  display: flex;
  align-items: center;
  margin-bottom: 16px;
}

.form-label {
  font-weight: 600;
  font-size: 15px;
  margin-right: 16px;
  display: flex;
  align-items: center;
}

.form-label svg {
  margin-right: 8px;
  color: var(--primary);
}

/* Status select styling */
select {
  appearance: none;
  -webkit-appearance: none;
  padding: 10px 16px;
  padding-right: 40px;
  font-size: 15px;
  border-radius: 6px;
  border: 1px solid var(--gray-300);
  background-color: white;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  cursor: pointer;
  color: var(--gray-700);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M8 10l-4-4h8l-4 4z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  background-size: 16px;
  transition: all 0.2s ease;
}

select:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(240, 83, 64, 0.15);
}

/* Status option colors */
select option[value="0"] {
  color: #f59e0b; /* Pending - amber */
}

select option[value="1"] {
  color: #3b82f6; /* Reviewing - blue */
}

select option[value="2"] {
  color: #10b981; /* Selected - green */
}

select option[value="3"] {
  color: #ef4444; /* Rejected - red */
}

/* Button styling */
button {
  background-color: var(--primary);
  color: white;
  border: none;
  border-radius: 6px;
  padding: 10px 20px;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s ease;
  display: flex;
  align-items: center;
  box-shadow: 0 2px 4px rgba(240, 83, 64, 0.2);
}

button:hover {
  background-color: var(--primary-hover);
}

button svg {
  margin-right: 8px;
}

/* File links */
.file-link {
  display: inline-flex;
  align-items: center;
  padding: 8px 16px;
  background-color: var(--gray-100);
  border-radius: 6px;
  color: var(--primary);
  font-weight: 500;
  text-decoration: none;
  transition: all 0.2s ease;
  margin-top: 12px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.file-link:hover {
  background-color: var(--gray-200);
  color: var(--primary-hover);
}

.file-link svg {
  margin-right: 8px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .app-container {
    padding: 20px;
    margin: 20px;
  }
  
  .info-row {
    flex-direction: column;
  }
  
  .info-label {
    width: 100%;
    margin-bottom: 4px;
  }
  
  .pdf-viewer {
    height: 400px;
  }
  
  .form-row {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .form-label {
    margin-bottom: 8px;
  }
  
  select {
    width: 100%;
    margin-bottom: 16px;
  }
  
  button {
    width: 100%;
    justify-content: center;
  }
  
}
</style>

<div class="app-container">
    <h1>Applicant Details</h1>
    
    @foreach ($applications as $application)
    <div class="applicant-card">
        <div class="info-row">
            <div class="info-label">
                <i class="fas fa-user"></i>
                <strong>Applicant Name:</strong>
            </div>
            <div class="info-value">{{ $application->user->name ?? 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">
                <i class="fas fa-map-marker-alt"></i>
                <strong>Applicant Address:</strong>
            </div>
            <div class="info-value">{{ $application->user->address ?? 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">
                <i class="fas fa-envelope"></i>
                <strong>Applicant Email:</strong>
            </div>
            <div class="info-value">{{ $application->user->email ?? 'N/A' }}</div>
        </div>
        
        @php
            $filePath = asset('uploads/resumes/' . $application->resume);
            $extension = pathinfo($application->resume, PATHINFO_EXTENSION);
        @endphp

        <div class="document-viewer">
            <div class="document-header">
                <div class="document-title">
                    <i class="fas fa-file-alt"></i>
                    Resume & Documents
                </div>
            </div>
            
            <div class="document-content">
                @if(in_array($extension, ['jpeg', 'jpg', 'png']))
                    <img src="{{ $filePath }}" alt="Uploaded Image" class="resume-image">
                @elseif(in_array($extension, ['pdf']))
                    <embed src="{{ $filePath }}" type="application/pdf" class="pdf-viewer">
                    <a href="{{ $filePath }}" target="_blank" class="file-link">
                        <i class="fas fa-external-link-alt"></i>
                        View PDF in Full Screen
                    </a>
                @elseif(in_array($extension, ['doc', 'docx']))
                    <a href="{{ $filePath }}" target="_blank" class="file-link">
                        <i class="fas fa-file-word"></i>
                        Download Document
                    </a>
                @else
                    <a href="{{ $filePath }}" download class="file-link">
                        <i class="fas fa-download"></i>
                        Download File
                    </a>
                @endif
            </div>
        </div>

        <div class="cover-letter">
            <div class="cover-letter-header">
                <i class="fas fa-quote-left"></i>
                Cover Letter
            </div>
            <div class="cover-letter-content">
                {{ $application->cover_letter }}
            </div>
        </div>
    </div>
    @endforeach
    
    <form action="/applicant-details" method="post" class="status-form">
        @csrf
        @foreach ($applications as $application)
            <input type="hidden" name="id" value="{{ $application->id }}">
        @endforeach
        
        <div class="form-row">
            <div class="form-label">
                <i class="fas fa-tasks"></i>
                <strong>Application Status:</strong>
            </div>
            <select name="status" id="status">
                <option value="0" @if ($application->status == 0) selected @endif>Pending</option>
                <option value="1" @if ($application->status == 1) selected @endif>Reviewing</option>
                <option value="2" @if ($application->status == 2) selected @endif>Selected</option>
                <option value="3" @if ($application->status == 3) selected @endif>Rejected</option>
            </select>
        </div>

        <button type="submit">
            <i class="fas fa-save"></i>
            Update Status
        </button>
    </form>
</div>
</x-app-layout>