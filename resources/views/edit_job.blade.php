<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job') }}
        </h2>
    </x-slot>

    <div class="job-form-container">
        <div class="form-card">
            <form action="/edit-job" method="post" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="id" value="{{ $job->id }}">
                
                <!-- Job Title -->
                <div class="form-group">
                    <label for="title">Job Title</label>
                    <input type="text" name="title" id="title" value="{{ $job->title }}" required>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Job Category -->
                <div class="form-group">
                    <label for="category">Job Category</label>
                    <select name="category" id="category" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Job Type -->
                <div class="form-group">
                    <label for="type">Job Type</label>
                    <input type="text" name="type" id="type" value="{{ $job->type }}">
                    @error('type')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="form-group">
                    <label for="description">Job Description</label>
                    <textarea id="description" name="description" required>{{ $job->description }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-row">
                    <!-- Salary -->
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <div class="input-icon">
                            <span class="icon">$</span>
                            <input type="number" id="salary" name="salary" value="{{ $job->salary }}" required>
                        </div>
                        @error('salary')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Deadline -->
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" id="deadline" name="deadline" value="{{ $job->deadline ?? '' }}" required>
                        @error('deadline')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-actions">
                    <input type="submit" name="edit" value="Update Job">
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Laravel-inspired form styling */
        .job-form-container {
            max-width: 800px;
            margin: 2rem auto;
        }
        
        .form-card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.15s ease-in-out;
            background-color: #fff;
        }
        
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .error {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon .icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
        }
        
        .input-icon input {
            padding-left: 2rem;
        }
        
        .form-actions {
            margin-top: 2rem;
            text-align: right;
        }
        
        input[type="submit"] {
            display: inline-block;
            background-color: #4299e1;
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }
        
        input[type="submit"]:hover {
            background-color: #3182ce;
        }
        
        /* Responsive styles */
        @media (max-width: 640px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .form-card {
                padding: 1.5rem;
            }
        }
        
        /* Override any existing styles */
        .font-semibold.text-xl.text-gray-800.leading-tight {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        
        /* App layout styling */
        x-app-layout {
            padding: 1.5rem;
            background-color: #f7fafc;
            min-height: 100vh;
            display: block;
        }
    </style>
</x-app-layout>