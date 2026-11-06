@extends('layouts.public')

@section('title', 'About Us - Encore Events')
@section('description', 'Learn about Encore Events: our mission, values, and smart event cost estimation technology.')

@section('content')

<!-- About Hero -->
<section class="about-hero-section py-5 bg-sand border-bottom">
    <div class="container py-4 text-center">
        <span class="section-kicker">About Encore Events</span>
        <h1 class="page-title font-display mb-3">Transforming Event Planning With Transparency</h1>
        <p class="text-secondary max-w-700 mx-auto">
            We are passionate about making event planning accessible, transparent, and enjoyable. 
            Our platform combines thoughtful event design with intelligent estimation to eliminate guesswork and create memorable celebrations.
        </p>
    </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision-section py-5 bg-white">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card surface-card h-100 p-4 border-0 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon-box bg-forest text-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-bullseye fs-4"></i>
                        </div>
                        <div>
                            <span class="section-kicker mb-0">Our Purpose</span>
                            <h3 class="font-display mb-0 fs-4">Our Mission</h3>
                        </div>
                    </div>
                    <p class="text-secondary mb-0 leading-relaxed">
                        To empower clients with transparent, accurate, and accessible cost estimation tools that take the mystery out of event planning. We enable hosts to bring their dream celebrations to life within their exact budget boundaries.
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card surface-card h-100 p-4 border-0 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon-box bg-gold-subtle text-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-eye fs-4"></i>
                        </div>
                        <div>
                            <span class="section-kicker mb-0">Our Aspiration</span>
                            <h3 class="font-display mb-0 fs-4">Our Vision</h3>
                        </div>
                    </div>
                    <p class="text-secondary mb-0 leading-relaxed">
                        To set the benchmark for digital event planning in Kerala and beyond, blending high aesthetic standards with clear pricing so every wedding, ceremony, and corporate occasion is executed seamlessly.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="values-section py-5 bg-sand">
    <div class="container py-4">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="section-kicker">Guiding Principles</span>
            <h2 class="section-title font-display mb-2">The Values Behind Every Encore Event</h2>
            <p class="text-secondary">What makes our service trusted by families and corporate hosts.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card surface-card h-100 p-4 border-0 shadow-sm text-center">
                    <div class="rounded-circle bg-forest-subtle text-forest mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="fas fa-hand-holding-usd fs-4"></i>
                    </div>
                    <h5 class="font-display mb-2">No Hidden Fees</h5>
                    <p class="small text-secondary mb-0">Every estimate includes clear line-item breakdowns for catering, decor, and operational staff.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card surface-card h-100 p-4 border-0 shadow-sm text-center">
                    <div class="rounded-circle bg-gold-subtle text-gold mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="fas fa-medal fs-4"></i>
                    </div>
                    <h5 class="font-display mb-2">Quality Craftsmanship</h5>
                    <p class="small text-secondary mb-0">From fresh floral arrangements to gourmet cuisines, we never compromise on execution excellence.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card surface-card h-100 p-4 border-0 shadow-sm text-center">
                    <div class="rounded-circle bg-forest-subtle text-forest mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="fas fa-headset fs-4"></i>
                    </div>
                    <h5 class="font-display mb-2">Dedicated Support</h5>
                    <p class="small text-secondary mb-0">Our professional coordinators assist you from the initial online estimation until the event concludes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to action -->
<section class="about-cta-section py-5 bg-forest text-white text-center">
    <div class="container py-3">
        <h2 class="font-display text-white mb-3">Ready to Plan Your Event With Confidence?</h2>
        <p class="text-white-75 max-w-700 mx-auto mb-4">Calculate an instant quote tailored to your venue and guest count in under 2 minutes.</p>
        @auth
            <a href="{{ route('public.event-selection') }}" class="btn btn-gold btn-lg">
                <i class="fas fa-calculator me-2"></i> Start Estimation
            </a>
        @else
            <a href="{{ route('public.login') }}" class="btn btn-gold btn-lg">
                <i class="fas fa-calculator me-2"></i> Start Estimation
            </a>
        @endauth
    </div>
</section>

@endsection
