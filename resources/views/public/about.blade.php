@extends('layouts.public')

@section('title', 'About Us - Encore Events')
@section('description', 'Learn about Encore Events: mission, vision, values, technology and team behind smart event cost estimation for weddings and events in Kerala, India.')
@section('canonical', url('/about'))
@section('robots')
<meta name="robots" content="index, follow">@endsection
@section('structured_data')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AboutPage",
        "url": "{{ url('/about') }}",
        "name": "About Encore Events",
        "description": "Learn about Encore Events: mission, vision, values, technology and team behind smart event cost estimation.",
        "primaryImageOfPage": {
            "@type": "ImageObject",
            "url": "{{ asset('website/assets/wedding-reception-setup.jpg') }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Encore Events",
            "url": "{{ url('/') }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('website/assets/encore-events-logo.png') }}"
            }
        }
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "About",
                "item": "{{ url('/about') }}"
            }
        ]
    }
</script>
@endsection

@section('content')

<section class="about-hero-section py-5">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 mx-auto text-center">
                <h6 class="about-hero-subtitle mb-3">ABOUT ENCORE EVENTS</h6>
                <h1 class="about-hero-title mb-4">Revolutionizing Event Planning with Smart Technology</h1>
                <p class="about-hero-description mb-5">
                    We're passionate about making event planning accessible, transparent, and stress-free.
                    Our innovative platform combines cutting-edge technology with deep industry expertise
                    to deliver accurate cost estimates and seamless planning experiences.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="mission-vision-section py-5" style="background: white;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="mission-card h-100 p-5 bg-white rounded-3 shadow-sm" style="transition: all 0.3s ease; border: 1px solid #f0f0f0;">
                    <div class="mission-icon mb-4" style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-bullseye" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 class="mission-title mb-4" style="font-size: 1.8rem; font-weight: 600; color: #333; font-family: var(--font-family-display); text-align: center;">Our Mission</h3>
                    <p class="mission-text" style="color: #666; line-height: 1.7; font-size: 1rem; text-align: center; margin: 0;">
                        To democratize event planning by providing transparent, accurate, and accessible
                        cost estimation tools that empower individuals and businesses to plan memorable
                        events within their budget, regardless of their experience level.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="vision-card h-100 p-5 rounded-3 shadow-sm" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); transition: all 0.3s ease;">
                    <div class="vision-icon mb-4" style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-eye" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 class="vision-title mb-4 text-white" style="font-size: 1.8rem; font-weight: 600; color: white; font-family: var(--font-family-display); text-align: center;">Our Vision</h3>
                    <p class="vision-text text-white" style="color: rgba(255, 255, 255, 0.9); line-height: 1.7; font-size: 1rem; text-align: center; margin: 0;">
                        To become the global standard for event cost estimation, creating a world where
                        every event planner has access to intelligent tools that eliminate guesswork,
                        reduce stress, and ensure successful celebrations for all occasions.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="values-section py-5" style="background: #faf8f0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h6 class="values-subtitle mb-3" style="font-size: 1rem; font-weight: 600; letter-spacing: 3px; color: var(--primary-color); text-transform: uppercase;">OUR VALUES</h6>
                <h2 class="values-title mb-4" style="font-size: 2.8rem; font-weight: 300; font-family: var(--font-family-display); color: #333; line-height: 1.2;">Our Core Values</h2>
                <p class="values-description" style="font-size: 1.1rem; line-height: 1.7; color: #666; max-width: 600px; margin: 0 auto;">
                    These principles guide everything we do and shape how we serve our clients.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="value-card text-center p-4 bg-white rounded-3 shadow-sm" style="transition: all 0.3s ease; height: 100%;">
                    <div class="value-icon mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-shield-check" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h5 class="value-title" style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 1rem; font-family: var(--font-family-display);">Transparency</h5>
                    <p class="value-text" style="color: #666; line-height: 1.6; margin: 0;">Clear, honest pricing with no hidden fees or surprises.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card text-center p-4 bg-white rounded-3 shadow-sm" style="transition: all 0.3s ease; height: 100%;">
                    <div class="value-icon mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-lightning" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h5 class="value-title" style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 1rem; font-family: var(--font-family-display);">Innovation</h5>
                    <p class="value-text" style="color: #666; line-height: 1.6; margin: 0;">Cutting-edge technology to simplify complex planning processes.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card text-center p-4 bg-white rounded-3 shadow-sm" style="transition: all 0.3s ease; height: 100%;">
                    <div class="value-icon mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-people" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h5 class="value-title" style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 1rem; font-family: var(--font-family-display);">Accessibility</h5>
                    <p class="value-text" style="color: #666; line-height: 1.6; margin: 0;">Making professional event planning tools available to everyone.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card text-center p-4 bg-white rounded-3 shadow-sm" style="transition: all 0.3s ease; height: 100%;">
                    <div class="value-icon mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-heart" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h5 class="value-title" style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 1rem; font-family: var(--font-family-display);">Excellence</h5>
                    <p class="value-text" style="color: #666; line-height: 1.6; margin: 0;">Committed to delivering exceptional results and experiences.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="technology-section py-5" style="background: white;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="technology-content">
                    <h6 class="technology-subtitle mb-3" style="font-size: 1rem; font-weight: 600; letter-spacing: 3px; color: var(--primary-color); text-transform: uppercase;">OUR TECHNOLOGY</h6>
                    <h2 class="technology-title mb-4" style="font-size: 2.8rem; font-weight: 300; font-family: var(--font-family-display); color: #333; line-height: 1.2;">Powered by Advanced AI & Data Analytics</h2>
                    <p class="technology-description mb-4" style="font-size: 1.1rem; line-height: 1.7; color: #666;">
                        Our estimation engine leverages machine learning algorithms and real-time market data
                        to provide accurate cost projections. We analyze thousands of events, vendor pricing,
                        and regional variations to ensure your estimates are precise and up-to-date.
                    </p>
                    <div class="technology-features">
                        <div class="feature-item d-flex align-items-center mb-3" style="transition: all 0.3s ease;">
                            <div style="width: 24px; height: 24px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                                <i class="bi bi-check" style="color: white; font-size: 0.8rem;"></i>
                            </div>
                            <span style="color: #333; font-weight: 500;">Real-time market data analysis</span>
                        </div>
                        <div class="feature-item d-flex align-items-center mb-3" style="transition: all 0.3s ease;">
                            <div style="width: 24px; height: 24px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                                <i class="bi bi-check" style="color: white; font-size: 0.8rem;"></i>
                            </div>
                            <span style="color: #333; font-weight: 500;">Machine learning cost optimization</span>
                        </div>
                        <div class="feature-item d-flex align-items-center mb-3" style="transition: all 0.3s ease;">
                            <div style="width: 24px; height: 24px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                                <i class="bi bi-check" style="color: white; font-size: 0.8rem;"></i>
                            </div>
                            <span style="color: #333; font-weight: 500;">Regional pricing variations</span>
                        </div>
                        <div class="feature-item d-flex align-items-center mb-3" style="transition: all 0.3s ease;">
                            <div style="width: 24px; height: 24px; background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                                <i class="bi bi-check" style="color: white; font-size: 0.8rem;"></i>
                            </div>
                            <span style="color: #333; font-weight: 500;">Seasonal trend analysis</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="technology-image">
                    <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}"
                        alt="Technology in Action"
                        class="img-fluid rounded-3 shadow"
                        style="transition: transform 0.3s ease;">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="team" class="team-section">
    <div class="container">
        <div class="team-header text-center">
            <h2 class="team-title">Meet Our Team</h2>
            <p class="team-description">
                Our dedicated team of experienced event professionals is at the heart of what we do. With a deep
                knowledge of the local market and a passion for helping clients achieve their event goals.
            </p>
            <div class="team-navigation">
                <button class="team-nav-button team-nav-left" onclick="scrollTeamLeft()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="team-nav-button team-nav-right" onclick="scrollTeamRight()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="team-carousel">
            <div class="team-members" id="teamMembers">
                @php
                $bgClasses = ['team-bg-orange', 'team-bg-pink', 'team-bg-blue'];
                $bgIndex = 0;
                @endphp

                @forelse($teamMembers as $member)
                <div class="team-member-wrapper">
                    <div class="team-member {{ $bgClasses[$bgIndex % count($bgClasses)] }}">
                        <div class="member-image-container">
                            @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="member-image">
                            @else
                            <img src="{{ asset('website/assets/team.png') }}" alt="{{ $member->name }}" class="member-image">
                            @endif
                        </div>
                    </div>
                    <h4 class="member-name">{{ $member->name }}</h4>
                    <p class="member-title">{{ $member->designation }}</p>
                </div>
                @php $bgIndex++; @endphp
                @empty

                <div class="team-member-wrapper">
                    <div class="team-member team-bg-orange">
                        <div class="member-image-container">
                            <img src="{{ asset('website/assets/team.png') }}" alt="John Smith" class="member-image">
                        </div>
                    </div>
                    <h4 class="member-name">John Smith</h4>
                    <p class="member-title">CEO & Founder</p>
                </div>

                <div class="team-member-wrapper">
                    <div class="team-member team-bg-pink">
                        <div class="member-image-container">
                            <img src="{{ asset('website/assets/team.png') }}" alt="Sarah Wilson" class="member-image">
                        </div>
                    </div>
                    <h4 class="member-name">Sarah Wilson</h4>
                    <p class="member-title">CTO</p>
                </div>

                <div class="team-member-wrapper">
                    <div class="team-member team-bg-blue">
                        <div class="member-image-container">
                            <img src="{{ asset('website/assets/team.png') }}" alt="Michael Chen" class="member-image">
                        </div>
                    </div>
                    <h4 class="member-name">Michael Chen</h4>
                    <p class="member-title">Head of Data Science</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="team-decorative team-decorative-top">
            <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                    fill="rgba(139, 69, 19, 0.2)" />
                <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                    fill="rgba(139, 69, 19, 0.15)" />
                <path d="M45 50C50 40 60 35 70 40C80 45 85 55 80 65C75 75 65 80 55 75C45 70 40 60 45 50Z"
                    fill="rgba(139, 69, 19, 0.12)" />
            </svg>
        </div>

        <div class="team-decorative team-decorative-bottom">
            <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                    fill="rgba(139, 69, 19, 0.2)" />
                <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                    fill="rgba(139, 69, 19, 0.15)" />
                <path d="M45 50C50 40 60 35 70 40C80 45 85 55 80 65C75 75 65 80 55 75C45 70 40 60 45 50Z"
                    fill="rgba(139, 69, 19, 0.12)" />
            </svg>
        </div>
    </div>
</section>

<section class="cta-section py-5" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark)); color: white; position: relative; overflow: hidden;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="cta-title mb-4" style="font-size: 2.8rem; font-weight: 300; font-family: var(--font-family-display); color: white; line-height: 1.2;">Ready to Plan Your Perfect Event?</h2>
                <p class="cta-description mb-5" style="font-size: 1.1rem; line-height: 1.7; color: rgba(255, 255, 255, 0.9); max-width: 600px; margin: 0 auto 3rem;">
                    Join thousands of satisfied customers who have successfully planned their events
                    using our intelligent estimation platform.
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('public.login') }}" class="btn btn-lg me-3" style="background: white; color: var(--primary-color); border: none; padding: 1rem 2.5rem; font-weight: 600; font-size: 1rem; letter-spacing: 1px; border-radius: 50px; transition: all 0.3s ease; text-transform: uppercase; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                        Get Started Now
                    </a>
                    <a href="{{ route('public.home') }}" class="btn btn-lg" style="background: transparent; color: white; border: 2px solid white; padding: 1rem 2.5rem; font-weight: 600; font-size: 1rem; letter-spacing: 1px; border-radius: 50px; transition: all 0.3s ease; text-transform: uppercase;">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        initializeTeamNavigation();
    });
</script>
@endpush
@endsection