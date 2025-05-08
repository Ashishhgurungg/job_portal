<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elevate Workforce Solutions</title>
    <link rel="stylesheet" href="css/welcome.css">    
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <span class="logo-icon">↗</span>
                    Elevate Workforce Solutions
                </div>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#testimonials">Success Stories</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#jobs">Jobs</a></li>
                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
                <button class="mobile-menu-btn" style="display: none;">☰</button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Connecting Talent with Opportunity</h1>
                <p>We help employers find exceptional talent and empower job seekers to discover their dream careers.</p>
                <div>
                    <a href="{{ route('register') }}" class="btn">Start Now</a>
                    <a href="{{ route('login') }}" class="btn btn-outline">Apply</a>
                </div>
            </div>
        </div>
    </section>

   <!-- Job list and search Section -->
   <section class="job-listings" id="jobs">
        <div class="container">
            <div class="section-title">
                <h2>Trending Jobs</h2>
                <p>Discover the latest career opportunities across multiple industries</p>
                <!-- <div class="job-count">Total Jobs: <span class="badge">{{ $vacancy }}</span></div> -->
            </div>

            <!-- Search and Filter Form -->
            <div class="card job-search-card">
                <form action="{{ url('/') }}#jobs" method="get" class="job-search-form">
                    <div class="search-filter-container">
                        <div class="form-group category-select">
                            <label for="category">Filter by Category:</label>
                            <select name="category" id="category">
                                <option value="">None</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group search-input">
                            <label for="search">Search Jobs:</label>
                            <input type="text" id="search" name="search" placeholder="Job title, keywords..." value="{{ request('search') }}">
                        </div>

                        <div class="search-actions">
                            <button type="submit" class="btn btn-primary" name="go">Search</button>
                            <a href="{{ url('/') }}#jobs" class="btn btn-outline clear-filter">Clear Filters</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Job Listings or No Jobs Found Message -->
            @if($jobs->count() > 0)
                <div class="job-list">
                    @foreach($jobs as $job)
                        <div class="card job-card">
                            <div class="job-header">
                                <div>
                                    <h3 class="job-title">{{ $job->title }}</h3>
                                    <div class="company-name">{{ $job->user->name }}</div>
                                </div>
                                <div class="job-category">{{ $job->category->name }}</div>
                            </div>

                            <div class="job-details">
                                <div class="job-info">
                                    <div class="job-info-item">
                                        <span class="info-icon">💰</span>
                                        <span class="info-label">Salary:</span>
                                        <span class="info-value">Nrs {{ $job->salary }}</span>
                                    </div>
                                    <div class="job-info-item">
                                        <span class="info-icon">⏱️</span>
                                        <span class="info-label">Type:</span>
                                        <span class="info-value">{{ $job->type }}</span>
                                    </div>
                                    <div class="job-info-item">
                                        <span class="info-icon">⏳</span>
                                        <span class="info-label">Deadline:</span>
                                        <span class="info-value">{{ $job->deadline->format('jS M Y') }}</span>
                                    </div>
                                </div>

                                <div class="job-description">
                                    <p>{{ $job->description }}</p>
                                </div>

                                <div class="company-details">
                                    <h4>About the Company</h4>
                                    <div class="company-info">
                                        <div class="company-info-item">
                                            <span class="info-icon">📍</span>
                                            <span class="info-value">{{ $job->user->address }}</span>
                                        </div>
                                        <div class="company-info-item">
                                            <span class="info-icon">📞</span>
                                            <span class="info-value">{{ $job->user->phone }}</span>
                                        </div>
                                    </div>
                                    <p class="company-description">{{ $job->user->description }}</p>
                                </div>
                            </div>

                            <div class="job-footer">
                                @auth
                                    @if(auth()->user()->role == 0)
                                        <a href="/create-application/{{ $job->id }}" class="btn btn-primary apply-btn">Apply Now</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn apply-btn">Login to Apply</a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    {!! $jobs
                        ->appends(request()->query())  {{-- preserve search/category filters --}}
                        ->fragment('jobs')             {{-- append #jobs --}}
                        ->links()                      {{-- render your Tailwind view --}}
                    !!}
                </div>
            @else
                <div class="no-jobs-found">
                    <div class="card no-jobs-card">
                        <div class="no-jobs-message">
                            <div class="no-jobs-icon">😕</div>
                            <h3>Oops! No Jobs Found</h3>
                            <p>We couldn't find any jobs matching your criteria. Try adjusting your filters or check back later for new opportunities.</p>
                            <div class="no-jobs-actions">
                                <a href="{{ url('/') }}#jobs" class="btn btn-primary">View All Jobs</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p>We offer comprehensive workforce solutions tailored to meet the unique needs of both employers and job seekers.</p>
            </div>
            <div class="services">
                <div class="card service-card">
                    <div class="service-icon">🔍</div>
                    <h3>Talent Acquisition</h3>
                    <p>We identify and attract top-tier candidates who align with your company culture and job requirements.</p>
                </div>
                <div class="card service-card">
                    <div class="service-icon">📊</div>
                    <h3>Workforce Analytics</h3>
                    <p>Data-driven insights to optimize your hiring process and improve retention rates.</p>
                </div>
                <div class="card service-card">
                    <div class="service-icon">👥</div>
                    <h3>Career Coaching</h3>
                    <p>Personalized guidance to help job seekers navigate their career path and land their dream job.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-container">
                <div class="stat-item">
                    <h3>5,000+</h3>
                    <p>Successful Placements</p>
                </div>
                <div class="stat-item">
                    <h3>750+</h3>
                    <p>Partner Companies</p>
                </div>
                <div class="stat-item">
                    <h3>92%</h3>
                    <p>Retention Rate</p>
                </div>
                <div class="stat-item">
                    <h3>24</h3>
                    <p>Industries Served</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="section-title">
                <h2>About Elevate Workforce Solutions</h2>
                <p>Our mission is to bridge the gap between talent and opportunity, creating meaningful connections that benefit both employers and job seekers.</p>
            </div>
            <div class="services">
                <div class="card service-card">
                    <div class="service-icon">🚀</div>
                    <h3>Our Mission</h3>
                    <p>To revolutionize the hiring process by creating meaningful connections between employers and job seekers, fostering growth and success for all parties involved.</p>
                </div>
                <div class="card service-card">
                    <div class="service-icon">👁️</div>
                    <h3>Our Vision</h3>
                    <p>To be the leading workforce solution provider, known for our innovative approach, integrity, and commitment to excellence.</p>
                </div>
                <div class="card service-card">
                    <div class="service-icon">💎</div>
                    <h3>Our Values</h3>
                    <p>Integrity, Innovation, Inclusivity, Excellence, and Partnership drive everything we do at Elevate Workforce Solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Success Stories</h2>
                <p>Hear from the employers and job seekers who have experienced the Elevate difference.</p>
            </div>
            
            <div class="reviews-grid">
                @forelse($reviews as $review)
                    <div class="card review-card">
                        <div class="review-content">
                            <div class="review-text">
                                "{{ $review->review }}"
                            </div>
                        </div>
                        <div class="review-author">
                            @if($review->user->image)
                                <img src="{{ asset('uploads/profile/' . $review->user->image) }}" alt="{{ $review->user->name }}'s avatar">
                            @else
                                <div class="avatar-placeholder">
                                    <span>{{ substr($review->user->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="author-info">
                                <h4>{{ $review->user->name }}</h4>
                                <p>{{ $review->user->role == 0 ? 'Job Seeker' : 'Employer' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-reviews-card">
                        <div class="no-reviews-message">
                            <div class="no-reviews-icon">📝</div>
                            <h3>No Reviews Yet</h3>
                            <p>Be the first to share your experience with Elevate Workforce Solutions!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Elevate Your Workforce Strategy?</h2>
                <p>Whether you're an employer looking for top talent or a job seeker searching for your next opportunity, we're here to help you succeed.</p>
                <div>
                    <a href="#contact" class="btn btn-primary">Get Started Today</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Contact Us</h2>
                <p>Reach out to our team to learn more about how we can support your hiring or job search needs.</p>
            </div>
            
            <!-- Laravel Flash Message Example -->
            <div class="alert alert-success" style="display: none;">
                Your message has been sent successfully! We'll be in touch soon.
            </div>
            
            <div class="contact-info">
                <div class="card contact-card">
                    <div class="contact-icon">📞</div>
                    <h3>Call Us</h3>
                    <p>(555) 123-4567</p>
                </div>
                <div class="card contact-card">
                    <div class="contact-icon">✉️</div>
                    <h3>Email Us</h3>
                    <p>info@elevateworkforce.com</p>
                </div>
                <div class="card contact-card">
                    <div class="contact-icon">📍</div>
                    <h3>Visit Us</h3>
                    <p>123 Business Ave, Suite 500<br>Metropolis, CA 90210</p>
                </div>
            </div>
            
            <!-- Laravel Form with CSRF Token -->
            @if(session('inquiry'))
            <div class="alert alert-success">
                {{ session('inquiry') }}
            </div>
            @endif
            <form action="{{ route('inquiry.submit') }}#contact" method="post">
                <!-- Laravel CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="inquiry">Inquiry Type</label>
                    <select id="inquiry" name="inquiry">
                        <option value="0">I'm a job seeker looking for opportunities</option>
                        <option value="1">I'm an employer looking for talent</option>
                        <option value="2">Other inquiry</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Elevate Workforce Solutions</h3>
                    <p>Connecting talent with opportunity since 2015.</p>
                    <div class="social-links">
                        <a href="#"><span>f</span></a>
                        <a href="#"><span>in</span></a>
                        <a href="#"><span>𝕏</span></a>
                        <a href="#"><span>ig</span></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#testimonials">Success Stories</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>For Employers</h3>
                    <ul class="footer-links">
                        <li><a href="#">Talent Acquisition</a></li>
                        <li><a href="#">Workforce Analytics</a></li>
                        <li><a href="#">Employer Resources</a></li>
                        <li><a href="#">Post a Job</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>For Job Seekers</h3>
                    <ul class="footer-links">
                        <li><a href="#">Browse Jobs</a></li>
                        <li><a href="#">Career Coaching</a></li>
                        <li><a href="#">Resume Services</a></li>
                        <li><a href="#">Job Seeker Resources</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Elevate Workforce Solutions. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Laravel-specific JavaScript -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
  // —— CONTACT FORM HANDLER —— 
  // Make sure your contact <form> has id="contactForm"
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Show success alert inside the contact form
      const alertSuccess = contactForm.querySelector('.alert-success');
      if (alertSuccess) {
        alertSuccess.style.display = 'block';
      }

      // Reset the contact form
      contactForm.reset();

      // Hide success message after 5 seconds
      setTimeout(function() {
        if (alertSuccess) {
          alertSuccess.style.display = 'none';
        }
      }, 5000);
    });
  }

  // —— JOB LISTING PAGINATION & DYNAMIC LOADING —— 
  const jobListingsSection = document.getElementById('jobs');

  document.addEventListener('click', function(e) {
    const paginationLink = e.target.closest('.pagination a');
    if (paginationLink && !paginationLink.hasAttribute('disabled')) {
      e.preventDefault();
      const url = paginationLink.getAttribute('href');

      // Fade out existing job list
      const jobList = document.querySelector('.job-list');
      if (jobList) {
        jobList.style.opacity = '0.5';
        jobList.style.transition = 'opacity 0.3s ease';
      }

      fetch(url)
        .then(response => response.text())
        .then(html => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');

          // Swap in the new job-list and pagination
          const newJobList = doc.querySelector('.job-list');
          const newPagination = doc.querySelector('.pagination-container');

          if (newJobList && jobList) {
            jobList.innerHTML = newJobList.innerHTML;
            jobList.style.opacity = '0';
            setTimeout(() => {
              jobList.style.opacity = '1';
              jobList.style.transition = 'opacity 0.5s ease';
            }, 50);
          }

          if (newPagination) {
            document.querySelector('.pagination-container').innerHTML = newPagination.innerHTML;
          }

          // Update the URL & scroll back to #jobs
          history.pushState({}, '', url);
          if (jobListingsSection) {
            jobListingsSection.scrollIntoView({ behavior: 'smooth' });
          }
        })
        .catch(error => {
          console.error('Error loading job listings:', error);
          if (jobList) {
            jobList.style.opacity = '1';
          }
        });
    }
  });

  // Reload on back/forward to keep state consistent
  window.addEventListener('popstate', function() {
    location.reload();
  });
});
</script>

</body>
</html>