<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job Vacancy</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        :root {
            --laravel-red: #f05340;
            --laravel-dark: #ff2d20;
            --laravel-light: #fff1ef;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
        }
        
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
            transition: all 0.3s ease;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            background-color: white;
            font-size: 1rem;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--laravel-red);
            box-shadow: 0 0 0 3px rgba(240, 83, 64, 0.2);
        }
        
        .icon {
            position: absolute;
            left: 0.75rem;
            top: 2.4rem;
            color: #9ca3af;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus + .icon,
        .form-group select:focus + .icon,
        .form-group textarea:focus + .icon {
            color: var(--laravel-red);
        }
        
        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .submit-btn {
            background-color: var(--laravel-red);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .submit-btn:hover {
            background-color: var(--laravel-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(240, 83, 64, 0.2);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        /* Header styling */
        .header {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .header-title {
            color: #111827;
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animated {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }
        .delay-7 { animation-delay: 0.7s; }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="header">
                <div class="header-content">
                    <h2 class="header-title font-semibold text-xl leading-tight">
                        {{ __('Add your job vacancy') }}
                    </h2>
                </div>
            </div>
        </x-slot>
        
        <div class="form-container">
            <form action="/add-job" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                
                <!-- Job Title -->
                <div class="form-group animated opacity-0 delay-1">
                    <label for="title">Job Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Senior Laravel Developer" required>
                    <i class="icon fas fa-briefcase"></i>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Job Category -->
                <div class="form-group animated opacity-0 delay-2">
                    <label for="category">Job Category</label>
                    <select id="category" name="category" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                    <i class="icon fas fa-tag"></i>
                    @error('type')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Job Type -->
                <div class="form-group animated opacity-0 delay-3">
                    <label for="type">Job Type</label>
                    <input type="text" id="type" name="type" placeholder="e.g. Full-time, Part-time, Remote">
                    <i class="icon fas fa-clock"></i>
                    @error('type')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="form-group animated opacity-0 delay-4">
                    <label for="description">Job Description</label>
                    <textarea id="description" name="description" placeholder="Describe the job responsibilities and requirements..." required>{{ old('description') }}</textarea>
                    <i class="icon fas fa-align-left" style="top: 2.5rem;"></i>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Salary -->
                <div class="form-group animated opacity-0 delay-5">
                    <label for="salary">Salary</label>
                    <input type="number" id="salary" name="salary" value="{{ old('salary') }}" placeholder="Monthly salary in NRS" required>
                    <i class="icon fas fa-dollar-sign"></i>
                    @error('salary')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Deadline -->
                <div class="form-group animated opacity-0 delay-6">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}" required>
                    <i class="icon fas fa-calendar-alt"></i>
                    @error('deadline')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="text-right animated opacity-0 delay-7">
                    <button type="submit" name="add" class="submit-btn">
                        <i class="fas fa-plus-circle mr-2"></i> ADD JOB
                    </button>
                </div>
            </form>
        </div>
    </x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on page load
            const animatedElements = document.querySelectorAll('.animated');
            animatedElements.forEach(el => {
                setTimeout(() => {
                    el.classList.remove('opacity-0');
                }, 100);
            });
            
            // Form field focus/blur effects
            const formFields = document.querySelectorAll('input, select, textarea');
            formFields.forEach(field => {
                field.addEventListener('focus', function() {
                    this.parentElement.querySelector('label').style.color = 'var(--laravel-red)';
                });
                
                field.addEventListener('blur', function() {
                    this.parentElement.querySelector('label').style.color = '#374151';
                });
                
                // Add subtle animation on interaction
                field.addEventListener('input', function() {
                    this.style.transition = 'background-color 0.3s';
                    this.style.backgroundColor = 'var(--laravel-light)';
                    setTimeout(() => {
                        this.style.backgroundColor = 'white';
                    }, 300);
                });
            });
            
            // Button hover animation
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.addEventListener('mouseenter', function() {
                this.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> ADD JOB';
            });
            
            submitBtn.addEventListener('mouseleave', function() {
                this.innerHTML = '<i class="fas fa-plus-circle mr-2"></i> ADD JOB';
            });
        });
    </script>
</body>
</html>