<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>Elevate Workforce Solutions | Professional Talent Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Vite: Styles & JS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom CSS / Animations -->
        <style>
            :root {
                --primary: #ff2d20; /* Laravel red */
                --primary-dark: #e52b1c;
                --secondary: #3b3b3b;
                --accent: #fd7e14; /* Orange accent */
                --accent-dark: #e67510;
                --light: #f9f9f9;
                --dark: #222222;
                --gray: #777777;
            }

            /* Base Animations */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes slideIn {
                from { transform: translateX(-20px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
            
            /* Animation Classes */
            .animate-fadeIn {
                animation: fadeIn 0.8s ease-out forwards;
            }
            
            .animate-slideIn {
                animation: slideIn 0.6s ease-out forwards;
            }
            
            .hover-lift {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .hover-lift:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            /* Theme toggle styles */
            .theme-toggle {
                cursor: pointer;
                padding: 5px 10px;
                border-radius: 50px;
                display: flex;
                align-items: center;
                transition: all 0.3s ease;
                margin-right: 15px;
            }

            .theme-toggle:hover {
                background: rgba(0, 0, 0, 0.05);
            }

            .dark .theme-toggle:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            /* Navigation styles */
            nav {
                background-color: white;
                padding: 0;
                position: sticky;
                top: 0;
                width: 100%;
                z-index: 1000;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                transition: all 0.3s ease;
            }

            .dark nav {
                background-color: var(--dark);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-container {
                width: 90%;
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 70px;
            }

            .logo {
                font-size: 22px;
                font-weight: 700;
                color: var(--primary);
                display: flex;
                align-items: center;
                text-decoration: none;
            }

            .dark .logo {
                color: white;
            }

            .logo i {
                margin-right: 10px;
                font-size: 24px;
            }

            .nav-links {
                display: flex;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .nav-links li {
                margin-left: 30px;
                position: relative;
            }

            .nav-links a {
                color: var(--dark);
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                padding: 25px 0;
                display: inline-block;
            }

            .dark .nav-links a {
                color: #e0e0e0;
            }

            .nav-links a:hover, .nav-links a.active {
                color: var(--primary);
            }

            .nav-links a::after {
                content: '';
                position: absolute;
                width: 0;
                height: 3px;
                background-color: var(--primary);
                bottom: 20px;
                left: 0;
                transition: width 0.3s ease;
            }

            .nav-links a:hover::after, .nav-links a.active::after {
                width: 100%;
            }

            /* Mobile navigation */
            .menu-toggle {
                display: none;
                background: transparent;
                border: none;
                color: var(--dark);
                font-size: 24px;
                cursor: pointer;
            }

            .dark .menu-toggle {
                color: white;
            }

            .mobile-nav {
                display: none;
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background: white;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                z-index: 999;
                transform: translateY(-10px);
                opacity: 0;
                transition: all 0.3s ease;
            }

            .dark .mobile-nav {
                background: var(--dark);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .mobile-nav.active {
                transform: translateY(0);
                opacity: 1;
            }

            .mobile-nav a {
                display: block;
                padding: 12px 0;
                color: var(--dark);
                text-decoration: none;
                font-weight: 500;
                border-bottom: 1px solid #eee;
                transition: all 0.3s ease;
            }

            .dark .mobile-nav a {
                color: #e0e0e0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .mobile-nav a:last-child {
                border-bottom: none;
            }

            .mobile-nav a:hover {
                color: var(--primary);
                padding-left: 10px;
            }

            /* User dropdown */
            .user-dropdown {
                position: relative;
            }
            
            .user-trigger {
                display: flex;
                align-items: center;
                cursor: pointer;
                padding: 6px 12px;
                border-radius: 50px;
                transition: all 0.3s ease;
                background: transparent;
                border: 1px solid #e5e7eb;
            }

            .dark .user-trigger {
                border-color: rgba(255, 255, 255, 0.2);
                color: white;
            }

            .user-trigger:hover {
                background: #f3f4f6;
            }

            .dark .user-trigger:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            .user-dropdown-menu {
                position: absolute;
                top: calc(100% + 10px);
                right: 0;
                background: white;
                width: 200px;
                border-radius: 8px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                visibility: hidden;
                opacity: 0;
                transform: translateY(10px);
                transition: all 0.3s ease;
                overflow: hidden;
            }

            .dark .user-dropdown-menu {
                background: #2d3748;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            }

            .user-dropdown-menu.active {  
                visibility: visible;
                opacity: 1;
                transform: translateY(0);
            }

            .user-dropdown-item {
                display: block;
                padding: 12px 16px;
                color: var(--dark);
                text-decoration: none;
                transition: all 0.2s ease;
            }

            .dark .user-dropdown-item {
                color: #e0e0e0;
            }

            .user-dropdown-item:hover {
                background: #f3f4f6;
                color: var(--primary);
            }

            .dark .user-dropdown-item:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            .logout-form {
                margin: 0;
                padding: 0;
            }

            /* Page header */
            .page-header {
                background: linear-gradient(to right, var(--primary), var(--primary-dark));
                padding: 50px 0;
                color: white;
                text-align: center;
            }

            .page-title {
                font-size: 32px;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .page-subtitle {
                font-size: 18px;
                opacity: 0.9;
            }

            /* Main content area */
            main {
                padding: 40px 0;
                min-height: calc(100vh - 70px - 350px); /* viewport height minus header and footer */
            }

            .container {
                width: 90%;
                max-width: 1200px;
                margin: 0 auto;
            }

            /* Responsive styles */
            @media (max-width: 992px) {
                .nav-links {
                    display: none;
                }

                .menu-toggle {
                    display: block;
                }

                .mobile-nav {
                    display: block;
                }
            }
        </style>
    </head>

    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Optional Page Heading -->
            @isset($header)
                <header class="page-header">
                    <div class="container">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Main Content -->
            <main class="flex-grow animate-fadeIn">
                {{ $slot }}
            </main>

            <!-- Footer -->
            @include('layouts.footer')
        </div>

        <!-- Interactive Elements Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile Menu Toggle
                const menuToggle = document.querySelector('.menu-toggle');
                const mobileNav = document.querySelector('.mobile-nav');
                
                if(menuToggle && mobileNav) {
                    menuToggle.addEventListener('click', function() {
                        mobileNav.classList.toggle('active');
                        menuToggle.querySelector('i').classList.toggle('fa-bars');
                        menuToggle.querySelector('i').classList.toggle('fa-times');
                    });
                }
                
                // User Dropdown Toggle
                const userTrigger = document.querySelector('.user-trigger');
                const userDropdown = document.querySelector('.user-dropdown-menu');
                
                if(userTrigger && userDropdown) {
                    userTrigger.addEventListener('click', function() {
                        userDropdown.classList.toggle('active');
                    });
                    
                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(event) {
                        if (!userTrigger.contains(event.target) && !userDropdown.contains(event.target)) {
                            userDropdown.classList.remove('active');
                        }
                    });
                }
                
                // Theme Toggle
                const themeToggle = document.querySelector('.theme-toggle');
                
                if(themeToggle) {
                    themeToggle.addEventListener('click', function() {
                        document.documentElement.classList.toggle('dark');
                        
                        // Save preference to localStorage
                        if(document.documentElement.classList.contains('dark')) {
                            localStorage.theme = 'dark';
                            themeToggle.querySelector('i').classList.replace('fa-moon', 'fa-sun');
                        } else {
                            localStorage.theme = 'light';
                            themeToggle.querySelector('i').classList.replace('fa-sun', 'fa-moon');
                        }
                    });
                    
                    // Set initial icon based on current theme
                    if(document.documentElement.classList.contains('dark')) {
                        themeToggle.querySelector('i').classList.replace('fa-moon', 'fa-sun');
                    }
                }
                
                // Check if dark mode is preferred
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                
                // Animation on scroll functionality
                const animateElements = document.querySelectorAll('.animate-on-scroll');
                
                function checkScroll() {
                    animateElements.forEach(element => {
                        const elementTop = element.getBoundingClientRect().top;
                        const elementVisible = 150;
                        
                        if (elementTop < window.innerHeight - elementVisible) {
                            element.classList.add('visible');
                        }
                    });
                }
                
                // Sticky navigation effect
                const nav = document.querySelector('nav');
                
                function handleScroll() {
                    if (window.scrollY > 100) {
                        nav.classList.add('nav-scrolled');
                    } else {
                        nav.classList.remove('nav-scrolled');
                    }
                    
                    // Check animations
                    checkScroll();
                }
                
                window.addEventListener('scroll', handleScroll);
                
                // Check animations on initial load
                checkScroll();
                
                // Add smooth scroll for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        
                        document.querySelector(this.getAttribute('href')).scrollIntoView({
                            behavior: 'smooth'
                        });
                    });
                });
            });
        </script>
    </body>
</html>