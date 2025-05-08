<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | Elevate Workforce Solutions</title>
  
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
    .progress-bar {
      height: 4px;
      background: #E5E7EB;
      width: 100%;
      overflow: hidden;
      border-radius: 2px;
    }
    .progress-bar-fill {
      height: 100%;
      background: linear-gradient(90deg, #FF2D20 0%, #FF6B4A 100%);
      transition: width 0.3s ease;
    }
    .file-input-wrapper {
      position: relative;
      overflow: hidden;
      display: inline-block;
    }
    .file-input-wrapper input[type=file] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    .form-section {
      transition: all 0.3s ease;
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
        <a href="/" class="text-gray-600 hover:text-laravel transition-colors">

          <i class="fas fa-arrow-up text-white"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Elevate Workforce</h1>
  </a>
      </div>
      <div>
        <a href="#" class="text-gray-600 hover:text-laravel transition-colors">
          <i class="fas fa-question-circle mr-1"></i> Help
        </a>
      </div>
    </div>
  </header>

  <!-- Registration Form Section -->
  <main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-3xl">
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Top decorative bar -->
        <div class="h-2 laravel-gradient"></div>
        
        <div class="p-8">
          <div class="flex justify-center mb-6">
            <div class="h-16 w-16 rounded-full laravel-gradient flex items-center justify-center">
              <i class="fas fa-user-plus text-2xl text-white"></i>
            </div>
          </div>
          
          <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Join Our Platform</h2>
          <p class="text-center text-gray-600 mb-8">Create your account and start your journey with us</p>
          
          <!-- Progress indicator -->
          <div class="mb-8">
            <div class="progress-bar">
              <div class="progress-bar-fill" style="width: 0%;" id="progress-indicator"></div>
            </div>
          </div>
          
          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registration-form">
            @csrf
            
            <!-- Form sections -->
            <div class="space-y-6">
              <!-- Personal Information Section -->
              <div class="form-section" id="section-1">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                  <div class="h-6 w-6 rounded-full laravel-gradient flex items-center justify-center mr-2">
                    <span class="text-white text-xs font-bold">1</span>
                  </div>
                  Personal Information
                </h3>
                
                <!-- Name -->
                <div class="mb-4">
                  <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user text-gray-400 mr-2"></i>Full Name
                  </label>
                  <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                    class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                  @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <!-- Email Address -->
                <div class="mb-4">
                  <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Address
                  </label>
                  <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                    class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                  @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <!-- Phone -->
                <div class="mb-4">
                  <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-phone text-gray-400 mr-2"></i>Phone Number
                  </label>
                  <input id="phone" type="text" name="phone" pattern="[0-9]{10,15}" value="{{ old('phone') }}" required autocomplete="phone" 
                    class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                  @error('phone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <!-- Gender -->
                <div class="mb-4">
                  <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-venus-mars text-gray-400 mr-2"></i>Gender
                  </label>
                  <select id="gender" name="gender" class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                    <option value="">{{ __('Prefer not to say') }}</option>
                    <option value="2">{{ __('Male') }}</option>
                    <option value="1">{{ __('Female') }}</option>
                    <option value="0">{{ __('Other') }}</option>
                  </select>
                  @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <div class="flex justify-end mt-6">
                  <button type="button" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors flex items-center justify-center font-medium next-btn">
                    Next: Account Details
                    <i class="fas fa-arrow-right ml-2"></i>
                  </button>
                </div>
              </div>
              
              <!-- Account Information Section -->
              <div class="form-section hidden" id="section-2">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                  <div class="h-6 w-6 rounded-full laravel-gradient flex items-center justify-center mr-2">
                    <span class="text-white text-xs font-bold">2</span>
                  </div>
                  Account Details
                </h3>
                
                <!-- Role -->
                <div class="mb-4">
                  <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user-tag text-gray-400 mr-2"></i>Account Type
                  </label>
                  <select id="role" name="role" required class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                    <!-- <option value="2">{{ __('Admin') }}</option> -->
                    <option value="1">{{ __('Employer') }}</option>
                    <option value="0" selected>{{ __('User') }}</option>
                  </select>
                  @error('role')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-lock text-gray-400 mr-2"></i>Password
                  </label>
                  <input id="password" type="password" name="password" required autocomplete="new-password" 
                    class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                  <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters long</p>
                  @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <!-- Confirm Password -->
                <div class="mb-4">
                  <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-lock text-gray-400 mr-2"></i>Confirm Password
                  </label>
                  <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                    class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                  @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <div class="flex justify-between mt-6">
                  <button type="button" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors flex items-center justify-center font-medium prev-btn">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Previous
                  </button>
                  <button type="button" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors flex items-center justify-center font-medium next-btn">
                    Next: Profile Details
                    <i class="fas fa-arrow-right ml-2"></i>
                  </button>
                </div>
              </div>
              
              <!-- Profile Information Section -->
              <div class="form-section hidden" id="section-3">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                  <div class="h-6 w-6 rounded-full laravel-gradient flex items-center justify-center mr-2">
                    <span class="text-white text-xs font-bold">3</span>
                  </div>
                  Profile Details
                </h3>
                
                <!-- Address -->
                <div class="mb-4">
                  <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>Address
                  </label>
                  <input id="address" type="text" name="address" value="{{ old('address') }}" required autocomplete="address" 
                    class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">
                  @error('address')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <!-- About -->
                <div class="mb-4">
                  <label for="about" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-info-circle text-gray-400 mr-2"></i>About You
                  </label>
                  <textarea id="about" name="about" required rows="4" 
                    class="form-input w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-800 focus:outline-none transition duration-150">{{ old('about') }}</textarea>
                  <p class="mt-1 text-xs text-gray-500">Tell us a little about yourself or your company</p>
                  @error('about')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <!-- Image -->
                <div class="mb-4">
                  <label for="image" class="block text-sm font-medium text-gray-700 mb-3">
                    <i class="fas fa-image text-gray-400 mr-2"></i>Profile Image
                  </label>
                  
                  <div class="flex items-center">
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mr-4 overflow-hidden" id="image-preview">
                      <i class="fas fa-user text-gray-400 text-2xl"></i>
                    </div>
                    
                    <div class="file-input-wrapper">
                      <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                        <i class="fas fa-upload mr-2"></i>
                        Upload photo
                      </button>
                      <input id="image" type="file" name="image" accept="image/*">
                    </div>
                  </div>
                  
                  <p class="mt-2 text-xs text-gray-500">Maximum file size: 2MB. Recommended: Square image (1:1 ratio)</p>
                  @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
                
                <div class="flex justify-between mt-6">
                  <button type="button" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors flex items-center justify-center font-medium prev-btn">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Previous
                  </button>
                  <button type="submit" id="submit-form" class="px-8 py-3 laravel-gradient text-white rounded-lg hover:opacity-90 transition-opacity flex items-center justify-center font-medium">
                    <i class="fas fa-check-circle mr-2"></i>
                    Complete Registration
                  </button>
                </div>
              </div>
            </div>
          </form>
          
          <!-- Login Link -->
          <div class="mt-6 text-center border-t border-gray-200 pt-6">
            <span class="text-gray-600">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-laravel hover:text-laravelDark hover:underline transition-colors ml-1">
              Log in here
            </a>
          </div>
        </div>
      </div>
      
      <!-- Security Message -->
      <div class="mt-6 text-center text-xs text-gray-500 flex items-center justify-center">
        <i class="fas fa-shield-alt mr-2"></i>
        Your personal information is secured with industry-standard encryption
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

  <!-- JavaScript for form steps and image preview -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Form section navigation
      const sections = document.querySelectorAll('.form-section');
      const nextButtons = document.querySelectorAll('.next-btn');
      const prevButtons = document.querySelectorAll('.prev-btn');
      const progressIndicator = document.getElementById('progress-indicator');
      const submitButton = document.getElementById('submit-form');
      const registrationForm = document.getElementById('registration-form');
      let currentSection = 0;
      
      function updateProgress() {
        const progressPercentage = (currentSection / (sections.length - 1)) * 100;
        progressIndicator.style.width = `${progressPercentage}%`;
      }
      
      function showSection(index) {
        sections.forEach((section, i) => {
          section.classList.toggle('hidden', i !== index);
        });
        currentSection = index;
        updateProgress();
      }
      
      nextButtons.forEach(button => {
        button.addEventListener('click', () => {
          if (currentSection < sections.length - 1) {
            showSection(currentSection + 1);
          }
        });
      });
      
      prevButtons.forEach(button => {
        button.addEventListener('click', () => {
          if (currentSection > 0) {
            showSection(currentSection - 1);
          }
        });
      });
      
      // Submit form button click handler
      submitButton.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default button behavior
        registrationForm.submit(); // Explicitly submit the form
      });
      
      // Image preview functionality
      const imageInput = document.getElementById('image');
      const imagePreview = document.getElementById('image-preview');
      
      imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
          const reader = new FileReader();
          
          reader.onload = function(e) {
            imagePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
          }
          
          reader.readAsDataURL(this.files[0]);
        }
      });
      
      // Initialize progress
      updateProgress();
    });
  </script>
</body>
</html>