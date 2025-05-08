<nav class="main-nav">
    <div class="nav-container">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <i class="fas fa-chart-line"></i>
            <span>Elevate Workforce</span>
        </a>

        <!-- Desktop Navigation Menu -->
        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('jobs') }}" class="{{ request()->routeIs('jobs') ? 'active' : '' }}">
                    <i class="fas fa-briefcase mr-2"></i>Jobs
                </a>
            </li>
            @if(Auth::check() && Auth::user()->role == 1)
            <li>
                <a href="{{ route('addjobs') }}" class="{{ request()->routeIs('addjobs') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle mr-2"></i>Add Jobs
                </a>
            </li>
            <li>
                <a href="{{ route('myjob') }}" class="{{ request()->routeIs('myjob') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list mr-2"></i>My Jobs
                </a>
            </li>
            <li>
                <a href="{{ route('review') }}" class="{{ request()->routeIs('review') ? 'active' : '' }}">
                    <i class="fas fa-question-circle mr-2"></i>Give review
                </a>
            </li>
            @elseif(Auth::check() && Auth::user()->role == 0)
                <li>
                    <a href="{{ route('application') }}" class="{{ request()->routeIs('application') ? 'active' : '' }}">
                        <i class="fas fa-file-alt mr-2"></i>Jobs Applied
                    </a>
                </li>
                <li>
                <a href="{{ route('review') }}" class="{{ request()->routeIs('review') ? 'active' : '' }}">
                    <i class="fas fa-question-circle mr-2"></i>Give review
                </a>
            </li>
            @elseif(Auth::check() && Auth::user()->role == 2)
                <li>
                    <a href="{{ route('users') }}" class="{{ request()->routeIs('users') ? 'active' : '' }}">
                        <i class="fas fa-users mr-2"></i>Users List
                    </a>
                </li>
                <li>
                    <a href="{{ route('inquiry') }}" class="{{ request()->routeIs('inquiry') ? 'active' : '' }}">
                        <i class="fas fa-question-circle mr-2"></i>Inquiries
                    </a>
                </li>
                <li>
                    <a href="{{ route('reviews') }}" class="{{ request()->routeIs('reviews') ? 'active' : '' }}">
                        <i class="fas fa-comment-dots mr-2"></i>Reviews
                    </a>
                </li>
                <li>
                    <a href="{{ route('category') }}" class="{{ request()->routeIs('category') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle mr-2"></i>Add Categories
                    </a>
                </li>
            @endif
        </ul>

        <!-- Right Side Options -->
        <div class="flex items-center">
            <!-- Theme Toggle -->
            <div class="theme-toggle">
                <i class="fas fa-moon"></i>
            </div>
            
            <!-- User Dropdown -->
            <div class="user-dropdown">
                <button class="user-trigger">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>
                
                <div class="user-dropdown-menu">
                    <a href="{{ route('profile.edit') }}" class="user-dropdown-item">
                        <i class="fas fa-user-circle mr-2"></i>Profile
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="user-dropdown-item w-full text-left">
                            <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Navigation Menu -->
    <div class="mobile-nav">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
        </a>
        <a href="{{ route('jobs') }}" class="{{ request()->routeIs('jobs') ? 'active' : '' }}">
            <i class="fas fa-briefcase mr-2"></i>Jobs
        </a>
        
        @if(Auth::check() && Auth::user()->role == 1)
            <a href="{{ route('addjobs') }}" class="{{ request()->routeIs('addjobs') ? 'active' : '' }}">
                <i class="fas fa-plus-circle mr-2"></i>Add Jobs
            </a>
            <a href="{{ route('myjob') }}" class="{{ request()->routeIs('myjob') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list mr-2"></i>My Jobs
            </a>
        @elseif(Auth::check() && Auth::user()->role == 0)
            <a href="{{ route('application') }}" class="{{ request()->routeIs('application') ? 'active' : '' }}">
                <i class="fas fa-file-alt mr-2"></i>Jobs Applied
            </a>
        @elseif(Auth::check() && Auth::user()->role == 2)
            <a href="{{ route('users') }}" class="{{ request()->routeIs('users') ? 'active' : '' }}">
                <i class="fas fa-users mr-2"></i>Users List
            </a>
        @endif
        
        <a href="{{ route('profile.edit') }}">
            <i class="fas fa-user-circle mr-2"></i>Profile
        </a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left" style="background:none;border:none;padding:12px 0;font-weight:500;display:block;color:inherit;">
                <i class="fas fa-sign-out-alt mr-2"></i>Log Out
            </button>
        </form>
    </div>
</nav>