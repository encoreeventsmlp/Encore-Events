@extends('layouts.public')

@section('title', 'My Profile - Encore Events')

@section('content')

<main class="profile-main">

    <header class="profile-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h6 class="profile-subtitle mb-3" style="font-size: 1rem; font-weight: 600; letter-spacing: 3px; color: rgba(255, 255, 255, 0.9); text-transform: uppercase;">MY PROFILE</h6>
                    <h1 class="page-title">Welcome Back, {{ $user->name }}!</h1>
                    <p class="page-subtitle">Manage your profile and view your event estimation history</p>
                </div>
            </div>
        </div>

        <div class="profile-decorative profile-decorative-top">
            <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                    fill="rgba(255, 255, 255, 0.2)" />
                <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                    fill="rgba(255, 255, 255, 0.15)" />
                <path d="M45 50C50 40 60 35 70 40C80 45 85 55 80 65C75 75 65 80 55 75C45 70 40 60 45 50Z"
                    fill="rgba(255, 255, 255, 0.12)" />
            </svg>
        </div>

        <div class="profile-decorative profile-decorative-bottom">
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

    <section class="profile-content-section" style="background: #faf8f0; padding: 4rem 0;">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                </div>
            @endif

            <div class="row g-4">

                <div class="col-lg-4">
                    <div class="profile-info-card">
                        <div class="profile-info-header">
                            <h3><i class="bi bi-person-circle"></i> Profile Information</h3>
                        </div>
                        <div class="profile-info-content">
                            <div class="profile-avatar">
                                <div class="avatar-circle">
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="avatar-image">
                                    @else
                                        <i class="bi bi-person-fill"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="profile-details">
                                <h4 class="profile-name">{{ $user->name }}</h4>
                                <p class="profile-phone">
                                    <i class="bi bi-telephone-fill"></i>
                                    {{ $user->phone ?? 'Not provided' }}
                                </p>
                                <p class="profile-email">
                                    <i class="bi bi-envelope-fill"></i>
                                    {{ $user->email ?? 'Not provided' }}
                                </p>
                                <p class="profile-member-since">
                                    <i class="bi bi-calendar-check-fill"></i>
                                    Member since {{ $user->created_at->format('F Y') }}
                                </p>
                            </div>
                            <div class="profile-actions">
                                <a href="{{ route('public.my-profile.edit') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> Edit Profile
                                </a>
                                <a href="{{ route('public.event-selection') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> New Estimation
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="quick-stats-card">
                        <div class="quick-stats-header">
                            <h3><i class="bi bi-graph-up"></i> Quick Stats</h3>
                        </div>
                        <div class="quick-stats-content">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-calculator-fill"></i>
                                </div>
                                <div class="stat-info">
                                    <h4>{{ $estimations->total() }}</h4>
                                    <p>Total Estimations</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-calendar-event-fill"></i>
                                </div>
                                <div class="stat-info">
                                    <h4>{{ $estimations->where('created_at', '>=', now()->subMonth())->count() }}</h4>
                                    <p>This Month</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="stat-info">
                                    <h4>{{ $estimations->where('created_at', '>=', now()->subWeek())->count() }}</h4>
                                    <p>This Week</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <h3><i class="bi bi-star-fill"></i> Your Review</h3>
                        </div>
                        <div class="review-content">
                            @if($userReview)

                                <div class="existing-review">
                                    <div class="review-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $userReview->rating ? '-fill' : '' }} star-icon"></i>
                                        @endfor
                                        <span class="rating-text">{{ $userReview->rating }}/5</span>
                                    </div>
                                    @if($userReview->comment)
                                        <div class="review-comment">
                                            <p>{{ $userReview->comment }}</p>
                                        </div>
                                    @endif
                                    <div class="review-date">
                                        <small>Submitted on {{ $userReview->created_at->format('F j, Y') }}</small>
                                    </div>
                                </div>
                            @else

                                <form action="{{ route('public.my-profile.review') }}" method="POST" class="review-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rating" class="form-label">Rate our service:</label>
                                        <div class="star-rating">
                                            <input type="radio" id="star5" name="rating" value="5" required>
                                            <label for="star5" class="star-label">★</label>
                                            <input type="radio" id="star4" name="rating" value="4" required>
                                            <label for="star4" class="star-label">★</label>
                                            <input type="radio" id="star3" name="rating" value="3" required>
                                            <label for="star3" class="star-label">★</label>
                                            <input type="radio" id="star2" name="rating" value="2" required>
                                            <label for="star2" class="star-label">★</label>
                                            <input type="radio" id="star1" name="rating" value="1" required>
                                            <label for="star1" class="star-label">★</label>
                                        </div>
                                        @error('rating')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="comment" class="form-label">Your comment (optional):</label>
                                        <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Tell us about your experience...">{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-star-fill"></i> Submit Review
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="estimations-history-card">
                        <div class="estimations-history-header">
                            <h3><i class="bi bi-clock-history"></i> Estimation History</h3>
                            <p class="estimations-subtitle">View and manage all your event estimations</p>
                        </div>
                        <div class="estimations-history-content">
                            @forelse($estimations as $estimation)
                            <div class="estimation-item">
                                <div class="estimation-info">
                                    <div class="estimation-header">
                                        <h4 class="estimation-title">
                                            <i class="bi bi-calendar-event-fill"></i>
                                            Event Estimation #{{ $estimation->id }}
                                        </h4>
                                        <span class="estimation-date">{{ $estimation->created_at->format('M j, Y \a\t g:i A') }}</span>
                                    </div>
                                    <div class="estimation-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Event Date:</span>
                                            <span class="detail-value">{{ $estimation->event->event_date->format('F j, Y') }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Guests:</span>
                                            <span class="detail-value">{{ $estimation->guest_count }} people</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Catering Staff:</span>
                                            <span class="detail-value">{{ $estimation->catering_boys ? 'Yes' : 'No' }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Total Cost:</span>
                                            <span class="detail-value total-cost">₹{{ number_format($estimation->total_cost, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="estimation-actions">
                                    <a href="{{ route('public.estimation-result', $estimation->id) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-eye-fill"></i> View
                                    </a>
                                    <a href="{{ route('public.event-selection.re-estimate', $estimation->id) }}" class="btn btn-success">
                                        <i class="bi bi-arrow-clockwise"></i> Re-estimate
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="no-estimations">
                                <div class="no-estimations-icon">
                                    <i class="bi bi-calculator"></i>
                                </div>
                                <h4>No Estimations Yet</h4>
                                <p>You haven't created any event estimations yet. Start planning your perfect event!</p>
                                <a href="{{ route('public.event-selection') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Create Your First Estimation
                                </a>
                            </div>
                            @endforelse
                        </div>

                        @if($estimations->hasPages())
                        <div class="estimations-pagination">
                            {{ $estimations->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('website/css/my-profile.css') }}">
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    initializeBackToTop();
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
