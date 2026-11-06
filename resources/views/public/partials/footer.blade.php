<footer class="site-footer bg-forest text-white">
    <div class="container py-5">
        <div class="row g-4 justify-content-between">
            <!-- Brand Column -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-3">
                    <img src="{{ asset('website/assets/encore-events-logo.png') }}" alt="Encore Events" height="70" class="footer-logo">
                </div>
                <p class="footer-tagline text-white-75 mb-4">
                    Your premier partner for intelligent event planning and transparent cost estimation. 
                    Bringing extraordinary celebrations to life with precision, style, and perfection.
                </p>
                <div class="footer-social d-flex align-items-center gap-2">
                    @php
                        $facebook = \App\Models\Setting::getValue('facebook_url');
                        $instagram = \App\Models\Setting::getValue('instagram_url');
                        $twitter = \App\Models\Setting::getValue('twitter_url');
                        $linkedin = \App\Models\Setting::getValue('linkedin_url');
                        $youtube = \App\Models\Setting::getValue('youtube_url');
                    @endphp
                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener" class="social-circle" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    @endif
                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener" class="social-circle" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    @endif
                    @if($twitter)
                        <a href="{{ $twitter }}" target="_blank" rel="noopener" class="social-circle" aria-label="Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    @endif
                    @if($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" rel="noopener" class="social-circle" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}" target="_blank" rel="noopener" class="social-circle" aria-label="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading font-display text-white mb-3">Explore</h5>
                <ul class="footer-links list-unstyled m-0">
                    <li class="mb-2"><a href="{{ route('public.home') }}" class="footer-link">Home</a></li>
                    <li class="mb-2"><a href="{{ route('public.about') }}" class="footer-link">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('public.home') }}#services" class="footer-link">Our Services</a></li>
                    <li class="mb-2"><a href="{{ route('public.home') }}#team" class="footer-link">Event Specialists</a></li>
                    <li class="mb-2"><a href="{{ route('public.home') }}#gallery" class="footer-link">Gallery & Memories</a></li>
                    <li class="mb-2"><a href="{{ route('public.privacy') }}" class="footer-link">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Services Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading font-display text-white mb-3">Planning</h5>
                <ul class="footer-links list-unstyled m-0">
                    <li class="mb-2">
                        @auth
                            <a href="{{ route('public.event-selection') }}" class="footer-link text-gold">
                                <i class="fas fa-calculator me-1"></i> Cost Estimator
                            </a>
                        @else
                            <a href="{{ route('public.login') }}" class="footer-link text-gold">
                                <i class="fas fa-calculator me-1"></i> Cost Estimator
                            </a>
                        @endauth
                    </li>
                    <li class="mb-2"><a href="{{ route('public.home') }}#services" class="footer-link">Decorations</a></li>
                    <li class="mb-2"><a href="{{ route('public.home') }}#services" class="footer-link">Gourmet Catering</a></li>
                    <li class="mb-2"><a href="{{ route('public.home') }}#services" class="footer-link">Seating Arrangements</a></li>
                    <li class="mb-2"><a href="{{ route('public.home') }}#services" class="footer-link">Audio & Visuals</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading font-display text-white mb-3">Get in Touch</h5>
                @php
                    $phone = \App\Models\Setting::getValue('company_phone', '+91 98765 43210');
                    $email = \App\Models\Setting::getValue('company_email', 'info@encoreevents.com');
                    $address = \App\Models\Setting::getValue('company_address', 'Encore Complex, Arimbra Manangatta');
                    $pin = \App\Models\Setting::getValue('company_pin', '673638');
                @endphp
                <div class="footer-contact-info">
                    <p class="d-flex align-items-start mb-2 text-white-75">
                        <i class="bi bi-geo-alt-fill text-gold me-2 mt-1"></i>
                        <span>{{ $address }} - {{ $pin }}</span>
                    </p>
                    <p class="d-flex align-items-center mb-2 text-white-75">
                        <i class="bi bi-telephone-fill text-gold me-2"></i>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="text-white-75">{{ $phone }}</a>
                    </p>
                    <p class="d-flex align-items-center mb-0 text-white-75">
                        <i class="bi bi-envelope-fill text-gold me-2"></i>
                        <a href="mailto:{{ $email }}" class="text-white-75">{{ $email }}</a>
                    </p>
                </div>
            </div>
        </div>

        <hr class="footer-divider my-4">

        <div class="row align-items-center justify-content-between text-white-50 small">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                &copy; {{ now()->year }} Encore Events. All rights reserved.
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span>Designed for memorable moments & transparent planning.</span>
            </div>
        </div>
    </div>
</footer>
