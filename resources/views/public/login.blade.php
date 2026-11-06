@extends('layouts.public')

@section('title', 'Sign In or Register - Encore Events')
@section('description', 'Access your Encore Events dashboard to view cost estimations, plan events, and manage bookings.')

@section('styles')
<link rel="stylesheet" href="{{ asset('website/css/login.css') }}">
@endsection

@section('content')
<div class="login-page-wrapper">
    <div class="auth-split-container">
        <!-- Visual Showcase Column -->
        <div class="auth-visual-side">
            <div class="auth-visual-overlay"></div>
            <div class="auth-visual-content">
                <span class="auth-visual-badge">Seamless Celebration Planning</span>
                <h2 class="auth-visual-title">Every Detail Perfected. Every Cost Transparent.</h2>
                <p class="auth-visual-text">Join hundreds of happy hosts who planned weddings, galas, and celebrations with complete budget confidence.</p>
            </div>
        </div>

        <!-- Form Column -->
        <div class="auth-form-side">
            <div class="text-center mb-4">
                <span class="section-kicker">Welcome to Encore</span>
                <h2 class="font-display mb-1 fs-3">Plan Your Next Occasion</h2>
                <p class="text-secondary small">Access your estimation dashboard with your mobile number.</p>
            </div>

            <!-- Tab Switcher -->
            <div class="auth-tabs-nav" role="tablist">
                <button type="button" class="auth-tab-btn {{ $errors->has('name') || $errors->has('event_date') || $errors->has('district_id') ? '' : 'active' }}" id="login-tab" role="tab">
                    <i class="fas fa-sign-in-alt me-1"></i> Sign In
                </button>
                <button type="button" class="auth-tab-btn {{ $errors->has('name') || $errors->has('event_date') || $errors->has('district_id') ? 'active' : '' }}" id="register-tab" role="tab">
                    <i class="fas fa-user-plus me-1"></i> New Registration
                </button>
            </div>

            <!-- Login Form (Phone Login) -->
            <div class="auth-form-panel {{ $errors->has('name') || $errors->has('event_date') || $errors->has('district_id') ? 'd-none' : '' }}" id="login-form">
                <form method="POST" action="{{ route('public.login.submit') }}">
                    @csrf
                    <div class="auth-form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                            <input type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Enter your registered phone number"
                                required
                                autocomplete="tel"
                                autofocus>
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gold auth-submit-btn mb-3">
                        <i class="fas fa-arrow-right me-1"></i> Sign In & Continue
                    </button>
                </form>

                <div class="text-center mt-3 pt-3 border-top">
                    <span class="small text-muted">First time planning with Encore?</span>
                    <button type="button" class="btn btn-link p-0 text-gold fw-semibold small ms-1" id="show-register-link">Create Account</button>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="auth-form-panel {{ $errors->has('name') || $errors->has('event_date') || $errors->has('district_id') ? '' : 'd-none' }}" id="register-form">
                @if ($errors->any() && ($errors->has('name') || $errors->has('event_date') || $errors->has('district_id')))
                    <div class="alert alert-danger py-2 small mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('public.register.submit') }}">
                    @csrf
                    <div class="auth-form-group">
                        <label for="register_name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="register_name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                                autocomplete="name">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="auth-form-group">
                        <label for="register_phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                            <input type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="register_phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                autocomplete="tel"
                                placeholder="Enter 10-digit mobile number">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="auth-form-group">
                                <label for="event_date" class="form-label">Expected Date</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date"
                                        class="form-control @error('event_date') is-invalid @enderror"
                                        id="event_date"
                                        name="event_date"
                                        value="{{ old('event_date') }}"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        required>
                                </div>
                                @error('event_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="auth-form-group">
                                <label for="district_id" class="form-label">Location District</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <select class="form-select @error('district_id') is-invalid @enderror"
                                        id="district_id"
                                        name="district_id"
                                        required>
                                        <option value="" disabled selected>Choose district</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('district_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gold auth-submit-btn mb-3">
                        <i class="fas fa-check-circle me-1"></i> Register & Start Estimation
                    </button>
                </form>

                <div class="text-center mt-3 pt-3 border-top">
                    <span class="small text-muted">Already have an account?</span>
                    <button type="button" class="btn btn-link p-0 text-gold fw-semibold small ms-1" id="show-login-link">Sign In</button>
                </div>
            </div>

            <!-- Admin Link -->
            <div class="text-center mt-4 pt-2">
                <a href="{{ route('admin.login') }}" class="small text-muted">
                    <i class="fas fa-shield-alt me-1"></i> Staff / Administrator Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const showLoginLink = document.getElementById('show-login-link');
    const showRegisterLink = document.getElementById('show-register-link');

    function showLogin() {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        loginForm.classList.remove('d-none');
        registerForm.classList.add('d-none');
    }

    function showRegister() {
        registerTab.classList.add('active');
        loginTab.classList.remove('active');
        registerForm.classList.remove('d-none');
        loginForm.classList.add('d-none');
    }

    if (loginTab) loginTab.addEventListener('click', showLogin);
    if (registerTab) registerTab.addEventListener('click', showRegister);
    if (showLoginLink) showLoginLink.addEventListener('click', (e) => { e.preventDefault(); showLogin(); });
    if (showRegisterLink) showRegisterLink.addEventListener('click', (e) => { e.preventDefault(); showRegister(); });
});
</script>
@endsection
