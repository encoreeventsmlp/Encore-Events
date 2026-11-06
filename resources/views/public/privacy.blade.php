@extends('layouts.public')

@section('title', 'Privacy Policy - Encore Events')
@section('description', 'Encore Events privacy policy: how we collect, use, store and protect your personal information when using our event estimation platform.')

@section('content')

<section class="privacy-hero-section py-5 bg-sand border-bottom">
    <div class="container py-4 text-center">
        <span class="section-kicker">Security & Trust</span>
        <h1 class="page-title font-display mb-3">Privacy Policy</h1>
        <p class="text-secondary max-w-700 mx-auto">
            Your privacy is of paramount importance to us. This policy details how Encore Events safeguards and handles your personal details.
        </p>
        <small class="text-muted d-block mt-2">Last updated: {{ date('F d, Y') }}</small>
    </div>
</section>

<section class="privacy-content-section py-5 bg-white">
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="surface-card p-4 p-md-5 border-0 shadow-sm rounded-4">
                    <div class="privacy-block mb-4">
                        <h4 class="font-display text-forest mb-3">1. Information We Collect</h4>
                        <p class="text-secondary">
                            When using Encore Events to plan an occasion or request an estimate, we collect the necessary contact details (such as your full name, phone number, and optional email) as well as event specifications including dates, district locations, guest counts, and selected items.
                        </p>
                    </div>

                    <div class="privacy-block mb-4">
                        <h4 class="font-display text-forest mb-3">2. How We Use Your Information</h4>
                        <p class="text-secondary">
                            The information collected is strictly utilized to generate accurate cost projections, save your estimation history, verify availability with local event teams, and facilitate communication between you and our coordination specialists.
                        </p>
                    </div>

                    <div class="privacy-block mb-4">
                        <h4 class="font-display text-forest mb-3">3. Data Protection and Storage</h4>
                        <p class="text-secondary">
                            We implement industry-standard security protocols to protect your personal details from unauthorized access, disclosure, or misuse. Your phone-based authentication session is secured using encrypted session tokens and protected cookies.
                        </p>
                    </div>

                    <div class="privacy-block mb-4">
                        <h4 class="font-display text-forest mb-3">4. Third-Party Sharing</h4>
                        <p class="text-secondary">
                            Encore Events does not sell, rent, or trade your personally identifiable information to third-party marketers. Information is only shared with verified event service teams directly involved in fulfilling your chosen event requirements.
                        </p>
                    </div>

                    <div class="privacy-block">
                        <h4 class="font-display text-forest mb-3">5. Contact Us</h4>
                        <p class="text-secondary mb-0">
                            If you have questions or inquiries regarding our privacy standards or wish to request data updates, please reach out to us at <a href="mailto:info@encoreevents.com" class="text-gold fw-semibold">info@encoreevents.com</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
