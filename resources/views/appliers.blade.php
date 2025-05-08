<x-app-layout>

<style>
/* Modern Job Applicants List Styling */

/* Page Layout & Typography */
body {
  font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f9fafb;
  padding: 20px;
  margin: 0;
}

h1 {
  font-size: 24px;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 24px;
  padding-bottom: 12px;
  border-bottom: 2px solid #e5e7eb;
}

/* Container */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
}

/* Table Styling */
table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  margin: 20px 0;
  font-size: 14px;
}

thead {
  background-color: #f8fafc;
}

th {
  text-align: left;
  padding: 12px 15px;
  font-weight: 600;
  color: #334155;
  border-bottom: 2px solid #e2e8f0;
  text-transform: uppercase;
  font-size: 12px;
  letter-spacing: 0.5px;
}

td {
  padding: 12px 15px;
  border-bottom: 1px solid #e2e8f0;
  vertical-align: middle;
}

tbody tr:hover {
  background-color: #f1f5f9;
  transition: background-color 0.2s ease;
}

/* Links */
a {
  color: #3b82f6;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.2s ease;
}

a:hover {
  color: #2563eb;
  text-decoration: underline;
}

/* Status Dropdown */
select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  width: 100%;
  padding: 8px 12px;
  border-radius: 6px;
  border: 1px solid #d1d5db;
  background-color: #fff;
  font-size: 14px;
  font-weight: 500;
  color: #1f2937;
  cursor: pointer;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%234b5563' viewBox='0 0 16 16'%3E%3Cpath d='M8 10.5l-4-4h8l-4 4z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 10px center;
  transition: border-color 0.2s ease;
}

select:disabled {
  background-color: #f3f4f6;
  color: #6b7280;
  cursor: not-allowed;
  opacity: 0.8;
}

/* Status Colors */
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

/* View Button */
.view-btn {
  display: inline-block;
  padding: 6px 12px;
  background-color: #f3f4f6;
  border-radius: 4px;
  color: #4b5563;
  font-weight: 500;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.2s ease;
}

.view-btn:hover {
  background-color: #e5e7eb;
  color: #111827;
  text-decoration: none;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 40px 0;
  color: #6b7280;
  font-style: italic;
}

/* Flash Messages */
.flash-message {
  padding: 12px 16px;
  margin-bottom: 20px;
  border-radius: 6px;
  background-color: #ebf5ff;
  border-left: 4px solid #3b82f6;
  color: #1e40af;
}

/* Responsive */
@media (max-width: 768px) {
  table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
  
  td, th {
    padding: 10px 12px;
  }
  
  h1 {
    font-size: 20px;
  }
}
</style>
<div>
    {{session('change')}}
</div>
<h1>Applicants list for: {{ $job->title }}</h1>

@if($applicants->isEmpty())
    <p>No applicants have applied for this job yet.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Applicant Name</th>
                <th>Resume</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicants as $applicant)
                <tr>
                    <td>{{ $applicant->user->name ?? 'N/A' }}</td>
                    <td>
                        @if($applicant->resume)
                            <a href="{{ asset('uploads/resumes/' . $applicant->resume) }}" target="_blank">View Resume</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <select name="status" id="status" disabled>
                            <option value="0" @if ($applicant->status == 0) selected @endif>Pending</option>
                            <option value="1" @if ($applicant->status == 1) selected @endif>Reviewing</option>
                            <option value="2" @if ($applicant->status == 2) selected @endif>Selected</option>
                            <option value="3" @if ($applicant->status == 3) selected @endif>Rejected</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('details', ['id' => $applicant->id]) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</x-app-layout>

