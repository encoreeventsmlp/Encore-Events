<header class="site-header sticky-top">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('public.home') }}" aria-label="Encore Events Home">
                <img src="{{ asset('website/assets/encore-events-logo.png') }}" alt="Encore Events" height="64" class="brand-logo">
            </a>

            <!-- Mobile Hamburger Toggle -->
            <button class="navbar-toggler mobile-menu-toggle" type="button" id="mobileMenuToggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileNavSlide">
                <span class="navbar-toggler-icon-custom">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

            <!-- Desktop Navigation -->
            <div class="desktop-nav d-none d-lg-flex align-items-center ms-auto">
                <nav class="desktop-nav-links d-flex align-items-center me-4" aria-label="Main Navigation">
                    <a href="{{ route('public.home') }}" class="nav-link-custom {{ request()->routeIs('public.home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('public.about') }}" class="nav-link-custom {{ request()->routeIs('public.about') ? 'active' : '' }}">About</a>
                    <a href="{{ route('public.home') }}#services" class="nav-link-custom">Services</a>
                    <a href="{{ route('public.home') }}#team" class="nav-link-custom">Team</a>
                    <a href="{{ route('public.home') }}#testimonial" class="nav-link-custom">Testimonials</a>
                    <a href="{{ route('public.home') }}#gallery" class="nav-link-custom">Gallery</a>
                </nav>

                <div class="desktop-nav-actions d-flex align-items-center gap-2">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-forest">
                                <i class="fas fa-shield-alt me-1"></i> Admin Panel
                            </a>
                        @else
                            <a href="{{ route('public.my-profile') }}" class="btn btn-outline-forest">
                                <i class="fas fa-user-circle me-1"></i> My Profile
                            </a>
                            <a href="{{ route('public.event-selection') }}" class="btn btn-gold">
                                <i class="fas fa-calculator me-1"></i> Estimate
                            </a>
                        @endif
                        <form action="{{ route('public.logout') }}" method="POST" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('public.login') }}" class="btn btn-outline-forest">
                            <i class="fas fa-sign-in-alt me-1"></i> Sign In
                        </a>
                        <a href="{{ route('public.login') }}" class="btn btn-gold">
                            <i class="fas fa-calendar-check me-1"></i> Plan Event
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Navigation Drawer Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay" aria-hidden="true"></div>

<!-- Mobile Navigation Slide Panel -->
<aside class="mobile-nav-slide" id="mobileNavSlide" aria-label="Mobile Navigation" aria-hidden="true">
    <div class="mobile-nav-header d-flex align-items-center justify-content-between p-3 border-bottom">
        <a href="{{ route('public.home') }}" class="mobile-nav-brand">
            <img src="{{ asset('website/assets/encore-events-logo.png') }}" alt="Encore Events" height="50">
        </a>
        <button class="mobile-nav-close" id="mobileNavClose" aria-label="Close navigation menu">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="mobile-nav-content p-4">
        <ul class="mobile-nav-list list-unstyled mb-4">
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded {{ request()->routeIs('public.home') ? 'active' : '' }}" href="{{ route('public.home') }}">
                    <i class="fas fa-home me-3 text-gold"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded {{ request()->routeIs('public.about') ? 'active' : '' }}" href="{{ route('public.about') }}">
                    <i class="fas fa-info-circle me-3 text-gold"></i>
                    <span>About Us</span>
                </a>
            </li>
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded" href="{{ route('public.home') }}#services">
                    <i class="fas fa-cogs me-3 text-gold"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded" href="{{ route('public.home') }}#team">
                    <i class="fas fa-users me-3 text-gold"></i>
                    <span>Our Team</span>
                </a>
            </li>
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded" href="{{ route('public.home') }}#testimonial">
                    <i class="fas fa-quote-left me-3 text-gold"></i>
                    <span>Testimonials</span>
                </a>
            </li>
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded" href="{{ route('public.home') }}#gallery">
                    <i class="fas fa-images me-3 text-gold"></i>
                    <span>Gallery</span>
                </a>
            </li>
            @auth
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded" href="{{ route('public.event-selection') }}">
                    <i class="fas fa-calculator me-3 text-gold"></i>
                    <span>Event Estimator</span>
                </a>
            </li>
            <li class="mobile-nav-item mb-2">
                <a class="mobile-nav-link d-flex align-items-center p-2 rounded" href="{{ route('public.my-profile') }}">
                    <i class="fas fa-user-circle me-3 text-gold"></i>
                    <span>My Profile</span>
                </a>
            </li>
            @endauth
        </ul>

        <div class="mobile-nav-actions pt-3 border-top">
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-forest w-100 mb-2">
                        <i class="fas fa-shield-alt me-1"></i> Admin Dashboard
                    </a>
                @endif
                <form action="{{ route('public.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-forest w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Log Out
                    </button>
                </form>
            @else
                <a href="{{ route('public.login') }}" class="btn btn-gold w-100 mb-2">
                    <i class="fas fa-calculator me-2"></i> Estimate Your Budget
                </a>
                <a href="{{ route('public.login') }}" class="btn btn-outline-forest w-100">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In / Register
                </a>
            @endauth
        </div>
    </div>
</aside>
