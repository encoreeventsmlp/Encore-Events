// ===================================
// Login Page JavaScript
// ===================================

$(document).ready(function () {
    // Initialize the page
    initializeLoginPage();

    // Add fade-in animation to elements
    addFadeInAnimation();
});

// Initialize Login Page
function initializeLoginPage() {
    // Tab switching functionality
    setupTabSwitching();

    // Form validation
    setupFormValidation();

    // Form submission
    setupFormSubmission();

    // Input focus effects
    setupInputEffects();

    // Setup date input constraints
    setupDateInputConstraints();
}

// Tab Switching Functionality
function setupTabSwitching() {
    const loginTab = $('#login-tab');
    const registerTab = $('#register-tab');
    const loginForm = $('#login-form');
    const registerForm = $('#register-form');

    // Login tab click
    loginTab.on('click', function () {
        if (!$(this).hasClass('active')) {
            // Add smooth transition class to container
            $('.tab-content-container').addClass('transitioning');

            // Switch tabs with smooth animation
            $(this).addClass('active');
            registerTab.removeClass('active');

            // Switch forms with smooth transitions
            setTimeout(() => {
                loginForm.removeClass('tab-hidden').addClass('tab-active');
                registerForm.removeClass('tab-active').addClass('tab-hidden');

                // Update button text
                $('.btn-login').text('Login');

                // Remove transition class after animation completes
                setTimeout(() => {
                    $('.tab-content-container').removeClass('transitioning');
                }, 100);
            }, 50);
        }
    });

    // Register tab click
    registerTab.on('click', function () {
        if (!$(this).hasClass('active')) {
            // Add smooth transition class to container
            $('.tab-content-container').addClass('transitioning');

            // Switch tabs with smooth animation
            $(this).addClass('active');
            loginTab.removeClass('active');

            // Switch forms with smooth transitions
            setTimeout(() => {
                registerForm.removeClass('tab-hidden').addClass('tab-active');
                loginForm.removeClass('tab-active').addClass('tab-hidden');

                // Update button text
                $('.btn-login').text('Register');

                // Remove transition class after animation completes
                setTimeout(() => {
                    $('.tab-content-container').removeClass('transitioning');
                }, 100);
            }, 50);
        }
    });
}

// Form Validation Setup
function setupFormValidation() {
    // Real-time validation for login form
    $('#phone').on('input', function () {
        validatePhoneNumber($(this));
    });

    // Real-time validation for register form
    $('#reg-username').on('input', function () {
        validateName($(this));
    });

    $('#reg-phone').on('input', function () {
        validatePhoneNumber($(this));
    });

    $('#reg-event-date').on('change', function () {
        validateEventDate($(this));
    });

    $('#reg-state').on('change', function () {
        validateState($(this));
    });
}

// Validation Functions
function validatePhoneNumber(input) {
    const phone = input.val().replace(/\D/g, '');
    const isValid = phone.length >= 10;

    if (isValid) {
        input.removeClass('is-invalid').addClass('is-valid');
        removeFeedback(input);
    } else {
        input.removeClass('is-valid').addClass('is-invalid');
        addFeedback(input, 'Please enter a valid phone number');
    }

    return isValid;
}

function validatePassword(input) {
    const password = input.val();
    const isValid = password.length >= 6;

    if (isValid) {
        input.removeClass('is-invalid').addClass('is-valid');
        removeFeedback(input);
    } else {
        input.removeClass('is-valid').addClass('is-invalid');
        addFeedback(input, 'Password must be at least 6 characters');
    }

    return isValid;
}

function validateName(input) {
    const name = input.val() ? input.val().trim() : '';
    const isValid = name.length >= 2;

    if (isValid) {
        input.removeClass('is-invalid').addClass('is-valid');
        removeFeedback(input);
    } else {
        input.removeClass('is-valid').addClass('is-invalid');
        addFeedback(input, 'Please enter your full name');
    }

    return isValid;
}

function validateEmail(input) {
    const email = input.val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const isValid = emailRegex.test(email);

    if (isValid) {
        input.removeClass('is-invalid').addClass('is-valid');
        removeFeedback(input);
    } else {
        input.removeClass('is-valid').addClass('is-invalid');
        addFeedback(input, 'Please enter a valid email address');
    }

    return isValid;
}

function validateEventDate(input) {
    const date = input.val();
    if (!date) {
        input.removeClass('is-valid').addClass('is-invalid');
        addFeedback(input, 'Please select an event date');
        return false;
    }

    const selectedDate = new Date(date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    // Allow dates from 1 year ago to 5 years in the future
    const minDate = new Date();
    minDate.setFullYear(today.getFullYear() - 1);
    minDate.setHours(0, 0, 0, 0);

    const maxDate = new Date();
    maxDate.setFullYear(today.getFullYear() + 5);
    maxDate.setHours(0, 0, 0, 0);

    const isValid = selectedDate >= minDate && selectedDate <= maxDate;

    if (isValid) {
        input.removeClass('is-invalid').addClass('is-valid');
        removeFeedback(input);
    } else {
        input.removeClass('is-valid').addClass('is-invalid');
        if (selectedDate < minDate) {
            addFeedback(input, 'Event date cannot be more than 1 year in the past');
        } else if (selectedDate > maxDate) {
            addFeedback(input, 'Event date cannot be more than 5 years in the future');
        } else {
            addFeedback(input, 'Please select a valid event date');
        }
    }

    return isValid;
}

function validateDistrict(input) {
    const district = input.val();
    const isValid = district && district !== '';

    if (isValid) {
        input.removeClass('is-invalid').addClass('is-valid');
        removeFeedback(input);
    } else {
        input.removeClass('is-valid').addClass('is-invalid');
        addFeedback(input, 'Please select a location');
    }

    return isValid;
}

function validateConfirmPassword(input) {
    const password = $('#reg-password').val();
    const confirmPassword = input.val();
    const isValid = password === confirmPassword && confirmPassword.length >= 6;

    if (isValid) {
        input.removeClass('is-invalid').addClass('is-valid');
        removeFeedback(input);
    } else {
        input.removeClass('is-valid').addClass('is-invalid');
        addFeedback(input, 'Passwords do not match');
    }

    return isValid;
}

// Helper Functions for Validation
function addFeedback(input, message) {
    removeFeedback(input);
    input.after(`<div class="invalid-feedback">${message}</div>`);
}

function removeFeedback(input) {
    input.siblings('.invalid-feedback, .valid-feedback').remove();
}

// Form Submission Setup
function setupFormSubmission() {
    // Login form submission - allow natural submission
    $('#login-form').on('submit', function (e) {
        // Add loading state to button
        const button = $(this).find('button[type="submit"]');
        button.addClass('loading').prop('disabled', true);

        // Let the form submit naturally - don't prevent default
        // The loading state will be reset when the page reloads or redirects
    });

    // Register form submission - allow natural submission
    $('#register-form').on('submit', function (e) {
        // Add loading state to button
        const button = $(this).find('button[type="submit"]');
        button.addClass('loading').prop('disabled', true);

        // Let the form submit naturally - don't prevent default
        // The loading state will be reset when the page reloads or redirects
    });
}

// Form submission is now handled naturally by the server
// The loading state is added on form submit and will be reset when the page reloads

// Input Effects Setup
function setupInputEffects() {
    // Add focus effects
    $('.form-control').on('focus', function () {
        $(this).parent().addClass('focused');
    });

    $('.form-control').on('blur', function () {
        $(this).parent().removeClass('focused');
    });

    // Add floating label effect
    $('.form-control').on('input', function () {
        if ($(this).val()) {
            $(this).addClass('has-value');
        } else {
            $(this).removeClass('has-value');
        }
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

    // Auto hide after 5 seconds
    setTimeout(() => {
        hideNotification(notification);
    }, 5000);

    // Close button functionality
    notification.find('.notification-close').on('click', function () {
        hideNotification(notification);
    });
}

function hideNotification(notification) {
    notification.removeClass('show');
    setTimeout(() => {
        notification.remove();
    }, 300);
}

// Fade In Animation
function addFadeInAnimation() {
    const elements = $('.form-container > *');

    elements.each(function (index) {
        $(this).addClass('fade-in');

        setTimeout(() => {
            $(this).addClass('visible');
        }, index * 100);
    });
}

// Phone number formatting
function formatPhoneNumber(input) {
    let value = input.val().replace(/\D/g, '');

    if (value.length >= 6) {
        value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    } else if (value.length >= 3) {
        value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
    }

    input.val(value);
}

// Phone formatting removed - no phone field in current form

// Setup date input constraints
function setupDateInputConstraints() {
    const dateInput = $('#event_date');
    if (dateInput.length) {
        const today = new Date();

        // Set minimum date to tomorrow
        const minDate = new Date();
        minDate.setDate(today.getDate() + 1);
        minDate.setHours(0, 0, 0, 0);

        // Set maximum date to 5 years in the future
        const maxDate = new Date();
        maxDate.setFullYear(today.getFullYear() + 5);
        maxDate.setHours(0, 0, 0, 0);

        // Format dates for HTML date input (YYYY-MM-DD)
        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };

        dateInput.attr('min', formatDate(minDate));
        dateInput.attr('max', formatDate(maxDate));
    }
}

// Keyboard navigation
$(document).on('keydown', function (e) {
    // Tab key navigation
    if (e.key === 'Tab') {
        const activeElement = document.activeElement;
        const isFormControl = $(activeElement).hasClass('form-control');

        if (isFormControl) {
            setTimeout(() => {
                validateFormControl($(activeElement));
            }, 100);
        }
    }

    // Enter key submission - let forms handle naturally
    // No need to prevent default or manually submit
});

// Validate form control on blur
function validateFormControl(input) {
    const type = input.attr('id');

    switch (type) {
        case 'phone':
            validatePhoneNumber(input);
            break;
        case 'password':
        case 'register_password':
            validatePassword(input);
            break;
        case 'register_name':
            validateName(input);
            break;
        case 'event_date':
            validateEventDate(input);
            break;
        case 'district_id':
            validateDistrict(input);
            break;
        case 'register_email':
            validateEmail(input);
            break;
    }
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
