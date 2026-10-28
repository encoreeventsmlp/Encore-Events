// ===================================
// Estimation Result Page JavaScript
// ===================================

$(document).ready(function() {
    // Initialize the page
    initializeEstimationResult();
    
    // Add fade-in animation to elements
    addFadeInAnimation();
});

// Initialize Estimation Result Page
function initializeEstimationResult() {
    // Set current date
    setCurrentDate();
    
    // Load and display estimation data
    loadEstimationData();
    
    // Setup button interactions
    setupButtonInteractions();
    
    // Setup contact form functionality
    setupContactForm();
}

// Set Current Date
function setCurrentDate() {
    const now = new Date();
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    const formattedDate = now.toLocaleDateString('en-US', options);
    $('#current-date').text(formattedDate);
}

// Load Estimation Data
function loadEstimationData() {
    // Get data from URL parameters or localStorage
    const urlParams = new URLSearchParams(window.location.search);
    const guestCount = urlParams.get('guests') || localStorage.getItem('guestCount') || '50';
    const needCatering = urlParams.get('catering') || localStorage.getItem('needCatering') || 'false';
    const selectedItems = JSON.parse(localStorage.getItem('selectedEventItems') || '[]');
    
    // Display event details
    displayEventDetails(guestCount, needCatering);
    
    // Display selected services
    displaySelectedServices(selectedItems);
    
    // Calculate and display costs
    calculateAndDisplayCosts(selectedItems, guestCount, needCatering);
}

// Display Event Details
function displayEventDetails(guestCount, needCatering) {
    $('#guest-count-display').text(guestCount);
    $('#catering-display').text(needCatering === 'true' ? 'Yes' : 'No');
}

// Display Selected Services
function displaySelectedServices(selectedItems) {
    const servicesGrid = $('#selected-services-grid');
    
    if (selectedItems.length === 0) {
        // Show example selected items
        const exampleItems = [
            {
                title: "Crystal Chandelier",
                category: "decoration",
                subcategory: "lighting",
                description: "Elegant crystal chandelier to create a sophisticated atmosphere for your event."
            },
            {
                title: "Gourmet Appetizers",
                category: "food",
                subcategory: "appetizers",
                description: "Premium selection of gourmet appetizers to delight your guests."
            },
            {
                title: "Live Band",
                category: "service",
                subcategory: "entertainment",
                description: "Professional live band to provide entertainment throughout your event."
            }
        ];
        
        const servicesHtml = exampleItems.map(item => {
            const categoryIcon = getCategoryIcon(item.category);
            const categoryName = item.category.charAt(0).toUpperCase() + item.category.slice(1);
            
            return `
                <div class="service-item">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="${categoryIcon}"></i>
                        </div>
                        <div>
                            <h4 class="service-title">${item.title}</h4>
                            <p class="service-category">${categoryName} • ${item.subcategory.charAt(0).toUpperCase() + item.subcategory.slice(1)}</p>
                        </div>
                    </div>
                    <p class="service-description">${item.description}</p>
                </div>
            `;
        }).join('');
        
        servicesGrid.html(servicesHtml);
        return;
    }
    
    const servicesHtml = selectedItems.map(item => {
        const categoryIcon = getCategoryIcon(item.category);
        const categoryName = item.category.charAt(0).toUpperCase() + item.category.slice(1);
        
        return `
            <div class="service-item">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="${categoryIcon}"></i>
                    </div>
                    <div>
                        <h4 class="service-title">${item.title}</h4>
                        <p class="service-category">${categoryName} • ${item.subcategory.charAt(0).toUpperCase() + item.subcategory.slice(1)}</p>
                    </div>
                </div>
                <p class="service-description">${item.description}</p>
            </div>
        `;
    }).join('');
    
    servicesGrid.html(servicesHtml);
}

// Get Category Icon
function getCategoryIcon(category) {
    const icons = {
        'decoration': 'fas fa-palette',
        'food': 'fas fa-utensils',
        'service': 'fas fa-concierge-bell'
    };
    return icons[category] || 'fas fa-star';
}

// Calculate and Display Costs
function calculateAndDisplayCosts(selectedItems, guestCount, needCatering) {
    const guestCountNum = parseInt(guestCount);
    const needCateringBool = needCatering === 'true';
    
    // Base costs per category
    const baseCosts = {
        decoration: 500,
        food: 25, // per guest
        service: 800
    };
    
    // Calculate costs by category
    const categoryCounts = {};
    
    // If no items selected, use example items for cost calculation
    if (selectedItems.length === 0) {
        categoryCounts.decoration = 1; // Crystal Chandelier
        categoryCounts.food = 1; // Gourmet Appetizers
        categoryCounts.service = 1; // Live Band
    } else {
        selectedItems.forEach(item => {
            categoryCounts[item.category] = (categoryCounts[item.category] || 0) + 1;
        });
    }
    
    let decorationCost = (categoryCounts.decoration || 0) * baseCosts.decoration;
    let foodCost = guestCountNum * baseCosts.food;
    let serviceCost = (categoryCounts.service || 0) * baseCosts.service;
    let staffingCost = needCateringBool ? guestCountNum * 15 : 0;
    
    // Apply multipliers for multiple items
    if (categoryCounts.decoration > 1) decorationCost *= 0.9; // 10% discount for multiple decorations
    if (categoryCounts.service > 1) serviceCost *= 0.85; // 15% discount for multiple services
    
    // Display costs
    $('#decoration-cost').text(`₹${decorationCost.toLocaleString()}`);
    $('#food-cost').text(`₹${foodCost.toLocaleString()}`);
    $('#service-cost').text(`₹${serviceCost.toLocaleString()}`);
    $('#staffing-cost').text(`₹${staffingCost.toLocaleString()}`);
    
    // Calculate and display total
    const totalCost = decorationCost + foodCost + serviceCost + staffingCost;
    $('#total-cost').text(`₹${totalCost.toLocaleString()}`);
    
    // Store costs for potential use
    localStorage.setItem('estimatedCosts', JSON.stringify({
        decoration: decorationCost,
        food: foodCost,
        service: serviceCost,
        staffing: staffingCost,
        total: totalCost
    }));
}

// Setup Button Interactions
function setupButtonInteractions() {
    // Contact Us Button
    $('#contact-btn').on('click', function() {
        const btn = $(this);
        const originalText = btn.html();
        
        btn.html('<span class="loading"></span> Connecting...');
        btn.prop('disabled', true);
        
        setTimeout(() => {
            btn.html('<i class="fas fa-check success-checkmark"></i> Connected!');
            setTimeout(() => {
                btn.html(originalText);
                btn.prop('disabled', false);
                showNotification('We\'ll contact you within 24 hours!', 'success');
            }, 2000);
        }, 1500);
    });
    
    // Modify Selection Button
    $('#modify-btn').on('click', function() {
        window.location.href = 'event-selection.html';
    });
    
    // Download PDF Button
    $('#download-btn').on('click', function() {
        const btn = $(this);
        const originalText = btn.html();
        
        btn.html('<span class="loading"></span> Generating PDF...');
        btn.prop('disabled', true);
        
        setTimeout(() => {
            btn.html('<i class="fas fa-check success-checkmark"></i> Downloaded!');
            setTimeout(() => {
                btn.html(originalText);
                btn.prop('disabled', false);
                showNotification('PDF downloaded successfully!', 'success');
            }, 2000);
        }, 2000);
    });
    
    // Print Now Button
    $('#print-btn').on('click', function() {
        const btn = $(this);
        const originalText = btn.html();
        
        btn.html('<span class="loading"></span> Preparing...');
        btn.prop('disabled', true);
        
        setTimeout(() => {
            btn.html('<i class="fas fa-check success-checkmark"></i> Printed!');
            setTimeout(() => {
                btn.html(originalText);
                btn.prop('disabled', false);
                showNotification('Print dialog opened!', 'success');
            }, 2000);
        }, 1000);
        
        // Open print dialog
        window.print();
    });
    
    // Print Now Button
    $('#print-btn').on('click', function() {
        const btn = $(this);
        const originalText = btn.html();
        
        btn.html('<span class="loading"></span> Preparing...');
        btn.prop('disabled', true);
        
        setTimeout(() => {
            btn.html('<i class="fas fa-check success-checkmark"></i> Printed!');
            setTimeout(() => {
                btn.html(originalText);
                btn.prop('disabled', false);
                showNotification('Print dialog opened!', 'success');
            }, 2000);
        }, 1000);
        
        // Open print dialog
        window.print();
    });
}

// Setup Contact Form
function setupContactForm() {
    // Contact form functionality can be added here if needed
}

// Email Validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Fade In Animation
function addFadeInAnimation() {
    const elements = $('.result-card, .action-card, .contact-card, .detail-section');
    
    elements.each(function(index) {
        $(this).addClass('fade-in');
        
        setTimeout(() => {
            $(this).addClass('visible');
        }, index * 100);
    });
}

// Notification System
function showNotification(message, type = 'info') {
    // Remove existing notifications
    $('.notification').remove();
    
    // Create notification element
    const notification = $(`
        <div class="notification notification-${type}">
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        </div>
    `);
    
    // Add to page
    $('body').append(notification);
    
    // Show notification
    setTimeout(() => {
        notification.addClass('show');
    }, 100);
    
    // Auto hide after 4 seconds
    setTimeout(() => {
        hideNotification(notification);
    }, 4000);
    
    // Close button functionality
    notification.find('.notification-close').on('click', function() {
        hideNotification(notification);
    });
}

function hideNotification(notification) {
    notification.removeClass('show');
    setTimeout(() => {
        notification.remove();
    }, 300);
}

// Add notification styles dynamically
const notificationStyles = `
<style>
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 1rem;
    z-index: 9999;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    max-width: 350px;
}

.notification.show {
    transform: translateX(0);
}

.notification-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.notification-message {
    flex: 1;
    font-size: 0.9rem;
    color: #333;
}

.notification-close {
    background: none;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    color: #666;
    padding: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification-close:hover {
    color: #333;
}

.notification-success {
    border-left: 4px solid #28a745;
}

.notification-error {
    border-left: 4px solid #dc3545;
}

.notification-info {
    border-left: 4px solid #17a2b8;
}

@media (max-width: 576px) {
    .notification {
        top: 10px;
        right: 10px;
        left: 10px;
        max-width: none;
    }
}
</style>
`;

$('head').append(notificationStyles);

// Keyboard Navigation
$(document).on('keydown', function(e) {
    // Escape key to close notifications
    if (e.key === 'Escape') {
        $('.notification').each(function() {
            hideNotification($(this));
        });
    }
});

// Smooth scrolling for anchor links
$('a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    const target = $(this.getAttribute('href'));
    if (target.length) {
        $('html, body').animate({
            scrollTop: target.offset().top - 80
        }, 600);
    }
});

// Hover effects for service items
$('.service-item').on('mouseenter', function() {
    $(this).addClass('hovered');
}).on('mouseleave', function() {
    $(this).removeClass('hovered');
});

// Print functionality
function printEstimation() {
    window.print();
}

// Export to PDF (placeholder function)
function exportToPDF() {
    // This would integrate with a PDF library like jsPDF
    console.log('Exporting to PDF...');
    showNotification('PDF export feature coming soon!', 'info');
}

// Share functionality
function shareEstimation() {
    if (navigator.share) {
        navigator.share({
            title: 'Event Estimation - Event Team',
            text: 'Check out my event estimation from Event Team!',
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            showNotification('Link copied to clipboard!', 'success');
        });
    }
}

// Auto-save estimation data
function saveEstimationData() {
    const estimationData = {
        timestamp: new Date().toISOString(),
        guestCount: $('#guest-count-display').text(),
        needCatering: $('#catering-display').text(),
        selectedItems: JSON.parse(localStorage.getItem('selectedEventItems') || '[]'),
        estimatedCosts: JSON.parse(localStorage.getItem('estimatedCosts') || '{}')
    };
    
    localStorage.setItem('lastEstimation', JSON.stringify(estimationData));
}

// Load estimation data from localStorage
function loadEstimationFromStorage() {
    const savedEstimation = localStorage.getItem('lastEstimation');
    if (savedEstimation) {
        return JSON.parse(savedEstimation);
    }
    return null;
}

// Initialize page with saved data if available
$(document).ready(function() {
    const savedEstimation = loadEstimationFromStorage();
    if (savedEstimation) {
        // Use saved data if no URL parameters are present
        if (!window.location.search) {
            displayEventDetails(savedEstimation.guestCount, savedEstimation.needCatering === 'Yes' ? 'true' : 'false');
            displaySelectedServices(savedEstimation.selectedItems);
            calculateAndDisplayCosts(savedEstimation.selectedItems, savedEstimation.guestCount, savedEstimation.needCatering === 'Yes' ? 'true' : 'false');
        }
    }
    
    // Auto-save when page loads
    saveEstimationData();
});
