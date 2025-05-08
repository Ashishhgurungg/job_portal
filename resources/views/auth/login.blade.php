<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Elevate Workforce Solutions</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            laravel: '#FF2D20',
            laravelDark: '#CB2115',
            midnight: '#121063',
            primary: '#FF2D20',
            secondary: '#2D3748'
          }
        }
      }
    }
  </script>
  
  <style>
    .laravel-gradient {
      background: linear-gradient(135deg, #FF2D20 0%, #FF6B4A 100%);
    }
    .form-input:focus {
      box-shadow: 0 0 0 3px rgba(255, 45, 32, 0.25);
      border-color: #FF2D20;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
  <!-- Header Section -->
  <header class="w-full bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
      <div class="flex items-center">
        <!-- Laravel-inspired logo -->
        <div class="h-8 w-8 rounded-full laravel-gradient flex items-center justify-center mr-3">
          <i class="fas fa-arrow-up text-white"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Elevate Workforce</h1>
      </div>
      <div>
        <a href="#" class="text-gray-600 hover:text-laravel transition-colors">
          <i class="fas fa-question-circle mr-1"></i> Help
        </a>
      </div>
    </div>
  </header>
  
  <!-- Login Form Section -->
  <main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Top decorative bar -->
        <div class="h-2 laravel-gradient"></div>
        
        <div class="p-8">
          <div class="flex justify-center mb-6">
            <div class="h-16 w-16 rounded-full laravel-gradient flex items-center justify-center">
              <i class="fas fa-user-lock text-2xl text-white"></i>
            </div>
          </div>
          
          <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Welcome Back</h2>
          
          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />
          
          <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Email Address -->
            <div class="mb-5">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Address
              </label>
              <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
              <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
            </div>
            
            <!-- Password -->
            <div class="mb-5">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-lock text-gray-400 mr-2"></i>Password
              </label>
              <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
              <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            </div>
            
            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
              <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-laravel focus:ring-laravel shadow-sm" name="remember">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
              </label>
              
              @if (Route::has('password.request'))
                <a class="text-sm text-laravel hover:text-laravelDark hover:underline transition-colors" href="{{ route('password.request') }}">
                  Forgot password?
                </a>
              @endif
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="w-full laravel-gradient text-white py-3 rounded-lg hover:opacity-90 transition-opacity flex items-center justify-center font-medium">
              <i class="fas fa-sign-in-alt mr-2"></i>
              Log in
            </button>
            
            <!-- Registration Link -->
            <div class="mt-6 text-center">
              <span class="text-gray-600 text-sm">Don't have an account?</span>
              <a href="{{ route('register') }}" class="text-sm text-laravel hover:text-laravelDark hover:underline transition-colors ml-1">
                Create one now
              </a>
            </div>
          </form>
        </div>
      </div>
      
      <!-- Security Message -->
      <div class="mt-6 text-center text-xs text-gray-500 flex items-center justify-center">
        <i class="fas fa-shield-alt mr-2"></i>
        Secure login protected by industry standard encryption
      </div>
    </div>
  </main>
  
  <!-- Footer -->
  <footer class="w-full bg-gray-800 py-5">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between">
      <div class="text-gray-400 text-sm mb-2 sm:mb-0">
        &copy; 2023 Elevate Workforce Solutions. All rights reserved.
      </div>
      <div class="flex space-x-4">
        <a href="#" class="text-gray-400 hover:text-white transition-colors">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="text-gray-400 hover:text-white transition-colors">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="#" class="text-gray-400 hover:text-white transition-colors">
          <i class="fab fa-facebook"></i>
        </a>
      </div>
    </div>
  </footer>
</body>
</html>