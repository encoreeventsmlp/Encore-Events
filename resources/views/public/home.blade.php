@extends('layouts.public')

@section('title', 'Encore Events - Smart Event Cost Estimation')

@section('content')

<section id="home" class="hero-section">
    <div class="container">
        <div class="row hero-content">
            <div class="col-lg-8 mx-auto text-center">
                <h6 class="hero-subtitle mb-3 fade-in-up animate-delay-1">WELCOME TO ENCORE EVENTS</h6>
                <h1 class="hero-title mb-4 fade-in-up animate-delay-2">Smart Event Planning Made Simple</h1>
                <p class="hero-description mb-5 fade-in-up animate-delay-3">
                    Get instant, personalized cost estimates for your dream event. Our intelligent estimation tool
                    analyzes your preferences, guest count, and requirements to provide accurate pricing for
                    venues, catering, decorations, and more.
                </p>
                <div class="hero-cta fade-in-up animate-delay-4">
                    @auth
                    <a href="{{ route('public.event-selection') }}" class="btn btn-estimate btn-lg">
                        Get Your Estimate
                    </a>
                    @else
                    <a href="{{ route('public.login') }}" class="btn btn-estimate btn-lg">
                        Get Your Estimate
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="hero-gallery">
        <div class="gallery-scroll">
            <div class="gallery-item">
                <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Elegant Floral Centerpiece" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Wedding Reception Setup" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Barn Wedding Reception" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Dramatic Floral Arrangement" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Elegant Event Decor" />
            </div>

            <div class="gallery-item">
                <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Elegant Floral Centerpiece" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Wedding Reception Setup" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Barn Wedding Reception" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Dramatic Floral Centerpiece" />
            </div>
            <div class="gallery-item">
                <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Elegant Event Decor" />
            </div>
        </div>
    </div>

    <div class="hero-background-overlay"></div>
</section>

<section id="about" class="about-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-image-wrapper fade-in-left">
                    <div class="about-image">
                        <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Elegant Event Setup"
                            class="img-fluid rounded-image" />
                    </div>
                    <div class="decorative-leaves decorative-leaves-left">
                        <svg width="100" height="120" viewBox="0 0 100 120" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                                fill="rgba(150, 44, 80, 0.2)" />
                            <path d="M10 60C15 50 25 45 35 50C45 55 50 65 45 75C40 85 30 90 20 85C10 80 5 70 10 60Z"
                                fill="rgba(150, 44, 80, 0.15)" />
                        </svg>
                    </div>
                    <div class="decorative-leaves decorative-leaves-right">
                        <svg width="80" height="100" viewBox="0 0 80 100" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M60 20C65 10 75 5 85 10C95 15 100 25 95 35C90 45 80 50 70 45C60 40 55 30 60 20Z"
                                fill="rgba(150, 44, 80, 0.1)" />
                            <path
                                d="M50 50C55 40 65 35 75 40C85 45 90 55 85 65C80 75 70 80 60 75C50 70 45 60 50 50Z"
                                fill="rgba(150, 44, 80, 0.12)" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content fade-in-right">
                    <h6 class="about-subtitle">ABOUT US</h6>
                    <h2 class="about-title mb-4">Revolutionary Event Cost Estimation Platform</h2>
                    <div class="about-text">
                        <p class="mb-4">
                            We've revolutionized event planning with our intelligent estimation system. Our platform
                            analyzes your specific preferences, guest count, venue requirements, and style choices
                            to provide accurate, real-time cost estimates for every aspect of your event.
                        </p>
                        <p class="mb-4">
                            From intimate gatherings to grand celebrations, our AI-powered tool considers local
                            market rates, seasonal variations, and vendor availability to give you the most
                            precise budget projections. No more guesswork — just smart, data-driven planning.
                        </p>
                    </div>
                    <div class="about-cta">
                        <a href="#services" class="btn btn-read-more">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="budget-section">
    <div class="budget-container">
        <div class="budget-content fade-in-left">
            <h2 class="budget-title">Need To Know Your Budget</h2>
            <h3 class="budget-subtitle">here is the solution</h3>
            <p class="budget-description">
                Get instant, accurate cost estimates for your dream event. Our intelligent estimation tool
                analyzes your preferences, guest count, and requirements to provide detailed pricing for
                venues, catering, decorations, and all event services.
            </p>
            <div class="budget-cta">
                @auth
                <a href="{{ route('public.event-selection') }}" class="btn btn-estimate-now">
                    Estimate Now
                </a>
                @else
                <a href="{{ route('public.login') }}" class="btn btn-estimate-now">
                    Estimate Now
                </a>
                @endauth
            </div>
        </div>
        <div class="budget-image fade-in-right">
            <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Elegant Floral Arrangements" />
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
                    <p class="member-title">Company CEO</p>
                </div>

                <div class="team-member-wrapper">
                    <div class="team-member team-bg-pink">
                        <div class="member-image-container">
                            <img src="{{ asset('website/assets/team.png') }}" alt="David Johnson" class="member-image">
                        </div>
                    </div>
                    <h4 class="member-name">David Johnson</h4>
                    <p class="member-title">Co-Founder</p>
                </div>

                <div class="team-member-wrapper">
                    <div class="team-member team-bg-blue">
                        <div class="member-image-container">
                            <img src="{{ asset('website/assets/team.png') }}" alt="Mary Johnson" class="member-image">
                        </div>
                    </div>
                    <h4 class="member-name">Mary Johnson</h4>
                    <p class="member-title">Property Manager</p>
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

<section class="trends-section py-5">
    <div class="container p-0">
        <div class="trends-header px-md-0 px-3">
            <div class="trends-title-wrapper fade-in-up">
                <h2 class="trends-title">Popular Event Categories & Pricing Trends</h2>
                <div class="decorative-leaves trends-leaves">
                    <svg width="120" height="80" viewBox="0 0 120 80" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                            fill="rgba(150, 44, 80, 0.15)" />
                        <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                            fill="rgba(150, 44, 80, 0.12)" />
                        <path d="M45 50C50 40 60 35 70 40C80 45 85 55 80 65C75 75 65 80 55 75C45 70 40 60 45 50Z"
                            fill="rgba(150, 44, 80, 0.1)" />
                    </svg>
                </div>
            </div>
            <div class="trends-navigation">
                <button class="nav-button nav-button-left" onclick="scrollTrendsLeft()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="nav-button nav-button-right" onclick="scrollTrendsRight()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Elegant Dining Setup" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Dessert Display" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Signature Drinks" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Floral Arrangements" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Wedding Decor" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Corporate Events"
                            class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Birthday Parties" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="trends-item">
                    <div class="trends-image">
                        <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Anniversary Celebrations"
                            class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="testimonial" class="testimonials-section">
    <div class="container p-0">
        <div class="testimonials-header px-md-0 px-3">
            <div class="testimonials-title-wrapper fade-in-up">
                <h6 class="testimonials-subtitle">TESTIMONIALS</h6>
                <h2 class="testimonials-title">What Our Client says</h2>
            </div>
            <div class="testimonials-navigation">
                <button class="testimonial-nav-button testimonial-nav-left" onclick="scrollTestimonialsLeft()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="testimonial-nav-button testimonial-nav-right" onclick="scrollTestimonialsRight()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="testimonials-decorative">
            <svg width="200" height="150" viewBox="0 0 200 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30 50C40 30 60 20 80 35C100 50 110 70 95 90C80 110 60 120 40 105C20 90 15 70 30 50Z"
                    fill="rgba(139, 69, 19, 0.3)" />
                <path
                    d="M120 30C130 10 150 0 170 15C190 30 200 50 185 70C170 90 150 100 130 85C110 70 105 50 120 30Z"
                    fill="rgba(139, 69, 19, 0.25)" />
                <path
                    d="M80 100C90 80 110 70 130 85C150 100 160 120 145 140C130 160 110 170 90 155C70 140 65 120 80 100Z"
                    fill="rgba(139, 69, 19, 0.2)" />
            </svg>
        </div>
        <div class="testimonials-row">
            <div class="testimonial-card">
                <div class="testimonial-profile">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjRmNGY0Ii8+CjxjaXJjbGUgY3g9IjUwIiBjeT0iMzUiIHI9IjE1IiBmaWxsPSIjMzMzIi8+CjxwYXRoIGQ9Ik0yNSA2NSBRMjUgNTAgNTAgNTAgUTc1IDUwIDc1IDY1IiBzdHJva2U9IiMzMzMiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBmaWxsPSJub25lIi8+Cjwvc3ZnPg=="
                        alt="Priya Sharma" class="profile-image" />
                </div>
                <div class="testimonial-content">
                    <div class="quote-marks">
                        <span class="quote-open">"</span>
                        <span class="quote-close">"</span>
                    </div>
                    <p class="testimonial-text">The estimation tool gave us such accurate pricing that we could
                        plan our dream wedding and Sangeet within budget! The breakdown was so detailed - from mandap decor
                        to catering arrangements - we knew exactly what to expect. No surprises, just perfect planning!
                    </p>
                    <div class="testimonial-separator"></div>
                    <h4 class="testimonial-name">Priya Sharma</h4>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-profile">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjRmNGY0Ii8+CjxjaXJjbGUgY3g9IjUwIiBjeT0iMzUiIHI9IjE1IiBmaWxsPSIjMzMzIi8+CjxwYXRoIGQ9Ik0yNSA2NSBRMjUgNTAgNTAgNTAgUTc1IDUwIDc1IDY1IiBzdHJva2U9IiMzMzMiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBmaWxsPSJub25lIi8+Cjwvc3ZnPg=="
                        alt="Rajesh Iyer" class="profile-image" />
                </div>
                <div class="testimonial-content">
                    <div class="quote-marks">
                        <span class="quote-open">"</span>
                        <span class="quote-close">"</span>
                    </div>
                    <p class="testimonial-text">The cost estimation feature was a game-changer for our corporate
                        gala event! We got instant quotes for stage setups and audio-visual options, comparing
                        packages side-by-side. The accuracy helped our committee make informed decisions quickly.</p>
                    <div class="testimonial-separator"></div>
                    <h4 class="testimonial-name">Rajesh Iyer</h4>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-profile">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjRmNGY0Ii8+CjxjaXJjbGUgY3g9IjUwIiBjeT0iMzUiIHI9IjE1IiBmaWxsPSIjMzMzIi8+CjxwYXRoIGQ9Ik0yNSA2NSBRMjUgNTAgNTAgNTAgUTc1IDUwIDc1IDY1IiBzdHJva2U9IiMzMzMiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBmaWxsPSJub25lIi8+Cjwvc3ZnPg=="
                        alt="Sneha Kapoor" class="profile-image" />
                </div>
                <div class="testimonial-content">
                    <div class="quote-marks">
                        <span class="quote-open">"</span>
                        <span class="quote-close">"</span>
                    </div>
                    <p class="testimonial-text">I loved how the estimation tool let me adjust guest counts and
                        decoration preferences in real-time to see how it affected the total cost. Planning my daughter's
                        Haldi & Mehendi ceremony became so much easier when I could see exact figures!</p>
                    <div class="testimonial-separator"></div>
                    <h4 class="testimonial-name">Sneha Kapoor</h4>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-profile">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjRmNGY0Ii8+CjxjaXJjbGUgY3g9IjUwIiBjeT0iMzUiIHI9IjE1IiBmaWxsPSIjMzMzIi8+CjxwYXRoIGQ9Ik0yNSA2NSBRMjUgNTAgNTAgNTAgUTc1IDUwIDc1IDY1IiBzdHJva2U9IiMzMzMiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBmaWxsPSJub25lIi8+Cjwvc3ZnPg=="
                        alt="Vikram Joshi" class="profile-image" />
                </div>
                <div class="testimonial-content">
                    <div class="quote-marks">
                        <span class="quote-open">"</span>
                        <span class="quote-close">"</span>
                    </div>
                    <p class="testimonial-text">The detailed cost breakdown helped us plan the perfect 25th anniversary
                        celebration for my parents. We could see exactly what we were paying for each service and seating setup,
                        and the estimates were spot-on. Transparent pricing and seamless execution!</p>
                    <div class="testimonial-separator"></div>
                    <h4 class="testimonial-name">Vikram Joshi</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="gallery" class="gallery-section">
    <div class="container">
        <div class="gallery-header text-center">
            <h6 class="gallery-subtitle">GALLERY</h6>
            <h2 class="gallery-title">Go Through Our Memory Lane</h2>
        </div>
        <div class="gallery-decorative">
            <div class="decorative-leaves gallery-leaves-top">
                <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                        fill="rgba(139, 69, 19, 0.3)" />
                    <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                        fill="rgba(139, 69, 19, 0.25)" />
                    <path
                        d="M100 40C105 30 115 25 125 30C135 35 140 45 135 55C130 65 120 70 110 65C100 60 95 50 100 40Z"
                        fill="rgba(139, 69, 19, 0.2)" />
                </svg>
            </div>
            <div class="decorative-leaves gallery-leaves-bottom">
                <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                        fill="rgba(139, 69, 19, 0.3)" />
                    <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                        fill="rgba(139, 69, 19, 0.25)" />
                    <path
                        d="M100 40C105 30 115 25 125 30C135 35 140 45 135 55C130 65 120 70 110 65C100 60 95 50 100 40Z"
                        fill="rgba(139, 69, 19, 0.2)" />
                </svg>
            </div>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Wedding Reception Table" />
            </div>
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Grand Event Hall" />
            </div>
            <div class="gallery-item gallery-item-medium">
                <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Luxurious Dining Room" />
            </div>
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Wedding Cake Display" />
            </div>
            <div class="gallery-item gallery-item-wide">
                <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Fresh Smoothies & Fruits" />
            </div>
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Waiter with Drinks" />
            </div>
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Wedding Arch with Flowers" />
            </div>
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Dessert Table" />
            </div>
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/barn-wedding-reception.jpg') }}" alt="Floral Bouquet" />
            </div>
            <div class="gallery-item gallery-item-wide">
                <img src="{{ asset('website/assets/dramatic-floral-arrangement.jpg') }}" alt="Moody Event Space" />
            </div>
            <div class="gallery-item gallery-item-wide">
                <img src="{{ asset('website/assets/elegant-floral-centerpiece.jpg') }}" alt="Table with Floral Decor" />
            </div>
            <div class="gallery-item gallery-item-tall">
                <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Modern Wedding Setup" />
            </div>
        </div>
    </div>
</section>

<section class="image-reference-section p-0">
    <div class="image-reference-container">
        <div class="image-reference-background">
            <img src="{{ asset('website/assets/wedding-reception-setup.jpg') }}" alt="Elegant Restaurant Interior"
                class="reference-bg-image" />
            <div class="reference-overlay"></div>
        </div>
        <div class="image-reference-content">
            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6">
                        <div class="reference-text-content fade-in-left">
                            <h2 class="reference-title">Need To Know Your Budget</h2>
                            <h3 class="reference-subtitle">here is the solution</h3>
                            <p class="reference-description">
                                Get instant, accurate cost estimates for your dream event. Our intelligent
                                estimation tool
                                analyzes your preferences, guest count, and requirements to provide detailed pricing
                                for
                                venues, catering, decorations, and all event services.
                            </p>
                            <div class="reference-cta">
                                @auth
                                <a href="{{ route('public.event-selection') }}" class="btn btn-estimate-now">
                                    Estimate Now
                                </a>
                                @else
                                <a href="{{ route('public.login') }}" class="btn btn-estimate-now">
                                    Estimate Now
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
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