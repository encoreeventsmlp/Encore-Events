@extends('layouts.public')

@section('title', 'Event Estimation - Encore Events')

@section('content')

<section class="estimation-hero-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="estimation-hero-title mb-4">Get Your Event Cost Estimate</h1>
                <p class="estimation-hero-description">
                    Welcome to our intelligent event estimation platform. Get accurate cost estimates
                    for your dream event in just a few simple steps.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="estimation-form-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="estimation-card bg-white rounded-3 shadow-lg p-5">
                    <div class="estimation-header text-center mb-5">
                        <h2 class="estimation-title">Event Details</h2>
                        <p class="estimation-subtitle">Tell us about your event to get started</p>
                    </div>

                    <form id="estimationForm" method="POST" action="{{ route('public.estimation.calculate') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="event_type" class="form-label">Event Type</label>
                            <select class="form-select @error('event_type') is-invalid @enderror"
                                id="event_type"
                                name="event_type"
                                required>
                                <option value="">Select Event Type</option>
                                <option value="wedding" {{ old('event_type') == 'wedding' ? 'selected' : '' }}>Wedding</option>
                                <option value="corporate" {{ old('event_type') == 'corporate' ? 'selected' : '' }}>Corporate Event</option>
                                <option value="birthday" {{ old('event_type') == 'birthday' ? 'selected' : '' }}>Birthday Party</option>
                                <option value="anniversary" {{ old('event_type') == 'anniversary' ? 'selected' : '' }}>Anniversary</option>
                                <option value="conference" {{ old('event_type') == 'conference' ? 'selected' : '' }}>Conference</option>
                                <option value="other" {{ old('event_type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('event_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="guest_count" class="form-label">Number of Guests</label>
                            <input type="number"
                                class="form-control @error('guest_count') is-invalid @enderror"
                                id="guest_count"
                                name="guest_count"
                                value="{{ old('guest_count') }}"
                                min="1"
                                required>
                            @error('guest_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date"
                                class="form-control @error('event_date') is-invalid @enderror"
                                id="event_date"
                                name="event_date"
                                value="{{ old('event_date') }}"
                                min="{{ date('Y-m-d') }}"
                                required>
                            @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="venue_type" class="form-label">Venue Type</label>
                            <select class="form-select @error('venue_type') is-invalid @enderror"
                                id="venue_type"
                                name="venue_type"
                                required>
                                <option value="">Select Venue Type</option>
                                <option value="indoor" {{ old('venue_type') == 'indoor' ? 'selected' : '' }}>Indoor Venue</option>
                                <option value="outdoor" {{ old('venue_type') == 'outdoor' ? 'selected' : '' }}>Outdoor Venue</option>
                                <option value="hotel" {{ old('venue_type') == 'hotel' ? 'selected' : '' }}>Hotel Ballroom</option>
                                <option value="restaurant" {{ old('venue_type') == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                                <option value="garden" {{ old('venue_type') == 'garden' ? 'selected' : '' }}>Garden/Lawn</option>
                            </select>
                            @error('venue_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label">Services Required</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="catering" name="services[]" value="catering" {{ in_array('catering', old('services', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="catering">Catering</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="decoration" name="services[]" value="decoration" {{ in_array('decoration', old('services', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="decoration">Decoration</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="photography" name="services[]" value="photography" {{ in_array('photography', old('services', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="photography">Photography</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="music" name="services[]" value="music" {{ in_array('music', old('services', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="music">Music/DJ</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lighting" name="services[]" value="lighting" {{ in_array('lighting', old('services', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lighting">Lighting</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="transportation" name="services[]" value="transportation" {{ in_array('transportation', old('services', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="transportation">Transportation</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="budget_range" class="form-label">Budget Range (Optional)</label>
                            <select class="form-select" id="budget_range" name="budget_range">
                                <option value="">Select Budget Range</option>
                                <option value="under_10k" {{ old('budget_range') == 'under_10k' ? 'selected' : '' }}>Under ₹10,000</option>
                                <option value="10k_25k" {{ old('budget_range') == '10k_25k' ? 'selected' : '' }}>₹10,000 - ₹25,000</option>
                                <option value="25k_50k" {{ old('budget_range') == '25k_50k' ? 'selected' : '' }}>₹25,000 - ₹50,000</option>
                                <option value="50k_100k" {{ old('budget_range') == '50k_100k' ? 'selected' : '' }}>₹50,000 - ₹1,00,000</option>
                                <option value="over_100k" {{ old('budget_range') == 'over_100k' ? 'selected' : '' }}>Over ₹1,00,000</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="notes" class="form-label">Additional Notes (Optional)</label>
                            <textarea class="form-control"
                                id="notes"
                                name="notes"
                                rows="3"
                                placeholder="Any specific requirements or preferences...">{{ old('notes') }}</textarea>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-calculator me-2"></i>
                                Get My Estimate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="estimation-features-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="features-title mb-4">Why Choose Our Estimation Tool?</h2>
                <p class="features-description">
                    Our intelligent platform provides accurate, real-time cost estimates based on
                    current market data and industry expertise.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-lightning-charge display-4 text-primary"></i>
                    </div>
                    <h5 class="feature-title">Instant Results</h5>
                    <p class="feature-text">Get your estimate in seconds, not days.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-graph-up display-4 text-success"></i>
                    </div>
                    <h5 class="feature-title">Accurate Pricing</h5>
                    <p class="feature-text">Based on real market data and vendor rates.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-shield-check display-4 text-info"></i>
                    </div>
                    <h5 class="feature-title">Transparent Costs</h5>
                    <p class="feature-text">No hidden fees or surprise charges.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('estimationForm');
        const guestCount = document.getElementById('guest_count');

        guestCount.addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value < 1) {
                this.setCustomValidity('Minimum 1 guest required');
            } else {
                this.setCustomValidity('');
            }
        });

        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Calculating...';
            submitBtn.disabled = true;
        });
    });
</script>
@endsection