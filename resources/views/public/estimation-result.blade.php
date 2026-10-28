@extends('layouts.public')

@section('title', 'Event Estimation Result - Encore Events')

@section('content')

<main class="estimation-main">

    <header class="estimation-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h6 class="estimation-subtitle mb-3" style="font-size: 1rem; font-weight: 600; letter-spacing: 3px; color: rgba(255, 255, 255, 0.9); text-transform: uppercase;">ESTIMATION RESULT</h6>
                    <h1 class="page-title">Your Event Estimation</h1>
                    <p class="page-subtitle">Here's your personalized event estimate based on your selections</p>
                </div>
            </div>
        </div>

        <div class="estimation-decorative estimation-decorative-top">
            <svg width="120" height="100" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 30C25 20 35 15 45 20C55 25 60 35 55 45C50 55 40 60 30 55C20 50 15 40 20 30Z"
                    fill="rgba(255, 255, 255, 0.2)" />
                <path d="M70 20C75 10 85 5 95 10C105 15 110 25 105 35C100 45 90 50 80 45C70 40 65 30 70 20Z"
                    fill="rgba(255, 255, 255, 0.15)" />
                <path d="M45 50C50 40 60 35 70 40C80 45 85 55 80 65C75 75 65 80 55 75C45 70 40 60 45 50Z"
                    fill="rgba(255, 255, 255, 0.12)" />
            </svg>
        </div>

        <div class="estimation-decorative estimation-decorative-bottom">
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

    <section class="estimation-result-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <div class="result-card">
                        <div class="result-header">
                            <h2><i class="bi bi-calculator-fill"></i> Estimation Summary</h2>
                            <span class="estimation-date">Generated on: {{ $estimation->created_at->format('F j, Y \a\t g:i A') }}</span>
                        </div>

                        <div class="result-content">

                            <div class="detail-section">
                                <h3><i class="bi bi-info-circle-fill"></i> Event Details</h3>
                                <div class="detail-grid">
                                    <div class="detail-item">
                                        <span class="detail-label">Number of Guests:</span>
                                        <span class="detail-value">{{ $estimation->guest_count }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Catering Staff:</span>
                                        <span class="detail-value">{{ $estimation->catering_boys ? 'Yes' : 'No' }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Event Date:</span>
                                        <span class="detail-value">{{ $estimation->event->event_date->format('F j, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-section">
                                <h3><i class="bi bi-list-check"></i> Selected Items</h3>
                                <div class="services-grid">
                                    @foreach($estimation->item_details as $item)
                                    <div class="service-item">
                                        <div class="service-image">
                                            @if(isset($item['image']) && $item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}" class="item-thumbnail">
                                            @else
                                            <div class="item-thumbnail placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="service-info">
                                            <h4>{{ $item['title'] }}</h4>
                                            <p class="service-category">{{ ucfirst($item['category']) }}</p>
                                        </div>
                                        <div class="service-calculation">
                                            <span class="service-quantity">Qty: {{ $item['quantity'] }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="detail-section">
                                <h3><i class="fas fa-receipt"></i> Total Cost</h3>
                                <div class="cost-breakdown">
                                    <div class="cost-item total">
                                        <span class="cost-label">Total Estimated Cost:</span>
                                        <span class="cost-value">₹{{ number_format($estimation->total_cost, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-section">
                                <h3><i class="fas fa-sticky-note"></i> Additional Notes</h3>
                                <div class="notes-content">
                                    <p>• This is an estimated cost based on your selections</p>
                                    <p>• Final pricing may vary based on specific requirements</p>
                                    <p>• Our team will contact you within 24 hours for detailed discussion</p>
                                    <p>• Custom modifications can be made to fit your budget</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="action-card">
                        <div class="action-header">
                            <h3><i class="bi bi-telephone-fill"></i> Next Steps</h3>
                        </div>
                        <div class="action-content">
                            <div class="action-item">
                                <i class="bi bi-clock-fill"></i>
                                <div>
                                    <h4>24-Hour Response</h4>
                                    <p>We'll contact you within 24 hours</p>
                                </div>
                            </div>
                            <div class="action-item">
                                <i class="bi bi-chat-dots-fill"></i>
                                <div>
                                    <h4>Free Consultation</h4>
                                    <p>Schedule a free consultation call</p>
                                </div>
                            </div>
                            <div class="action-item">
                                <i class="bi bi-pencil-square"></i>
                                <div>
                                    <h4>Custom Modifications</h4>
                                    <p>Modify your selections anytime</p>
                                </div>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <a href="tel:+1234567890" class="btn btn-primary">
                                <i class="bi bi-telephone-fill"></i> Contact Us Now
                            </a>
                            <button class="btn btn-success" id="whatsapp-connect-btn"
                                data-admin-phone="{{ \App\Models\Setting::where('key', 'company_phone')->first()->value ?? '+91 123 456 7890' }}"
                                data-estimation-id="{{ $estimation->id }}"
                                data-total-cost="₹{{ number_format($estimation->total_cost, 2) }}"
                                data-guest-count="{{ $estimation->guest_count }}"
                                data-selected-items="{{ $estimation->decoration_items_count + $estimation->food_items_count + $estimation->service_items_count }}"
                                data-item-details="{{ json_encode($estimation->item_details) }}"
                                data-created-at="{{ $estimation->created_at->format('M d, Y') }}">
                                <i class="fab fa-whatsapp"></i> Share to WhatsApp
                            </button>
                            <a href="{{ route('public.event-selection.re-estimate', $estimation->id) }}" class="btn btn-warning">
                                <i class="bi bi-arrow-clockwise"></i> Re-estimate
                            </a>
                            <a href="{{ route('public.event-selection') }}" class="btn btn-outline-primary">
                                <i class="bi bi-pencil-square"></i> New Selection
                            </a>
                            <button class="btn btn-outline-secondary" id="print-btn">
                                <i class="bi bi-printer-fill"></i> Print Now
                            </button>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-header">
                            <h3><i class="bi bi-person-lines-fill"></i> Contact Information</h3>
                        </div>
                        <div class="contact-content">
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span>+91 98765 43210</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill"></i>
                                <span>info@encoreevents.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>Kerala, India</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-clock-fill"></i>
                                <span>Mon-Fri: 9AM-6PM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('website/css/estimation-result.css') }}">
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('print-btn').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('whatsapp-connect-btn').addEventListener('click', function() {

            const adminPhone = this.getAttribute('data-admin-phone');
            const estimationId = this.getAttribute('data-estimation-id');
            const totalCost = this.getAttribute('data-total-cost');
            const guestCount = this.getAttribute('data-guest-count');
            const selectedItems = this.getAttribute('data-selected-items');
            const itemDetails = JSON.parse(this.getAttribute('data-item-details'));
            const createdAt = this.getAttribute('data-created-at');

            const cleanPhone = adminPhone.replace(/\D/g, '');

            let itemsList = '';
            if (itemDetails && itemDetails.length > 0) {
                itemsList = '\n*Selected Items:*\n';
                itemDetails.forEach((item, index) => {
                    itemsList += `${index + 1}. ${item.title} (${item.category}) - Qty: ${item.quantity}\n`;
                });
            } else {
                itemsList = `\n*Total Items:* ${selectedItems}`;
            }

            const message = `Hi! I'm interested in your event planning services. Here are my estimation details:

*Estimation ID:* #${estimationId}
*Guests:* ${guestCount}${itemsList}
*Date:* ${createdAt}

*Total Cost:* ${totalCost}

Please contact me to discuss this further. Thank you!`;

            const encodedMessage = encodeURIComponent(message);

            const whatsappUrl = `https://wa.me/${cleanPhone}?text=${encodedMessage}`;

            window.open(whatsappUrl, '_blank');
        });

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