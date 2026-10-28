@extends('layouts.public')

@section('title', 'Register / Login - Encore Events')

@section('styles')
<link rel="stylesheet" href="{{ asset('website/css/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="login-container">

    <div class="login-image-section">
        <div class="image-overlay">
            <div class="image-content">
                <h2 class="image-title">Your Dream Destination For<br><span class="highlight">wedding</span></h2>
            </div>
        </div>
    </div>

    <div class="login-form-section">
        <div class="form-container">

            <div class="welcome-section">
                <h1 class="welcome-title">Welcome to Encore Events!</h1>
            </div>

            <div class="tab-section">
                <div class="tab-container">
                    <button class="tab-button" id="login-tab">Login</button>
                    <button class="tab-button active" id="register-tab">Register</button>
                </div>
            </div>

            <div class="description-section">
                <p class="description-text">
                    Create unforgettable memories with our premium event planning services.
                    Simply enter your details to get started.
                </p>
            </div>

            <div class="form-content d-none" id="login-form">
                <form method="POST" action="{{ route('public.login.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel"
                            class="form-control @error('phone') is-invalid @enderror"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Enter your phone number to login"
                            required
                            autocomplete="tel"
                            autofocus>
                        @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-login">
                            Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="small-text">
                        Don’t have an account?
                        <a href="#" id="show-register-link" class="text-decoration-none fw-semibold">
                            Register
                        </a>
                    </p>
                </div>
            </div>

            <div class="form-content" id="register-form">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('public.register.submit') }}">
                    @csrf
                    <div class="form-group">
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
                                autocomplete="name"
                                autofocus>
                        </div>
                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="register_phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="register_phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                autocomplete="tel"
                                placeholder="Enter your phone number to register">
                        </div>
                        @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="event_date" class="form-label">Event Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date"
                                class="form-control @error('event_date') is-invalid @enderror"
                                id="event_date"
                                name="event_date"
                                value="{{ old('event_date') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                title="Select your event date (must be at least tomorrow)"
                                required>
                        </div>
                        @error('event_date')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="district_id" class="form-label">Location</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <select class="form-control @error('district_id') is-invalid @enderror"
                                id="district_id"
                                name="district_id"
                                required>
                                <option value="" disabled selected>Select your location</option>
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

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-register" id="register-submit-btn">
                            <i class="fas fa-user-plus me-2"></i>
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="small-text">
                        Already have an account?
                        <a href="#" id="show-login-link" class="text-decoration-none fw-semibold">
                            Login
                        </a>
                    </p>
                </div>
            </div>

            <div class="admin-login-section text-center mt-4">
                <p class="admin-text">Are you an administrator?</p>
                <a href="{{ route('admin.login') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-shield-alt me-1"></i> Admin Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('website/js/login.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const showLoginLink = document.getElementById('show-login-link');
    const showRegisterLink = document.getElementById('show-register-link');

    loginForm.classList.add('d-none');
    registerForm.classList.remove('d-none');
    registerTab.classList.add('active');
    loginTab.classList.remove('active');

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

    loginTab.addEventListener('click', showLogin);
    registerTab.addEventListener('click', showRegister);

    if (showLoginLink) showLoginLink.addEventListener('click', (e) => { e.preventDefault(); showLogin(); });
    if (showRegisterLink) showRegisterLink.addEventListener('click', (e) => { e.preventDefault(); showRegister(); });
});
</script>
@endsection
