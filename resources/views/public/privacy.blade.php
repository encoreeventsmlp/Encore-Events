@extends('layouts.public')

@section('title', 'Privacy Policy - Encore Events')
@section('description', 'Encore Events privacy policy: how we collect, use, store and protect your personal information when using our event estimation platform.')
@section('canonical', url('/privacy'))
@section('robots')
<meta name="robots" content="index, follow">@endsection
@section('structured_data')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "PrivacyPolicy",
        "name": "Privacy Policy",
        "url": "{{ url('/privacy') }}",
        "description": "Encore Events privacy policy: how we collect, use, store and protect your personal information.",
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
                "name": "Privacy Policy",
                "item": "{{ url('/privacy') }}"
            }
        ]
    }
</script>
@endsection

@section('content')

<section class="privacy-hero-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="privacy-hero-title mb-4">Privacy Policy</h1>
                <p class="privacy-hero-description">
                    Your privacy is important to us. This policy explains how we collect, use, and protect your information.
                </p>
                <p class="privacy-last-updated">
                    <small class="text-muted">Last updated: {{ date('F d, Y') }}</small>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="privacy-content-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="privacy-content">

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">1. Information We Collect</h2>
                        <div class="privacy-section-content">
                            <h4>Personal Information</h4>
                            <p>We collect information you provide directly to us, such as when you:</p>
                            <ul>
                                <li>Create an account or register for our services</li>
                                <li>Use our event estimation tools</li>
                                <li>Contact us for support</li>
                                <li>Subscribe to our newsletter</li>
                            </ul>
                            <p>This information may include your name, email address, phone number, and event preferences.</p>

                            <h4>Usage Information</h4>
                            <p>We automatically collect certain information about your use of our services, including:</p>
                            <ul>
                                <li>Device information (IP address, browser type, operating system)</li>
                                <li>Usage patterns and preferences</li>
                                <li>Event estimation data and results</li>
                                <li>Cookies and similar tracking technologies</li>
                            </ul>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">2. How We Use Your Information</h2>
                        <div class="privacy-section-content">
                            <p>We use the information we collect to:</p>
                            <ul>
                                <li>Provide and improve our event estimation services</li>
                                <li>Personalize your experience and recommendations</li>
                                <li>Communicate with you about our services</li>
                                <li>Process transactions and send related information</li>
                                <li>Send technical notices and support messages</li>
                                <li>Respond to your comments and questions</li>
                                <li>Analyze usage patterns to improve our platform</li>
                            </ul>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">3. Information Sharing</h2>
                        <div class="privacy-section-content">
                            <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except in the following circumstances:</p>
                            <ul>
                                <li><strong>Service Providers:</strong> We may share information with trusted third-party service providers who assist us in operating our platform</li>
                                <li><strong>Legal Requirements:</strong> We may disclose information when required by law or to protect our rights</li>
                                <li><strong>Business Transfers:</strong> In the event of a merger or acquisition, user information may be transferred</li>
                                <li><strong>Consent:</strong> We may share information with your explicit consent</li>
                            </ul>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">4. Data Security</h2>
                        <div class="privacy-section-content">
                            <p>We implement appropriate security measures to protect your personal information:</p>
                            <ul>
                                <li>Encryption of data in transit and at rest</li>
                                <li>Regular security assessments and updates</li>
                                <li>Access controls and authentication measures</li>
                                <li>Secure data storage and backup procedures</li>
                            </ul>
                            <p>However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">5. Cookies and Tracking</h2>
                        <div class="privacy-section-content">
                            <p>We use cookies and similar technologies to:</p>
                            <ul>
                                <li>Remember your preferences and settings</li>
                                <li>Analyze how you use our services</li>
                                <li>Provide personalized content and recommendations</li>
                                <li>Improve our platform's performance and functionality</li>
                            </ul>
                            <p>You can control cookie settings through your browser preferences, but disabling cookies may affect the functionality of our services.</p>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">6. Your Rights</h2>
                        <div class="privacy-section-content">
                            <p>You have the right to:</p>
                            <ul>
                                <li>Access and review your personal information</li>
                                <li>Correct inaccurate or incomplete information</li>
                                <li>Delete your account and associated data</li>
                                <li>Opt-out of marketing communications</li>
                                <li>Data portability (receive a copy of your data)</li>
                                <li>Object to certain processing activities</li>
                            </ul>
                            <p>To exercise these rights, please contact us using the information provided below.</p>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">7. Data Retention</h2>
                        <div class="privacy-section-content">
                            <p>We retain your personal information for as long as necessary to:</p>
                            <ul>
                                <li>Provide our services to you</li>
                                <li>Comply with legal obligations</li>
                                <li>Resolve disputes and enforce agreements</li>
                                <li>Improve our services and user experience</li>
                            </ul>
                            <p>When you delete your account, we will remove your personal information within 30 days, except where retention is required by law.</p>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">8. Children's Privacy</h2>
                        <div class="privacy-section-content">
                            <p>Our services are not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If we become aware that we have collected personal information from a child under 13, we will take steps to delete such information.</p>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">9. Changes to This Policy</h2>
                        <div class="privacy-section-content">
                            <p>We may update this privacy policy from time to time. We will notify you of any changes by:</p>
                            <ul>
                                <li>Posting the new policy on this page</li>
                                <li>Updating the "Last updated" date</li>
                                <li>Sending you an email notification (for significant changes)</li>
                            </ul>
                            <p>We encourage you to review this policy periodically for any changes.</p>
                        </div>
                    </div>

                    <div class="privacy-section mb-5">
                        <h2 class="privacy-section-title">10. Contact Us</h2>
                        <div class="privacy-section-content">
                            <p>If you have any questions about this privacy policy or our data practices, please contact us:</p>
                            <div class="contact-info">
                                <p><strong>Email:</strong> privacy@encoreevents.com</p>
                                <p><strong>Phone:</strong> +91 123 456 7890</p>
                                <p><strong>Address:</strong> Encore Complex, Arimbra Manangatta, Pin: 673638</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="privacy-cta-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="cta-title mb-4">Questions About Your Privacy?</h2>
                <p class="cta-description mb-4">
                    We're committed to protecting your privacy and being transparent about our data practices.
                    If you have any questions or concerns, please don't hesitate to reach out.
                </p>
                <div class="cta-buttons">
                    <a href="mailto:privacy@encoreevents.com" class="btn btn-primary btn-lg me-3">
                        <i class="bi bi-envelope me-2"></i>
                        Contact Us
                    </a>
                    <a href="{{ route('public.home') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-house me-2"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection