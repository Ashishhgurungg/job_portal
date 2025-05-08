<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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
        
        /* User cards */
        .users-container {
            margin-top: 2rem;
        }
        
        .user-card {
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
        
        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        
        .user-details {
            display: flex;
            flex-wrap: wrap;
        }
        
        .user-detail {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: flex-start;
            min-width: 250px;
            flex: 1;
            max-width: 50%;
            padding-right: 1rem;
        }
        
        .user-detail i {
            width: 1.5rem;
            color: #6b7280;
            margin-right: 0.5rem;
            margin-top: 0.25rem;
        }
        
        .delete-button {
            background-color: #ef4444;
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
        
        .delete-button:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }
        
        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        /* No users message */
        .no-users {
            background: white;
            border-radius: 0.5rem;
            padding: 3rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            text-align: center;
            color: #6b7280;
            font-size: 1.25rem;
            margin: 2rem 0;
        }
        
        .no-users i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
            display: block;
        }
        
        /* Pagination styling */
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
            .user-detail {
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
                        {{ __('Users') }}
                    </h2>
                </div>
            </div>
        </x-slot>
        
        <div class="container">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success animated opacity-0 delay-1">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error animated opacity-0 delay-1">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Stats -->
            <div class="stats-card animated opacity-0 delay-1">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-text">Total Users: {{ $total }}</div>
            </div>
            
            <!-- Search and Filter -->
            <div class="search-container animated opacity-0 delay-2">
                <form action="{{ url('/users') }}" method="get" class="search-form">
                    <select name="role" class="search-select">
                        <option value="" {{ $currentRoleFilter === null || $currentRoleFilter === '' ? 'selected' : '' }}>
                            All Roles
                        </option>
                        <option value="0" {{ $currentRoleFilter === '0' ? 'selected' : '' }}>User</option>
                        <option value="1" {{ $currentRoleFilter === '1' ? 'selected' : '' }}>Employer</option>
                    </select>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search by name" 
                        value="{{ $currentSearch }}" 
                        class="search-input"
                    >
                    <button type="submit" class="search-button">
                        <i class="fas fa-search mr-2"></i> Filter
                    </button>
                </form>
                <a href="{{ url('/users') }}" class="clear-filter">
                    <i class="fas fa-times-circle mr-1"></i> Clear filter
                </a>
            </div>
            
            <!-- Users List -->
            <div class="users-container animated opacity-0 delay-3">
                @forelse($users as $user)
                    <div class="user-card">
                        <div class="user-details">
                            <div class="user-detail">
                                <i class="fas fa-user"></i>
                                <div><strong>Name:</strong> {{ $user->name }}</div>
                            </div>
                            
                            <div class="user-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <div><strong>Address:</strong> {{ $user->address }}</div>
                            </div>
                            
                            <div class="user-detail">
                                <i class="fas fa-user-tag"></i>
                                <div>
                                    <strong>Role:</strong>
                                    <span class="inline-block bg-gray-100 rounded px-2 py-1 text-sm">
                                        @if($user->role == 0)
                                            <i class="fas fa-user mr-1 text-blue-500"></i> User
                                        @else
                                            <i class="fas fa-building mr-1 text-green-500"></i> Employer
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="user-detail">
                                <i class="fas fa-envelope"></i>
                                <div><strong>Email:</strong> {{ $user->email }}</div>
                            </div>
                            
                            <div class="user-detail">
                                <i class="fas fa-phone"></i>
                                <div><strong>Phone:</strong> {{ $user->phone }}</div>
                            </div>
                        </div>
                        
                        <a href="/delete-user/{{ $user->id }}" class="delete-button">
                            <i class="fas fa-trash-alt mr-2"></i> Delete
                        </a>
                    </div>
                @empty
                    <div class="no-users">
                        <i class="fas fa-user-slash"></i>
                        <p>No users found matching your criteria.</p>
                        <a href="{{ url('/users') }}" class="clear-filter">
                            <i class="fas fa-undo-alt mr-1"></i> Clear filters and try again
                        </a>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                {{ $users->links() }}
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
                
                // User card hover effect
                const userCards = document.querySelectorAll('.user-card');
                userCards.forEach(card => {
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
                    this.innerHTML = '<i class="fas fa-bolt mr-2"></i> Filter';
                });
                
                searchButton.addEventListener('mouseleave', function() {
                    this.innerHTML = '<i class="fas fa-search mr-2"></i> Filter';
                });
                
                // Delete button effect
                const deleteButtons = document.querySelectorAll('.delete-button');
                deleteButtons.forEach(button => {
                    button.addEventListener('mouseenter', function() {
                        this.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i> Delete';
                    });
                    
                    button.addEventListener('mouseleave', function() {
                        this.innerHTML = '<i class="fas fa-trash-alt mr-2"></i> Delete';
                    });
                });
            });
        </script>
    </x-app-layout>
</body>
</html>