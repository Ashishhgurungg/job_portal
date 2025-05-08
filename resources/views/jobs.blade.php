<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Listings</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        :root {
            --laravel-red: #f05340;
            --laravel-dark: #ff2d20;
            --laravel-light: #fff1ef;
            --laravel-lighter: #ffebe8;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
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
        
        /* Stats card */
        .stats-card {
            background: white;
            border-radius: 0.5rem;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: inline-flex;
            align-items: center;
        }
        
        .stats-icon {
            background-color: var(--laravel-light);
            color: var(--laravel-red);
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.25rem;
        }
        
        .stats-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
        }
        
        /* Search filter */
        .search-container {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }
        
        .search-select, .search-input {
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            flex: 1;
            min-width: 200px;
        }
        
        .search-select:focus, .search-input:focus {
            outline: none;
            border-color: var(--laravel-red);
            box-shadow: 0 0 0 3px rgba(240, 83, 64, 0.2);
        }
        
        .search-button {
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
            min-width: 100px;
            justify-content: center;
        }
        
        .search-button:hover {
            background-color: var(--laravel-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(240, 83, 64, 0.2);
        }
        
        .search-button:active {
            transform: translateY(0);
        }
        
        .clear-filter {
            display: inline-flex;
            align-items: center;
            margin-left: 1rem;
            color: var(--laravel-red);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .clear-filter:hover {
            color: var(--laravel-dark);
            text-decoration: underline;
        }
        
        /* Job cards */
        /* Fixed: Changed to standard list layout instead of grid */
        .jobs-container {
            margin-top: 2rem;
        }
        
        .job-card {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-left: 4px solid var(--laravel-red);
            margin-bottom: 1.5rem;
            max-width: 100%;
        }
        
        .job-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        
        .job-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .job-title i {
            color: var(--laravel-red);
            margin-right: 0.5rem;
        }
        
        .job-details {
            display: flex;
            flex-wrap: wrap;
        }
        
        .job-detail {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: flex-start;
            min-width: 250px;
            flex: 1;
            max-width: 50%;
            padding-right: 1rem;
        }
        
        .job-detail i {
            width: 1.5rem;
            color: #6b7280;
            margin-right: 0.5rem;
            margin-top: 0.25rem;
        }
        
        .job-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 1.5rem 0;
        }
        
        .company-section {
            background-color: var(--laravel-lighter);
            margin: 1rem -1.5rem -1.5rem;
            padding: 1rem 1.5rem;
        }
        
        .company-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }
        
        .company-title i {
            color: var(--laravel-red);
            margin-right: 0.5rem;
        }
        
        .company-details {
            display: flex;
            flex-wrap: wrap;
        }
        
        .apply-button {
            background-color: var(--laravel-red);
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
            text-decoration: none;
        }
        
        .apply-button:hover {
            background-color: var(--laravel-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(240, 83, 64, 0.2);
        }
        
        .apply-button a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .apply-button i {
            margin-right: 0.5rem;
        }
        
        /* No jobs message */
        .no-jobs {
            background: white;
            border-radius: 0.5rem;
            padding: 3rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            text-align: center;
            color: #6b7280;
            font-size: 1.25rem;
            margin: 2rem 0;
        }
        
        .no-jobs i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
            display: block;
        }
        
        /* Fixed Pagination styling - Made pagination more visible in dark mode */
        .pagination {
            margin: 2rem 0;
            display: flex;
            justify-content: center;
        }
        
        .pagination nav {
            background: white;
            border-radius: 0.5rem;
            padding: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            min-width: 320px;
        }
        
        .pagination .flex.justify-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .pagination .text-gray-700 {
            color: #374151;
        }
        
        .pagination a, .pagination span {
            color: var(--laravel-red);
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
            margin: 0 0.125rem;
            display: inline-block;
            min-width: 2rem;
            text-align: center;
            font-weight: 500;
        }
        
        .pagination a:hover {
            background-color: var(--laravel-light);
        }
        
        .pagination .bg-gray-200 {
            background-color: var(--laravel-light);
            color: var(--laravel-dark);
        }
        
        /* Fix for dark mode pagination */
        @media (prefers-color-scheme: dark) {
            .pagination nav {
                background: #1f2937;
                border: 1px solid #374151;
            }
            
            .pagination .text-gray-700 {
                color: #f3f4f6;
            }
            
            .pagination a, .pagination span {
                color: var(--laravel-red);
            }
            
            .pagination .text-gray-500 {
                color: #9ca3af;
            }
            
            .pagination .bg-gray-200 {
                background-color: var(--laravel-red);
                color: white;
            }
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
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .job-detail {
                max-width: 100%;
            }
            
            .search-form {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-select, .search-input, .search-button {
                width: 100%;
                min-width: auto;
            }
            
            .clear-filter {
                margin: 1rem 0 0;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="header">
                <div class="header-content">
                    <h2 class="header-title font-semibold text-xl leading-tight">
                        {{ __('Jobs Listings') }}
                    </h2>
                </div>
            </div>
        </x-slot>
        
        <div class="container">
            <!-- Stats -->
            <div class="stats-card animated opacity-0 delay-1">
                <div class="stats-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stats-text">Total Jobs: {{$vacancy}}</div>
            </div>
            
            <!-- Search and Filter -->
            <div class="search-container animated opacity-0 delay-2">
                <form action="/jobs" method="get" class="search-form">
                    <select name="category" class="search-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="search" placeholder="Search job titles, keywords..." class="search-input">
                    <button type="submit" name="go" class="search-button">
                        <i class="fas fa-search mr-2"></i> Search
                    </button>
                </form>
                <a href="/jobs" class="clear-filter">
                    <i class="fas fa-times-circle mr-1"></i> Clear filters
                </a>
            </div>
            
            <!-- Jobs List -->
            <div class="animated opacity-0 delay-3">
                @forelse($jobs as $job)
                    <div class="job-card">
                        <h3 class="job-title">
                            <i class="fas fa-briefcase"></i> {{ $job->title }}
                        </h3>
                        
                        <div class="job-details">
                            <div class="job-detail">
                                <i class="fas fa-money-bill-wave"></i>
                                <div><strong>Salary:</strong> Nrs{{ $job->salary }}</div>
                            </div>
                            
                            <div class="job-detail">
                                <i class="fas fa-clock"></i>
                                <div><strong>Type:</strong> {{ $job->type }}</div>
                            </div>
                            
                            <div class="job-detail">
                                <i class="fas fa-calendar-alt"></i>
                                <div><strong>Deadline:</strong> {{ $job->deadline->format('jS M Y') }}</div>
                            </div>
                            
                            <div class="job-detail">
                                <i class="fas fa-tag"></i>
                                <div><strong>Category:</strong> {{ $job->category->name }}</div>
                            </div>
                        </div>
                        
                        <div class="job-detail" style="max-width: 100%;">
                            <i class="fas fa-align-left"></i>
                            <div><strong>Description:</strong> {{ $job->description }}</div>
                        </div>
                        
                        <div class="job-divider"></div>
                        
                        <div class="company-section">
                            <h4 class="company-title">
                                <i class="fas fa-building"></i> Company Details
                            </h4>
                            
                            <div class="company-details">
                                <div class="job-detail">
                                    <i class="fas fa-user"></i>
                                    <div><strong>Name:</strong> {{ $job->user->name }}</div>
                                </div>
                                
                                <div class="job-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div><strong>Address:</strong> {{ $job->user->address }}</div>
                                </div>
                                
                                <div class="job-detail">
                                    <i class="fas fa-phone"></i>
                                    <div><strong>Phone:</strong> {{ $job->user->phone }}</div>
                                </div>
                            </div>
                            
                            <div class="job-detail" style="max-width: 100%;">
                                <i class="fas fa-file-alt"></i>
                                <div><strong>Description:</strong> {{ $job->user->description }}</div>
                            </div>
                            
                            @auth
                                @if(auth()->user()->role == 0)
                                    <button class="apply-button">
                                        <a href="/create-application/{{ $job->id }}">
                                            <i class="fas fa-paper-plane"></i> Apply Now
                                        </a>
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="no-jobs">
                        <i class="fas fa-search"></i>
                        <p>No jobs found matching your criteria.</p>
                        <a href="/jobs" class="clear-filter">
                            <i class="fas fa-undo-alt mr-1"></i> Clear filters and try again
                        </a>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination with fixed visibility -->
            <div class="pagination">
                {{ $jobs->links() }}
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Animate elements on page load
                const animatedElements = document.querySelectorAll('.animated');
                animatedElements.forEach(el => {
                    setTimeout(() => {
                        el.classList.remove('opacity-0');
                    }, 100);
                });
                
                // Job card hover effect
                const jobCards = document.querySelectorAll('.job-card');
                jobCards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.borderLeftWidth = '6px';
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        this.style.borderLeftWidth = '4px';
                    });
                });
                
                // Search form interactions
                const searchInput = document.querySelector('.search-input');
                const searchButton = document.querySelector('.search-button');
                
                searchInput.addEventListener('focus', function() {
                    this.style.boxShadow = '0 0 0 3px rgba(240, 83, 64, 0.2)';
                });
                
                searchInput.addEventListener('blur', function() {
                    this.style.boxShadow = 'none';
                });
                
                searchButton.addEventListener('mouseenter', function() {
                    this.innerHTML = '<i class="fas fa-bolt mr-2"></i> Search';
                });
                
                searchButton.addEventListener('mouseleave', function() {
                    this.innerHTML = '<i class="fas fa-search mr-2"></i> Search';
                });
                
                // Apply button effect
                const applyButtons = document.querySelectorAll('.apply-button');
                applyButtons.forEach(button => {
                    button.addEventListener('mouseenter', function() {
                        const link = this.querySelector('a');
                        link.innerHTML = '<i class="fas fa-check-circle"></i> Apply Now';
                    });
                    
                    button.addEventListener('mouseleave', function() {
                        const link = this.querySelector('a');
                        link.innerHTML = '<i class="fas fa-paper-plane"></i> Apply Now';
                    });
                });
            });
        </script>
    </x-app-layout>
</body>
</html>