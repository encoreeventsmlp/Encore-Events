@extends('layouts.public')

@section('title', 'Encore Events - Plan Extraordinary Events. Know Your Budget.')
@section('description', 'Bring your event vision to life with thoughtful planning, flexible choices, and transparent cost estimation for weddings, receptions, and celebrations.')

@section('content')

<!-- Hero Section -->
<section id="home" class="hero-section position-relative overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center min-vh-75 g-5">
            <div class="col-lg-7 text-center text-lg-start">
                <span class="hero-subtitle mb-3 fade-in-up">
                    <i class="fas fa-sparkles me-1 text-gold"></i> Premium Event Planning & Estimation
                </span>
                <h1 class="hero-title font-display mb-4 fade-in-up animate-delay-1">
                    Plan Extraordinary Events.<br>
                    <span class="text-gold-gradient">Know Your Budget.</span>
                </h1>
                <p class="hero-description mb-4 fade-in-up animate-delay-2">
                    Bring your event vision to life with thoughtful planning, flexible choices, and transparent cost estimation. 
                    From bespoke floral decor and curated dining to comprehensive logistics, tailor every detail to perfection.
                </p>
                <div class="hero-cta d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-3 fade-in-up animate-delay-3">
                    @auth
                        <a href="{{ route('public.event-selection') }}" class="btn btn-gold btn-lg">
                            <i class="fas fa-calculator me-2"></i> Estimate Your Budget
                        </a>
                    @else
                        <a href="{{ route('public.login') }}" class="btn btn-gold btn-lg">
                            <i class="fas fa-calculator me-2"></i> Estimate Your Budget
                        </a>
                    @endauth
                    <a href="#services" class="btn btn-outline-forest btn-lg">
                        <i class="fas fa-compass me-2"></i> Explore Our Services
                    </a>
                </div>

                <!-- Feature Badges -->
                <div class="row g-3 mt-4 pt-3 border-top border-light fade-in-up animate-delay-4">
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-gold fs-5"></i>
                            <span class="small fw-semibold text-muted">Transparent Pricing</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-layer-group text-gold fs-5"></i>
                            <span class="small fw-semibold text-muted">Curated Catalog</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-clock text-gold fs-5"></i>
                            <span class="small fw-semibold text-muted">Instant Quotes</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Imagery Showcase -->
            <div class="col-lg-5">
                <div class="hero-card-stack position-relative fade-in-up animate-delay-2">
                    <div class="hero-main-card surface-card shadow-lg p-2 rounded-4">
                        <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Encore Events Reception Showcase" class="img-fluid rounded-3 w-100" style="height: 380px; object-fit: cover;">
                        <div class="p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="mb-0 fw-bold font-display">Grand Wedding Reception</h6>
                                <small class="text-muted"><i class="bi bi-geo-alt-fill text-gold me-1"></i>Kerala, India</small>
                            </div>
                            <span class="badge badge-gold">Verified Experience</span>
                        </div>
                    </div>
                    <div class="hero-floating-card surface-card shadow-md p-3 rounded-3 d-none d-sm-flex align-items-center gap-3">
                        <div class="floating-icon rounded-circle bg-forest text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="fas fa-chart-line text-gold"></i>
                        </div>
                        <div>
                            <span class="d-block small text-muted">Real-time Budgeting</span>
                            <strong class="text-forest">Instant Breakdown</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about-section py-5 bg-white border-top border-bottom">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-image-wrapper position-relative">
                    <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Bespoke Floral Decor" class="img-fluid rounded-4 shadow-md w-100" style="max-height: 440px; object-fit: cover;">
                    <div class="about-experience-badge position-absolute bottom-0 start-0 m-4 p-3 bg-forest text-white rounded-3 shadow-lg">
                        <h4 class="font-display text-gold mb-0">100%</h4>
                        <small class="text-white-75">Transparent & Tailored</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="section-kicker">About Encore Events</span>
                <h2 class="section-title font-display mb-4">Precision Planning for Unforgettable Moments</h2>
                <p class="text-secondary mb-3">
                    At Encore Events, we believe high-end celebrations shouldn’t be clouded by budget uncertainty. 
                    Our smart platform pairs your unique event preferences—from floral centerpieces and stage backdrops to catering menus and seating layouts—with transparent pricing.
                </p>
                <p class="text-secondary mb-4">
                    Whether you are orchestrating an intimate engagement, a vibrant Sangeet, or a grand corporate gala, our experienced team ensures your vision is delivered with unmatched artistry and budget control.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="feature-icon-box bg-gold-subtle rounded-circle p-2 text-gold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Tailored Options</h6>
                                <p class="small text-muted mb-0">Select individual decor, catering, and service items.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="feature-icon-box bg-forest-subtle rounded-circle p-2 text-forest">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Immediate Estimates</h6>
                                <p class="small text-muted mb-0">Calculate accurate costs based on your guest count.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('public.about') }}" class="btn btn-outline-forest">
                    Learn More About Us <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services / Offerings Section -->
<section id="services" class="services-section py-5 bg-sand">
    <div class="container py-4">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="section-kicker">Our Core Services</span>
            <h2 class="section-title font-display mb-3">Everything Needed For A Flawless Event</h2>
            <p class="text-secondary">Explore our curated collections crafted to elevate every aspect of your celebration.</p>
        </div>

        <div class="row g-4">
            <!-- Decoration -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 card-hoverable surface-card border-0 shadow-sm p-3">
                    <div class="service-card-image mb-3 overflow-hidden rounded-3 position-relative" style="height: 180px;">
                        <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Floral & Stage Decorations" class="w-100 h-100 object-fit-cover transition-transform">
                        <span class="badge badge-forest position-absolute top-0 start-0 m-2">Decor</span>
                    </div>
                    <h5 class="font-display mb-2">Stage & Floral Decor</h5>
                    <p class="small text-secondary mb-3">Entrance arches, custom mandaps, bespoke centerpieces, and atmospheric mood lighting.</p>
                    <div class="mt-auto pt-2 border-top">
                        @auth
                            <a href="{{ route('public.event-selection') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                View Items <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @else
                            <a href="{{ route('public.login') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                View Items <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Gourmet Food & Catering -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 card-hoverable surface-card border-0 shadow-sm p-3">
                    <div class="service-card-image mb-3 overflow-hidden rounded-3 position-relative" style="height: 180px;">
                        <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Catering & Dining" class="w-100 h-100 object-fit-cover transition-transform">
                        <span class="badge badge-forest position-absolute top-0 start-0 m-2">Catering</span>
                    </div>
                    <h5 class="font-display mb-2">Gourmet Catering</h5>
                    <p class="small text-secondary mb-3">Artfully crafted appetizers, regional authentic delicacies, desserts, and beverage setups.</p>
                    <div class="mt-auto pt-2 border-top">
                        @auth
                            <a href="{{ route('public.event-selection') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                Explore Menus <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @else
                            <a href="{{ route('public.login') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                Explore Menus <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Seating Arrangements -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 card-hoverable surface-card border-0 shadow-sm p-3">
                    <div class="service-card-image mb-3 overflow-hidden rounded-3 position-relative" style="height: 180px;">
                        <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Seating Arrangements" class="w-100 h-100 object-fit-cover transition-transform">
                        <span class="badge badge-forest position-absolute top-0 start-0 m-2">Seating</span>
                    </div>
                    <h5 class="font-display mb-2">Seating & Layouts</h5>
                    <p class="small text-secondary mb-3">Banquet setups, round tables, lounge seating, and VIP hospitality arrangements.</p>
                    <div class="mt-auto pt-2 border-top">
                        @auth
                            <a href="{{ route('public.event-selection') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                Check Layouts <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @else
                            <a href="{{ route('public.login') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                Check Layouts <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Event Services -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 card-hoverable surface-card border-0 shadow-sm p-3">
                    <div class="service-card-image mb-3 overflow-hidden rounded-3 position-relative" style="height: 180px;">
                        <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Services and Staff" class="w-100 h-100 object-fit-cover transition-transform">
                        <span class="badge badge-forest position-absolute top-0 start-0 m-2">Services</span>
                    </div>
                    <h5 class="font-display mb-2">Coordination & Sound</h5>
                    <p class="small text-secondary mb-3">Live acoustic sound systems, photography, videography, and dedicated catering staff.</p>
                    <div class="mt-auto pt-2 border-top">
                        @auth
                            <a href="{{ route('public.event-selection') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                Learn More <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @else
                            <a href="{{ route('public.login') }}" class="small fw-bold text-gold d-inline-flex align-items-center">
                                Learn More <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Budget Callout Banner -->
<section class="budget-cta-banner py-5 bg-forest text-white">
    <div class="container py-4">
        <div class="row align-items-center justify-content-between g-4">
            <div class="col-lg-8 text-center text-lg-start">
                <span class="badge badge-gold mb-2">Smart Budgeting</span>
                <h2 class="font-display text-white mb-2">Need To Know Your Event Budget Right Now?</h2>
                <p class="text-white-75 mb-0">Select your preferences, guest count, and required items to receive an accurate, instant breakdown with no surprises.</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                @auth
                    <a href="{{ route('public.event-selection') }}" class="btn btn-gold btn-lg">
                        <i class="fas fa-calculator me-2"></i> Estimate Now
                    </a>
                @else
                    <a href="{{ route('public.login') }}" class="btn btn-gold btn-lg">
                        <i class="fas fa-calculator me-2"></i> Estimate Now
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Team Section (Database-backed) -->
<section id="team" class="team-section py-5 bg-white">
    <div class="container py-4">
        <div class="d-flex flex-wrap align-items-end justify-content-between mb-5">
            <div>
                <span class="section-kicker">Event Specialists</span>
                <h2 class="section-title font-display mb-2">Meet Our Experienced Team</h2>
                <p class="text-secondary mb-0">The dedicated professionals crafting your seamless celebrations.</p>
            </div>
            <div class="team-nav-controls d-flex gap-2 mt-3 mt-sm-0">
                <button class="btn btn-sm btn-outline-secondary rounded-circle p-2" onclick="scrollTeamLeft()" aria-label="Previous Team Member">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-sm btn-outline-secondary rounded-circle p-2" onclick="scrollTeamRight()" aria-label="Next Team Member">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="team-carousel-wrapper">
            <div class="team-members-row d-flex gap-4 overflow-x-auto pb-3" id="teamMembers" style="scroll-behavior: smooth;">
                @forelse($teamMembers as $member)
                    <div class="team-card-item flex-shrink-0" style="width: 260px;">
                        <div class="card surface-card border-0 shadow-sm h-100 text-center p-3">
                            <div class="team-avatar-container mx-auto mb-3 rounded-circle overflow-hidden bg-sand border" style="width: 140px; height: 140px;">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <img src="{{ asset('website/assets/team.png') }}" alt="{{ $member->name }}" class="w-100 h-100 object-fit-cover">
                                @endif
                            </div>
                            <h5 class="font-display mb-1 fs-6">{{ $member->name }}</h5>
                            <span class="badge badge-forest small">{{ $member->designation ?? 'Event Specialist' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="team-card-item flex-shrink-0" style="width: 260px;">
                        <div class="card surface-card border-0 shadow-sm h-100 text-center p-3">
                            <div class="team-avatar-container mx-auto mb-3 rounded-circle overflow-hidden bg-sand border" style="width: 140px; height: 140px;">
                                <img src="{{ asset('website/assets/team.png') }}" alt="Event Coordinator" class="w-100 h-100 object-fit-cover">
                            </div>
                            <h5 class="font-display mb-1 fs-6">Lead Coordinator</h5>
                            <span class="badge badge-forest small">Operations Head</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonial" class="testimonials-section py-5 bg-sand">
    <div class="container py-4">
        <div class="d-flex flex-wrap align-items-end justify-content-between mb-5">
            <div>
                <span class="section-kicker">Client Stories</span>
                <h2 class="section-title font-display mb-2">Trusted By Families & Organizations</h2>
                <p class="text-secondary mb-0">Read how our transparent cost estimation made planning stress-free.</p>
            </div>
            <div class="testimonial-nav-controls d-flex gap-2 mt-3 mt-sm-0">
                <button class="btn btn-sm btn-outline-secondary rounded-circle p-2" onclick="scrollTestimonialsLeft()" aria-label="Previous Testimonial">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-sm btn-outline-secondary rounded-circle p-2" onclick="scrollTestimonialsRight()" aria-label="Next Testimonial">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="row g-4 testimonials-row-scroll flex-nowrap overflow-x-auto pb-3" style="scroll-behavior: smooth;">
            <div class="col-lg-4 col-md-6 flex-shrink-0">
                <div class="card surface-card h-100 border-0 shadow-sm p-4">
                    <div class="d-flex align-items-center gap-1 text-gold mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-secondary fst-italic mb-4">
                        "The estimation tool gave us such accurate pricing that we could plan our wedding and Sangeet within budget. The breakdown—from mandap floral decor to catering—left zero surprises."
                    </p>
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top">
                        <div class="avatar rounded-circle bg-forest text-gold fw-bold d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">PS</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Priya Sharma</h6>
                            <small class="text-muted">Wedding Client</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 flex-shrink-0">
                <div class="card surface-card h-100 border-0 shadow-sm p-4">
                    <div class="d-flex align-items-center gap-1 text-gold mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-secondary fst-italic mb-4">
                        "A game-changer for our annual corporate gala! We received instant quotes for stage setups and audio-visual options, helping our committee finalize decisions quickly."
                    </p>
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top">
                        <div class="avatar rounded-circle bg-forest text-gold fw-bold d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">RI</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Rajesh Iyer</h6>
                            <small class="text-muted">Corporate Event Planner</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 flex-shrink-0">
                <div class="card surface-card h-100 border-0 shadow-sm p-4">
                    <div class="d-flex align-items-center gap-1 text-gold mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-secondary fst-italic mb-4">
                        "Adjusting guest counts and seating preferences in real time gave us immediate visibility into overall expenses. Seamless execution on our daughter’s Haldi ceremony!"
                    </p>
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top">
                        <div class="avatar rounded-circle bg-forest text-gold fw-bold d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">SK</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Sneha Kapoor</h6>
                            <small class="text-muted">Family Celebration</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="gallery-section py-5 bg-white">
    <div class="container py-4">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="section-kicker">Visual Memories</span>
            <h2 class="section-title font-display mb-3">Moments From Our Signature Events</h2>
            <p class="text-secondary">A glimpse into the atmospheres, stages, and celebrations we have had the privilege to curate.</p>
        </div>

        <div class="row g-3">
            <div class="col-md-4 col-sm-6">
                <div class="gallery-item-card rounded-3 overflow-hidden shadow-sm position-relative" style="height: 260px;">
                    <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Wedding Reception Table Setup" class="w-100 h-100 object-fit-cover transition-zoom">
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="gallery-item-card rounded-3 overflow-hidden shadow-sm position-relative" style="height: 260px;">
                    <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Floral Stage Backdrop" class="w-100 h-100 object-fit-cover transition-zoom">
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="gallery-item-card rounded-3 overflow-hidden shadow-sm position-relative" style="height: 260px;">
                    <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Luxury Banquet Dining" class="w-100 h-100 object-fit-cover transition-zoom">
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="gallery-item-card rounded-3 overflow-hidden shadow-sm position-relative" style="height: 260px;">
                    <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Outdoor Reception Ambience" class="w-100 h-100 object-fit-cover transition-zoom">
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="gallery-item-card rounded-3 overflow-hidden shadow-sm position-relative" style="height: 260px;">
                    <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Grand Evening Illumination" class="w-100 h-100 object-fit-cover transition-zoom">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function scrollTeamLeft() {
        const row = document.getElementById('teamMembers');
        if (row) row.scrollBy({ left: -300, behavior: 'smooth' });
    }
    function scrollTeamRight() {
        const row = document.getElementById('teamMembers');
        if (row) row.scrollBy({ left: 300, behavior: 'smooth' });
    }
    function scrollTestimonialsLeft() {
        const row = document.querySelector('.testimonials-row-scroll');
        if (row) row.scrollBy({ left: -350, behavior: 'smooth' });
    }
    function scrollTestimonialsRight() {
        const row = document.querySelector('.testimonials-row-scroll');
        if (row) row.scrollBy({ left: 350, behavior: 'smooth' });
    }
</script>
@endpush
