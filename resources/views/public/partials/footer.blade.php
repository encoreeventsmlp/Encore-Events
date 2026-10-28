
<footer class="site-footer">
    <div class="container py-5 position-relative">
        <div class="row gy-4">
            <div class="col-lg-4">

                <div class="">
                    <img src="{{ asset('website/assets/encore-events-logo.png') }}" alt="Encore Events" height="90">
                </div>
                <p class="footer-description mt-3">
                    Your trusted partner for smart event planning and cost estimation.
                    Creating unforgettable experiences with precision and innovation.
                </p>
                <div class="footer-social mt-4 d-flex align-items-center gap-4">
                    @php
                    $facebook = \App\Models\Setting::getValue('facebook_url');
                    $instagram = \App\Models\Setting::getValue('instagram_url');
                    $twitter = \App\Models\Setting::getValue('twitter_url');
                    $linkedin = \App\Models\Setting::getValue('linkedin_url');
                    $youtube = \App\Models\Setting::getValue('youtube_url');
                    @endphp
                    @if($twitter)
                    <a href="{{ $twitter }}" target="_blank" rel="noopener" class="social-link" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    @endif
                    @if($linkedin)
                    <a href="{{ $linkedin }}" target="_blank" rel="noopener" class="social-link" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if($facebook)
                    <a href="{{ $facebook }}" target="_blank" rel="noopener" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if($instagram)
                    <a href="{{ $instagram }}" target="_blank" rel="noopener" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if($youtube)
                    <a href="{{ $youtube }}" target="_blank" rel="noopener" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <h6 class="footer-title text-white">Quick Links</h6>
                <ul class="footer-links list-unstyled">
                    <li><a href="{{ route('public.home') }}" class="text-white">Home</a></li>
                    <li><a href="{{ route('public.about') }}" class="text-white">About Us</a></li>
                    <li><a href="{{ route('public.home') }}#services" class="text-white">Services</a></li>
                    <li><a href="{{ route('public.home') }}#team" class="text-white">Team</a></li>
                    <li><a href="{{ route('public.home') }}#testimonial" class="text-white">Testimonials</a></li>
                    <li><a href="{{ route('public.home') }}#gallery" class="text-white">Gallery</a></li>
                    <li>
                        @auth
                        <a href="{{ route('public.event-selection') }}" class="text-white">Get Estimate</a>
                        @else
                        <a href="{{ route('public.login') }}" class="text-white">Get Estimate</a>
                        @endauth
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="footer-title text-white">Contact Info</h6>
                <div class="footer-contact">
                    @php
                    $phone = \App\Models\Setting::getValue('company_phone', '+91 123 456 7890');
                    $email = \App\Models\Setting::getValue('company_email', 'info@encoreevents.com');
                    $address = \App\Models\Setting::getValue('company_address', 'Encore Complex, Arimbra Manangatta');
                    $pin = \App\Models\Setting::getValue('company_pin', '673638');
                    @endphp
                    <p class="mb-2 text-white">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        {{ $address }}
                    </p>
                    <p class="mb-2 text-white">
                        <i class="bi bi-telephone-fill me-2"></i>
                        {{ $phone }}
                    </p>

                    <p class="mb-0 text-white">
                        <i class="bi bi-pin-map-fill me-2"></i>
                        Pin: {{ $pin }}
                    </p>
                </div>
            </div>
        </div>
        <hr class="footer-divider my-4">
        <div class="footer-bottom text-center">
            <!-- <ul class="list-inline m-0">
                <li class="list-inline-item"><a href="{{ route('public.privacy') }}" class="text-white">Privacy Policy</a></li>
                <li class="list-inline-item">&bull;</li>
                <li class="list-inline-item"><a href="#" class="text-white">Terms & Conditions</a></li>
                <li class="list-inline-item">&bull;</li>
                <li class="list-inline-item"><a href="#" class="text-white">Code of Conduct</a></li>
                <li class="list-inline-item">&bull;</li>
            </ul> -->
            <p class="mt-3 mb-0">&copy; {{ now()->year }} Encore Events. All rights reserved.</p>
        </div>
    </div>

    <style>

        .dev-contact-btn {
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            cursor: pointer;
            backdrop-filter: saturate(140%) blur(2px);
            -webkit-backdrop-filter: saturate(140%) blur(2px);
            transition: transform .18s ease, background .18s ease, border-color .18s ease, box-shadow .18s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.15);
            animation: devPulseBtn 2.4s ease-in-out infinite;
        }

        .dev-contact-btn:hover {
            background: rgba(255, 255, 255, 0.16);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-1px);
        }

        .dev-contact-btn:active {
            transform: translateY(0);
        }

        .dev-contact-btn:focus {
            outline: 2px solid rgba(255, 255, 255, 0.45);
            outline-offset: 2px;
        }

        .dev-contact-btn::after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: -120%;
            width: 60%;
            background: linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, 0.35) 30%, transparent 60%);
            transform: skewX(-20deg);
            animation: devShimmer 2.2s ease-in-out infinite;
        }

        @keyframes devShimmer {
            0% {
                left: -120%;
            }

            100% {
                left: 140%;
            }
        }

        @keyframes devPulseBtn {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.10);
            }

            50% {
                box-shadow: 0 0 0 8px rgba(255, 255, 255, 0.06);
            }
        }

        .dev-modal {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: none;
        }

        .dev-modal[aria-hidden="false"] {
            display: block;
        }

        .dev-modal__backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 10, 20, 0.55);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity .25s ease;
        }

        .dev-modal[aria-hidden="false"] .dev-modal__backdrop {
            opacity: 1;
        }

        .dev-modal__dialog {
            position: absolute;
            margin: 0 auto;
            max-width: 820px;
            width: calc(100% - 48px);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -46%) scale(.96);
            opacity: 0;

            background: radial-gradient(120% 120% at 0% 0%, rgba(255, 255, 255, 0.50) 0%, rgba(255, 255, 255, 0.42) 50%, rgba(255, 255, 255, 0.38) 100%);
            border: 1px solid rgba(11, 16, 26, 0.12);
            border-radius: 18px;
            box-shadow: 0 16px 60px rgba(0, 0, 0, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.35);
            color: #0b101a;
            overflow: hidden;
            transition: transform .28s cubic-bezier(.2, .7, .3, 1), opacity .22s ease;
            backdrop-filter: blur(10px) saturate(140%);
            -webkit-backdrop-filter: blur(10px) saturate(140%);
            will-change: transform, opacity, box-shadow;
            perspective: 1000px;
        }

        .dev-modal[aria-hidden="false"] .dev-modal__dialog {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .dev-modal.animating-in .dev-modal__dialog {
            animation: devModalIn .46s cubic-bezier(.18, .72, .22, 1.05);
        }

        .dev-modal.animating-out .dev-modal__dialog {
            animation: devModalOut .22s cubic-bezier(.2, .7, .3, 1);
        }

        @keyframes devModalIn {
            0% {
                transform: translate(-50%, calc(-50% + 14px)) scale(.9) rotate(-0.6deg) rotateX(6deg) rotateY(-4deg);
                filter: blur(6px) saturate(120%);
                opacity: 0;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            }

            55% {
                transform: translate(-50%, -50%) scale(1.03) rotate(0.2deg) rotateX(0deg) rotateY(0deg);
                filter: blur(0) saturate(140%);
                opacity: 1;
                box-shadow: 0 22px 64px rgba(0, 0, 0, 0.30);
            }

            100% {
                transform: translate(-50%, -50%) scale(1) rotate(0);
                filter: blur(0);
                opacity: 1;
                box-shadow: 0 16px 60px rgba(0, 0, 0, 0.28);
            }
        }

        @keyframes devModalOut {
            0% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }

            100% {
                transform: translate(-50%, -50%) scale(.96);
                opacity: 0;
            }
        }

        .dev-modal.animating-in .dev-modal__backdrop {
            animation: devBackdropIn .22s ease forwards;
        }

        .dev-modal.animating-out .dev-modal__backdrop {
            animation: devBackdropOut .22s ease forwards;
        }

        @keyframes devBackdropIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes devBackdropOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .dev-modal.animating-in .dev-modal__title {
            animation: devFadeUp .34s ease .08s both;
        }

        .dev-modal.animating-in .dev-modal__subtitle {
            animation: devFadeUp .34s ease .12s both;
        }

        .dev-modal.animating-in .dev-modal__cards>.dev-modal__card:nth-child(1) {
            animation: devFadeUp .34s ease .14s both;
        }

        .dev-modal.animating-in .dev-modal__cards>.dev-modal__card:nth-child(2) {
            animation: devFadeUp .34s ease .20s both;
        }

        .dev-modal.animating-in .dev-modal__card:not(.staggered) {
            animation: devFadeUp .34s ease .14s both;
        }

        @keyframes devFadeUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dev-modal.animating-in .dev-modal__dialog {
            animation-name: devModalIn, devGlowPulse;
            animation-duration: .46s, 1.2s;
            animation-timing-function: cubic-bezier(.18, .72, .22, 1.05), ease-out;
            animation-fill-mode: both;
        }

        .dev-modal__dialog::before {
            content: "";
            position: absolute;
            inset: 0 -40% 0 -40%;
            background: linear-gradient(115deg, rgba(255, 255, 255, 0) 30%, rgba(255, 255, 255, 0.55) 48%, rgba(255, 255, 255, 0) 66%);
            transform: translateX(-60%);
            opacity: 0;
            pointer-events: none;
        }

        .dev-modal.animating-in .dev-modal__dialog::before {
            animation: devSheen 0.9s ease-out .1s both;
        }

        @keyframes devSheen {
            0% {
                transform: translateX(-70%);
                opacity: 0;
            }

            15% {
                opacity: .9;
            }

            100% {
                transform: translateX(70%);
                opacity: 0;
            }
        }

        @keyframes devGlowPulse {
            0% {
                box-shadow: 0 16px 60px rgba(0, 0, 0, 0.28), 0 0 0 0 rgba(0, 230, 168, 0);
            }

            40% {
                box-shadow: 0 18px 64px rgba(0, 0, 0, 0.30), 0 0 0 10px rgba(0, 230, 168, 0.10);
            }

            100% {
                box-shadow: 0 16px 60px rgba(0, 0, 0, 0.28), 0 0 0 0 rgba(0, 230, 168, 0);
            }
        }

        .dev-modal__close {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
            cursor: pointer;
            transition: background .18s ease, transform .18s ease, border-color .18s ease;
        }

        .dev-modal__close:hover {
            background: rgba(255, 255, 255, 0.14);
            border-color: rgba(255, 255, 255, 0.28);
            transform: rotate(0.5deg) scale(1.04);
        }

        .dev-modal__close span {
            font-size: 20px;
            line-height: 1;
        }

        .dev-modal__content {
            padding: 36px 30px 28px 30px;
        }

        .dev-modal__title {
            margin: 0 0 10px 0;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: .2px;
            font-family: var(--font-family-display);
        }

        .dev-modal__subtitle {
            margin: 0 0 18px 0;
            color: rgb(243, 243, 243);
            font-size: 14px;
        }

        .dev-modal__card {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            justify-items: center;
            text-align: center;
            padding: 22px 20px;
            border-radius: 16px;
            border: 1px solid rgba(11, 16, 26, 0.10);
            background: rgba(255, 255, 255, 0.68);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .dev-modal__cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
        }

        @media (min-width: 640px) {
            .dev-modal__cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        .dev-modal__info {
            display: grid;
            gap: 8px;
            justify-items: center;
        }

        .dev-modal__name {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .dev-modal__tag {
            font-size: 14px;
            color: #31445f;
        }

        .dev-modal__meta {
            display: flex;
            gap: 8px;
        }

        .dev-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 12px;
            color: #0b101a;
            font-weight: 700;
            background: #e0f7ef;
        }

        .dev-modal__contact {
            margin-top: 8px;
            display: grid;
            gap: 6px;
        }

        .dev-cta {
            display: inline-block;
            width: fit-content;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid rgba(11, 16, 26, 0.12);
            background: linear-gradient(180deg, #e9f2ff 0%, #ffffff 100%);
            color: #0b2a6f;
            font-weight: 800;
            letter-spacing: .2px;
            text-decoration: none;
            box-shadow: 0 6px 16px rgba(13, 70, 180, 0.10);
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .dev-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(13, 70, 180, 0.16);
        }

        .dev-cta:active {
            transform: translateY(0);
        }

        .dev-note {
            font-size: 12px;
            color: #4b5a71;
        }

        @media (max-width: 480px) {
            .dev-modal__dialog {
                width: calc(100% - 24px);
            }

            .dev-modal__content {
                padding: 22px 18px 18px 18px;
            }
        }
    </style>

    <script>
        (function() {
            var trigger = document.getElementById('dev-contact-trigger');
            var modal = document.getElementById('dev-contact-modal');
            if (!trigger || !modal) return;

            var dismissEls = modal.querySelectorAll('[data-dev-dismiss]');
            var previouslyFocused;

            function openModal() {
                previouslyFocused = document.activeElement;
                modal.setAttribute('aria-hidden', 'false');
                modal.classList.remove('animating-out');
                modal.classList.add('animating-in');
                modal.addEventListener('animationend', function onInEnd(e) {
                    if (e.target.closest('.dev-modal') !== modal) return;
                    modal.classList.remove('animating-in');
                    modal.removeEventListener('animationend', onInEnd);
                });

                var closeBtn = modal.querySelector('.dev-modal__close');
                if (closeBtn) closeBtn.focus({
                    preventScroll: true
                });
                document.addEventListener('keydown', onKeydown);
            }

            function closeModal() {
                modal.classList.remove('animating-in');
                modal.classList.add('animating-out');

                function onOutEnd(e) {
                    if (e.target.closest('.dev-modal') !== modal) return;
                    modal.classList.remove('animating-out');
                    modal.removeEventListener('animationend', onOutEnd);
                    modal.setAttribute('aria-hidden', 'true');
                    document.removeEventListener('keydown', onKeydown);
                    if (previouslyFocused && previouslyFocused.focus) {
                        previouslyFocused.focus({
                            preventScroll: true
                        });
                    }
                }
                modal.addEventListener('animationend', onOutEnd);
            }

            function onKeydown(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            }

            window.openDevModal = openModal;

            trigger.addEventListener('click', openModal);
            dismissEls.forEach(function(el) {
                el.addEventListener('click', closeModal);
            });

            modal.addEventListener('click', function(e) {
                var dialog = modal.querySelector('.dev-modal__dialog');
                if (!dialog.contains(e.target)) {
                    closeModal();
                }
            });
        })();
    </script>

</footer>