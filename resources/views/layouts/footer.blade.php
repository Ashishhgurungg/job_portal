<footer>
    <div class="footer-container">
        <div class="footer-grid">
            <div class="animate-slideIn" style="animation-delay: 0.1s">
                <h3 class="footer-title">
                    <i class="fas fa-chart-line mr-2"></i>Elevate Workforce
                </h3>
                <p class="mb-4">Elevating Careers, Empowering Businesses</p>
                <div class="footer-social">
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div class="animate-slideIn" style="animation-delay: 0.2s">
                <h3 class="footer-title">
                    <i class="fas fa-sitemap mr-2"></i>Quick Links
                </h3>
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">Services</a>
                <a href="#" class="footer-link">Careers</a>
                <a href="#" class="footer-link">Blog</a>
                <a href="#" class="footer-link">Contact</a>
            </div>
            
            <div class="animate-slideIn" style="animation-delay: 0.3s">
                <h3 class="footer-title">
                    <i class="fas fa-hands-helping mr-2"></i>For Businesses
                </h3>
                <a href="#" class="footer-link">Talent Sourcing</a>
                <a href="#" class="footer-link">Workforce Solutions</a>
                <a href="#" class="footer-link">Executive Search</a>
                <a href="#" class="footer-link">HR Consulting</a>
                <a href="#" class="footer-link">Business Partnership</a>
            </div>
            
            <div class="animate-slideIn" style="animation-delay: 0.4s">
                <h3 class="footer-title">
                    <i class="fas fa-envelope-open-text mr-2"></i>Contact Us
                </h3>
                <p class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i>123 Business Ave, Suite 500</p>
                <p class="mb-2"><i class="fas fa-phone-alt mr-2"></i>(555) 123-4567</p>
                <p class="mb-2"><i class="fas fa-envelope mr-2"></i>info@elevateworkforce.com</p>
                <a href="#" class="btn-secondary mt-4 text-sm px-4 py-2">
                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                </a>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Elevate Workforce Solutions. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    /* Footer styles */
    footer {
        background-color: #1a202c;
        color: #a0aec0;
        padding: 60px 0 30px;
    }

    .footer-container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-title {
        color: white;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-link {
        display: block;
        color: #a0aec0;
        text-decoration: none;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .footer-link:hover {
        color: white;
        transform: translateX(5px);
    }

    .footer-social {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .social-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: var(--primary);
        transform: translateY(-3px);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 30px;
        margin-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: #718096;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }
</style>