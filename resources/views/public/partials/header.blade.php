
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('public.home') }}">
            <img src="{{ asset('website/assets/encore-events-logo.png') }}" alt="Encore Events" height="80">
        </a>
        <button class="navbar-toggler mobile-menu-toggle" type="button" id="mobileMenuToggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="desktop-nav d-flex align-items-center">

            <div class="desktop-nav-links me-4">
                <a href="{{ route('public.home') }}" class="nav-link {{ request()->routeIs('public.home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('public.about') }}" class="nav-link {{ request()->routeIs('public.about') ? 'active' : '' }}">About</a>
                <a href="{{ route('public.home') }}#team" class="nav-link">Team</a>
            </div>

            <div class="desktop-nav-actions">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-register px-4 py-2">Admin Dashboard</a>
                    @else
                        <a href="{{ route('public.my-profile') }}" class="btn btn-register px-4 py-2">My Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('public.login') }}" class="btn btn-register px-4 py-2">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
<div class="mobile-nav-slide" id="mobileNavSlide">
    <div class="mobile-nav-header">
        <div class="mobile-nav-brand">
            <img src="{{ asset('website/assets/encore-events-logo.png') }}" alt="Encore Events" height="60">
        </div>
        <button class="mobile-nav-close" id="mobileNavClose">
            <span class="close-icon">×</span>
        </button>
    </div>

    <div class="mobile-nav-content">
        <ul class="mobile-nav-list">
            <li class="mobile-nav-item hide-when-desktop">
                <a class="mobile-nav-link {{ request()->routeIs('public.home') ? 'active' : '' }}" href="{{ route('public.home') }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="mobile-nav-item hide-when-desktop">
                <a class="mobile-nav-link {{ request()->routeIs('public.about') ? 'active' : '' }}" href="{{ route('public.about') }}">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('public.home') }}#services">
                    <i class="fas fa-cogs"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="mobile-nav-item hide-when-desktop">
                <a class="mobile-nav-link" href="{{ route('public.home') }}#team">
                    <i class="fas fa-users"></i>
                    <span>Team</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('public.home') }}#testimonial">
                    <i class="fas fa-quote-left"></i>
                    <span>Testimonials</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('public.home') }}#gallery">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
            </li>
        </ul>

        <div class="mobile-nav-actions-wrapper">
            <div class="mobile-lang-bar">
                <div class="lang-label">
                    <i class="fas fa-globe"></i>
                    <span>Language</span>
                </div>
                <div id="google_translate_element_mobile" class="mobile-translate-box"></div>
            </div>

            @auth
            <div class="mobile-buttons-stack">
                <form action="{{ route('public.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn-modern-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
            @else
            <div class="mobile-buttons-stack">
                <a href="{{ route('public.login') }}" class="btn-modern-dashboard">
                    <span class="btn-text">
                        <i class="fas fa-sign-in-alt me-2"></i>Login / Register
                    </span>
                    <i class="fas fa-chevron-right btn-chevron"></i>
                </a>
            </div>
            @endauth
        </div>
    </div>
</div>

<style>

    .desktop-nav {
        display: flex !important;
        align-items: center;
        margin-left: auto;
        margin-right: 1rem;
    }

    .desktop-nav-links {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .desktop-nav-links .nav-link {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
        padding: 0.5rem 0;
        transition: all 0.3s ease;
        position: relative;
    }

    .desktop-nav-links .nav-link:hover {
        color: #962C50;
        text-decoration: none;
    }

    .desktop-nav-links .nav-link.active {
        color: #962C50;
        font-weight: 600;
    }

    .desktop-nav-links .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: #962C50;
        border-radius: 1px;
    }

    .desktop-nav-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    @media (max-width: 1199.98px) {

        .desktop-nav,
        .desktop-nav-links {
            display: none !important;
        }
    }

    @media (min-width: 1200px) {
        .mobile-nav-slide .hide-when-desktop {
            display: none !important;
        }
    }

    .mobile-menu-toggle {
        display: block !important;
        order: 1;

        flex-shrink: 0;

        border: none;
        background: transparent;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mobile-menu-toggle:hover {
        background: rgba(150, 44, 80, 0.1);
        transform: scale(1.05);
    }

    .mobile-menu-toggle:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(150, 44, 80, 0.2);
    }

    .mobile-menu-toggle .navbar-toggler-icon {
        width: 24px;
        height: 2px;
        background: #333;
        border-radius: 2px;
        position: relative;
        transition: all 0.3s ease;
        display: block;
    }

    .mobile-menu-toggle .navbar-toggler-icon::before,
    .mobile-menu-toggle .navbar-toggler-icon::after {
        content: '';
        position: absolute;
        width: 24px;
        height: 2px;
        background: #333;
        border-radius: 2px;
        transition: all 0.3s ease;
        left: 0;
    }

    .mobile-menu-toggle .navbar-toggler-icon::before {
        top: -8px;
    }

    .mobile-menu-toggle .navbar-toggler-icon::after {
        top: 8px;
    }

    .mobile-menu-toggle.active .navbar-toggler-icon {
        background: transparent;
    }

    .mobile-menu-toggle.active .navbar-toggler-icon::before {
        transform: rotate(45deg);
        top: 0;
    }

    .mobile-menu-toggle.active .navbar-toggler-icon::after {
        transform: rotate(-45deg);
        top: 0;
    }

    .navbar-collapse {
        display: none !important;
    }

    .navbar .container {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .navbar-brand {
        margin-right: auto;
        flex-shrink: 0;
    }

    .desktop-nav {
        display: flex !important;
        align-items: center;
        margin-left: auto;
        gap: 0.75rem;
    }

    .mobile-nav-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .mobile-nav-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .mobile-nav-slide {
        position: fixed;
        top: 0;
        right: -100%;
        width: 85%;
        max-width: 350px;
        height: 100%;
        background: #ffffff;
        z-index: 1050;
        transition: right 0.3s ease;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .mobile-nav-slide.active {
        right: 0;
    }

    .mobile-nav-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e9ecef;
        background: #f8f9fa;
    }

    .mobile-nav-brand img {
        max-height: 50px;
    }

    .mobile-nav-close {
        background: rgba(150, 44, 80, 0.1);
        border: 2px solid #962C50;
        font-size: 1.2rem;
        color: #962C50;
        cursor: pointer;
        padding: 0.75rem;
        border-radius: 50%;
        transition: all 0.3s ease;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .mobile-nav-close:hover {
        background: #962C50;
        color: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(150, 44, 80, 0.3);
    }

    .mobile-nav-close:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(150, 44, 80, 0.2);
    }

    .mobile-nav-close .close-icon {
        font-size: 1.5rem;
        font-weight: bold;
        line-height: 1;
        display: block;
        text-align: center;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mobile-nav-content {
        padding: 1rem 0;
    }

    .mobile-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-nav-item {
        border-bottom: 1px solid #f1f3f4;
    }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        color: #495057;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .mobile-nav-link:hover {
        background: #f8f9fa;
        color: #962C50;
        text-decoration: none;
    }

    .mobile-nav-link.active {
        background: #962C50;
        color: white;
    }

    .mobile-nav-link i {
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    .mobile-nav-link span {
        font-size: 1rem;
    }

    /* ==========================================================
       MODERN MOBILE DRAWER FOOTER & BUTTONS
       ========================================================== */
    .mobile-nav-actions-wrapper {
        margin-top: 1rem;
        padding: 1.25rem 1.25rem 2rem;
        background: linear-gradient(180deg, #ffffff 0%, #faf6f8 100%);
        border-top: 1px solid #f1e4e9;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }

    /* Language Selector Bar */
    .mobile-lang-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #ffffff;
        border: 1px solid #ebdbe2;
        border-radius: 12px;
        padding: 0.5rem 0.85rem;
        box-shadow: 0 2px 6px rgba(150, 44, 80, 0.04);
        transition: all 0.25s ease;
    }

    .mobile-lang-bar:hover {
        border-color: #962C50;
    }

    .mobile-lang-bar .lang-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.82rem;
        font-weight: 700;
        color: #962C50;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .mobile-lang-bar .lang-label i {
        font-size: 1rem;
    }


    /* Buttons Stack */
    .mobile-buttons-stack {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }

    /* Modern Primary CTA Button (Dashboard / Login) */
    .btn-modern-dashboard {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 0.88rem 1.2rem;
        background: linear-gradient(135deg, #962C50 0%, #7e2141 100%);
        color: #ffffff !important;
        text-decoration: none !important;
        border: none;
        border-radius: 12px;
        font-size: 0.94rem;
        font-weight: 600;
        letter-spacing: 0.2px;
        box-shadow: 0 4px 14px rgba(150, 44, 80, 0.28);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .btn-modern-dashboard::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-modern-dashboard:hover::before {
        left: 100%;
    }

    .btn-modern-dashboard:hover {
        background: linear-gradient(135deg, #a4325a 0%, #872447 100%);
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(150, 44, 80, 0.38);
    }

    .btn-modern-dashboard:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(150, 44, 80, 0.25);
    }

    .btn-modern-dashboard .btn-text {
        display: inline-flex;
        align-items: center;
    }

    .btn-modern-dashboard .btn-chevron {
        font-size: 0.8rem;
        opacity: 0.8;
        transition: transform 0.25s ease;
    }

    .btn-modern-dashboard:hover .btn-chevron {
        transform: translateX(4px);
        opacity: 1;
    }

    /* Modern Soft Logout Button */
    .btn-modern-logout {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 0.78rem 1rem;
        background: #fff5f5;
        color: #dc3545;
        border: 1.5px solid #fecdd3;
        border-radius: 12px;
        font-size: 0.92rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .btn-modern-logout:hover {
        background: #dc3545;
        color: #ffffff;
        border-color: #dc3545;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(220, 53, 69, 0.25);
    }

    .btn-modern-logout:active {
        transform: translateY(0);
    }

    .mobile-nav-info {
        text-align: center;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .mobile-nav-info p {
        font-size: 0.9rem;
        line-height: 1.4;
        margin: 0;
    }

    .mobile-nav-info i {
        color: #962C50;
    }

    @media (max-width: 575px) {
        .mobile-nav-slide {
            width: 90%;
        }
    }

    body.mobile-nav-open {
        overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileNavOverlay = document.getElementById('mobileNavOverlay');
        const mobileNavSlide = document.getElementById('mobileNavSlide');
        const mobileNavClose = document.getElementById('mobileNavClose');
        const body = document.body;

        function openMobileNav() {
            mobileNavOverlay.classList.add('active');
            mobileNavSlide.classList.add('active');
            mobileMenuToggle.classList.add('active');
            body.classList.add('mobile-nav-open');
        }

        function closeMobileNav() {
            mobileNavOverlay.classList.remove('active');
            mobileNavSlide.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
            body.classList.remove('mobile-nav-open');
        }

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', openMobileNav);
        }

        if (mobileNavClose) {
            mobileNavClose.addEventListener('click', closeMobileNav);
        }

        if (mobileNavOverlay) {
            mobileNavOverlay.addEventListener('click', closeMobileNav);
        }

        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', closeMobileNav);
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileNavSlide && mobileNavSlide.classList.contains('active')) {
                closeMobileNav();
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992 && mobileNavSlide && mobileNavSlide.classList.contains('active')) {
                closeMobileNav();
            }
        });
    });
</script>

<script type="text/javascript">
    function googleTranslateElementInit() {

        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,ar,ml',
            autoDisplay: false,
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element_mobile');
    }

    function hideGoogleTranslateToolbar() {
        var frame = document.querySelector('.goog-te-banner-frame');
        if (frame) {
            frame.style.display = 'none';
        }
    }

    window.addEventListener('load', function() {
        setTimeout(hideGoogleTranslateToolbar, 2000);
    });
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<style>
    .goog-te-gadget {
        font-family: inherit !important;
        font-size: 13px !important;
    }

    .goog-te-gadget-simple {
        background: #fdf2f6 !important;
        border: 1px solid #ebdbe2 !important;
        border-radius: 8px !important;
        padding: 5px 12px !important;
        color: #962C50 !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-family: inherit !important;
        box-shadow: none !important;
        position: relative !important;
    }

    .goog-te-gadget-simple:hover {
        background: #962C50 !important;
        border-color: #962C50 !important;
        box-shadow: 0 2px 8px rgba(150, 44, 80, 0.2) !important;
    }

    .goog-te-gadget-simple:hover * {
        color: #ffffff !important;
    }

    .goog-te-gadget-simple .goog-te-menu-value {
        color: #962C50 !important;
        font-size: 13px !important;
        font-weight: 600 !important;
    }

    .goog-te-gadget-simple * {
        color: #962C50 !important;
    }

    .goog-te-gadget-simple img {
        display: none !important;
    }

    .goog-te-banner-frame {
        display: none !important;
    }

    .goog-te-banner-frame.skiptranslate {
        display: none !important;
    }

    body>.skiptranslate iframe {
        height: 0 !important;
        border: none !important;
        box-shadow: none !important;
    }

    .goog-te-menu2 {
        border: 1px solid #e9ecef !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 25px rgba(150, 44, 80, 0.15) !important;
        background: white !important;
        overflow: hidden !important;
        margin-top: 8px !important;
        z-index: 9999 !important;
        min-width: 180px !important;
    }

    .goog-te-menu2-item {
        padding: 12px 20px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #333 !important;
        transition: all 0.3s ease !important;
        border-bottom: 1px solid #f8f9fa !important;
        font-family: 'Noto Sans Malayalam', sans-serif !important;
        cursor: pointer !important;
    }

    .goog-te-menu2-item:last-child {
        border-bottom: none !important;
    }

    .goog-te-menu2-item:hover {
        background: linear-gradient(135deg, #962c50, #802544) !important;
        color: white !important;
        transform: translateX(4px) !important;
        box-shadow: 0 2px 8px rgba(150, 44, 80, 0.3) !important;
    }

    .goog-te-menu2-item-selected {
        background: linear-gradient(135deg, #962c50, #802544) !important;
        color: white !important;
        font-weight: 600 !important;
    }

    .goog-te-menu2-item-selected:hover {
        background: linear-gradient(135deg, #802544, #962c50) !important;
        transform: translateX(4px) !important;
    }

    .mobile-translate-section .goog-te-gadget-simple {
        background: linear-gradient(135deg, #962C50, #802544) !important;
        border: 1px solid #962C50 !important;
        border-radius: 12px !important;
        padding: 12px 20px !important;
        color: white !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        width: 100% !important;
        text-align: center !important;
        font-family: 'Noto Sans Malayalam', sans-serif !important;
        box-shadow: 0 4px 12px rgba(150, 44, 80, 0.3) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .mobile-translate-section .goog-te-gadget-simple::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: -100% !important;
        width: 100% !important;
        height: 100% !important;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent) !important;
        transition: left 0.5s ease !important;
    }

    .mobile-translate-section .goog-te-gadget-simple:hover::before {
        left: 100% !important;
    }

    .mobile-translate-section .goog-te-gadget-simple:hover {
        background: linear-gradient(135deg, #802544, #962C50) !important;
        border-color: #802544 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(150, 44, 80, 0.4) !important;
    }

    .mobile-translate-section .goog-te-gadget-simple .goog-te-menu-value {
        color: white !important;
        font-size: 14px !important;
    }

    .mobile-translate-section .goog-te-gadget-simple * {
        color: white !important;
    }
</style>