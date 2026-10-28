@extends('layouts.public')

@section('title', 'Edit Profile - Encore Events')

@section('content')

<main class="edit-profile-main">

    <header class="edit-profile-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h6 class="edit-profile-subtitle mb-3" style="font-size: 1rem; font-weight: 600; letter-spacing: 3px; color: rgba(255, 255, 255, 0.9); text-transform: uppercase;">EDIT PROFILE</h6>
                    <h1 class="page-title">Update Your Profile</h1>
                    <p class="page-subtitle">Keep your information up to date</p>
                </div>
            </div>
        </div>

        <div class="edit-profile-decorative edit-profile-decorative-top">
            <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                    fill="rgba(255, 255, 255, 0.2)" />
                <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                    fill="rgba(255, 255, 255, 0.15)" />
                <path d="M45 50C50 40 60 35 70 40C80 45 85 55 80 65C75 75 65 80 55 75C45 70 40 60 45 50Z"
                    fill="rgba(255, 255, 255, 0.12)" />
            </svg>
        </div>

        <div class="edit-profile-decorative edit-profile-decorative-bottom">
            <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                    fill="rgba(255, 255, 255, 0.2)" />
                <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                    fill="rgba(255, 255, 255, 0.15)" />
                <path d="M45 50C50 40 60 35 70 40C80 45 85 55 80 65C75 75 65 80 55 75C45 70 40 60 45 50Z"
                    fill="rgba(255, 255, 255, 0.12)" />
            </svg>
        </div>
    </header>

    <section class="edit-profile-content-section" style="background: #faf8f0; padding: 4rem 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="edit-profile-card">
                        <div class="edit-profile-header">
                            <h3><i class="bi bi-pencil-square"></i> Edit Profile Information</h3>
                            <p class="edit-profile-subtitle">Update your personal information and profile picture</p>
                        </div>

                        <div class="edit-profile-content">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle-fill"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('public.my-profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-section">
                                    <h4 class="form-section-title">
                                        <i class="bi bi-camera-fill"></i> Profile Picture
                                    </h4>
                                    <div class="profile-picture-section">
                                        <div class="current-picture">
                                            @if($user->profile_picture)
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Current Profile Picture" class="current-picture-img">
                                            @else
                                                <div class="no-picture">
                                                    <i class="bi bi-person-fill"></i>
                                                    <p>No picture uploaded</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="picture-upload">
                                            <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                                            <label for="profile_picture" class="upload-label">
                                                <i class="bi bi-cloud-upload"></i>
                                                Choose New Picture
                                            </label>
                                            <small class="form-text">JPG, PNG, GIF up to 2MB</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <h4 class="form-section-title">
                                        <i class="bi bi-person-fill"></i> Personal Information
                                    </h4>

                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-person"></i> Full Name
                                        </label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="bi bi-envelope"></i> Email Address
                                        </label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="bi bi-telephone"></i> Phone Number
                                        </label>
                                        <input type="text" class="form-control" value="{{ $user->phone ?? 'Not provided' }}" readonly>
                                        <small class="form-text">Phone number cannot be changed for security reasons</small>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <a href="{{ route('public.my-profile') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i> Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('website/css/edit-profile.css') }}">
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    initializeBackToTop();

    const profilePictureInput = document.getElementById('profile_picture');
    const currentPictureImg = document.querySelector('.current-picture-img');
    const noPicture = document.querySelector('.no-picture');

    profilePictureInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (currentPictureImg) {
                    currentPictureImg.src = e.target.result;
                } else {

                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.alt = 'Profile Picture Preview';
                    newImg.className = 'current-picture-img';

                    if (noPicture) {
                        noPicture.parentNode.replaceChild(newImg, noPicture);
                    }
                }
            };
            reader.readAsDataURL(file);
        }
    });
});

function initializeBackToTop() {

    if (document.getElementById('back-to-top')) {
        return;
    }

    const backToTopBtn = document.createElement('button');
    backToTopBtn.id = 'back-to-top';
    backToTopBtn.className = 'btn btn-primary position-fixed';
    backToTopBtn.style.cssText = `
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        border-radius: 50%;
        height: 50px;
        width: 50px;
        display: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #962C50 0%, #802544 100%);
        border: none;
        color: white;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    `;
    backToTopBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';

    document.body.appendChild(backToTopBtn);

    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopBtn.style.display = 'flex';
        } else {
            backToTopBtn.style.display = 'none';
        }
    });

    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}
</script>
@endsection
