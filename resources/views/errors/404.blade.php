@extends('layouts.public')

@section('title', 'Page Not Found - Encore Events')

@section('content')

<section class="error-hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="error-content">

                    <div class="error-number">
                        <span class="error-4">4</span>
                        <span class="error-0">0</span>
                        <span class="error-4">4</span>
                    </div>

                    <h1 class="error-title">Oops! Page Not Found</h1>
                    <p class="error-description">
                        The page you're looking for seems to have vanished into thin air.
                        Don't worry, even the best events need a little planning!
                    </p>

                    <div class="error-actions">
                        <a href="{{ route('public.home') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-house-door me-2"></i>
                            Go Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="error-decorations">
        <div class="decoration decoration-1">
            <i class="bi bi-balloon"></i>
        </div>
        <div class="decoration decoration-2">
            <i class="bi bi-gift"></i>
        </div>
        <div class="decoration decoration-3">
            <i class="bi bi-heart"></i>
        </div>
        <div class="decoration decoration-4">
            <i class="bi bi-star"></i>
        </div>
        <div class="decoration decoration-5">
            <i class="bi bi-balloon-heart"></i>
        </div>
        <div class="decoration decoration-6">
            <i class="bi bi-gift-fill"></i>
        </div>
        <div class="decoration decoration-7">
            <i class="bi bi-heart-fill"></i>
        </div>
        <div class="decoration decoration-8">
            <i class="bi bi-star-fill"></i>
        </div>
        <div class="decoration decoration-9">
            <i class="bi bi-balloon"></i>
        </div>
        <div class="decoration decoration-10">
            <i class="bi bi-gift"></i>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>

.error-hero-section {
    position: relative;
    min-height: 80vh;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    color: #212529;
    overflow: hidden;
}

.error-content {
    position: relative;
    z-index: 2;
}

.error-number {
    font-size: 8rem;
    font-weight: 900;
    font-family: var(--font-family-display);
    line-height: 1;
    margin-bottom: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
}

.error-4, .error-0 {
    display: inline-block;
    animation: bounce 2s infinite;
}

.error-0 {
    animation-delay: 0.5s;
}

.error-4:last-child {
    animation-delay: 1s;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-20px);
    }
    60% {
        transform: translateY(-10px);
    }
}

.error-title {
    font-size: 3rem;
    font-weight: 700;
    font-family: var(--font-family-display);
    margin-bottom: 1.5rem;
    color: #212529;
}

.error-description {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #6c757d;
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.error-actions .btn {
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 50px;
    transition: var(--transition);
}

.error-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.error-decorations {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.decoration {
    position: absolute;
    font-size: 2rem;
    color: rgba(150, 44, 80, 0.3);
    animation: float 6s ease-in-out infinite;
}

.decoration-1 {
    top: 15%;
    left: 8%;
    animation-delay: 0s;
}

.decoration-2 {
    top: 25%;
    right: 12%;
    animation-delay: 1.5s;
}

.decoration-3 {
    bottom: 35%;
    left: 15%;
    animation-delay: 3s;
}

.decoration-4 {
    bottom: 15%;
    right: 8%;
    animation-delay: 4.5s;
}

.decoration-5 {
    top: 40%;
    left: 5%;
    animation-delay: 2s;
}

.decoration-6 {
    top: 60%;
    right: 5%;
    animation-delay: 3.5s;
}

.decoration-7 {
    bottom: 50%;
    left: 5%;
    animation-delay: 1s;
}

.decoration-8 {
    top: 10%;
    right: 25%;
    animation-delay: 4s;
}

.decoration-9 {
    top: 70%;
    left: 25%;
    animation-delay: 2.5s;
}

.decoration-10 {
    bottom: 5%;
    right: 30%;
    animation-delay: 5s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(10deg);
    }
}

@media (max-width: 768px) {
    .error-number {
        font-size: 6rem;
        gap: 0.5rem;
    }

    .error-title {
        font-size: 2.5rem;
    }

    .error-description {
        font-size: 1.1rem;
    }

    .error-actions .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }

    .decoration {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .error-number {
        font-size: 4rem;
    }

    .error-title {
        font-size: 2rem;
    }
}
</style>
@endsection
