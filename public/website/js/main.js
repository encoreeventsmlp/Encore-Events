/**
 * Main JavaScript file for Starter Project
 * Includes jQuery functionality and Bootstrap interactions
 */

$(document).ready(function () {
  // Initialize all components
  initializeNavigation();
  initializeAnimations();
  initializeFormHandling();
  initializeDemoButton();
  initializeScrollEffects();
  initializeHeroGallery();
  initializeTrendsNavigation();
  initializeTestimonialsNavigation();
  initializeTeamNavigation();
  initializeScrollAnimations();
});

/**
 * Initialize hero gallery
 */
function initializeHeroGallery() {
  const gallery = document.querySelector('.gallery-scroll');
  if (gallery) {
    // Pause animation on hover
    gallery.addEventListener('mouseenter', function () {
      this.style.animationPlayState = 'paused';
    });

    // Resume animation when not hovering
    gallery.addEventListener('mouseleave', function () {
      this.style.animationPlayState = 'running';
    });
  }
}

/**
 * Scroll to services section
 */
function scrollToServices() {
  const servicesSection = document.getElementById('services');
  if (servicesSection) {
    servicesSection.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  }
}

/**
 * Scroll trends gallery left
 */
function scrollTrendsLeft() {
  const trendsRow = document.querySelector('.trends-section .row.g-4');
  if (trendsRow) {
    const scrollAmount = 300; // Adjust based on your needs
    trendsRow.scrollBy({
      left: -scrollAmount,
      behavior: 'smooth'
    });
    updateTrendsNavigation();
  }
}

/**
 * Scroll trends gallery right
 */
function scrollTrendsRight() {
  const trendsRow = document.querySelector('.trends-section .row.g-4');
  if (trendsRow) {
    const scrollAmount = 300; // Adjust based on your needs
    trendsRow.scrollBy({
      left: scrollAmount,
      behavior: 'smooth'
    });
    updateTrendsNavigation();
  }
}

/**
 * Update trends navigation button states
 */
function updateTrendsNavigation() {
  const trendsRow = document.querySelector('.trends-section .row.g-4');
  const leftBtn = document.querySelector('.nav-button-left');
  const rightBtn = document.querySelector('.nav-button-right');

  if (trendsRow && leftBtn && rightBtn) {
    // Check if we can scroll left
    if (trendsRow.scrollLeft <= 0) {
      leftBtn.disabled = true;
    } else {
      leftBtn.disabled = false;
    }

    // Check if we can scroll right
    if (trendsRow.scrollLeft >= trendsRow.scrollWidth - trendsRow.clientWidth) {
      rightBtn.disabled = true;
    } else {
      rightBtn.disabled = false;
    }
  }
}

/**
 * Initialize trends navigation
 */
function initializeTrendsNavigation() {
  const trendsRow = document.querySelector('.trends-section .row.g-4');
  if (trendsRow) {
    // Initial button state update
    updateTrendsNavigation();

    // Update button states on scroll
    trendsRow.addEventListener('scroll', updateTrendsNavigation);

    // Update button states on window resize
    window.addEventListener('resize', updateTrendsNavigation);

    // Auto-scroll functionality
    let autoScrollInterval;

    function startAutoScroll() {
      autoScrollInterval = setInterval(() => {
        const trendsRow = document.querySelector('.trends-section .row.g-4');
        if (trendsRow) {
          const maxScroll = trendsRow.scrollWidth - trendsRow.clientWidth;
          if (trendsRow.scrollLeft >= maxScroll) {
            // Reset to beginning
            trendsRow.scrollTo({
              left: 0,
              behavior: 'smooth'
            });
          } else {
            // Scroll right
            scrollTrendsRight();
          }
        }
      }, 3000); // Auto-scroll every 3 seconds
    }

    function stopAutoScroll() {
      if (autoScrollInterval) {
        clearInterval(autoScrollInterval);
      }
    }

    // Start auto-scroll when page loads
    startAutoScroll();

    // Pause auto-scroll on hover
    trendsRow.addEventListener('mouseenter', stopAutoScroll);
    trendsRow.addEventListener('mouseleave', startAutoScroll);

    // Pause auto-scroll on touch
    trendsRow.addEventListener('touchstart', stopAutoScroll);
    trendsRow.addEventListener('touchend', () => {
      setTimeout(startAutoScroll, 2000); // Resume after 2 seconds
    });
  }
}

/**
 * Scroll testimonials left
 */
function scrollTestimonialsLeft() {
  const testimonialsRow = document.querySelector('.testimonials-row');
  if (testimonialsRow) {
    const scrollAmount = 400; // Adjust based on your needs
    testimonialsRow.scrollBy({
      left: -scrollAmount,
      behavior: 'smooth'
    });
    updateTestimonialsNavigation();
  }
}

/**
 * Scroll testimonials right
 */
function scrollTestimonialsRight() {
  const testimonialsRow = document.querySelector('.testimonials-row');
  if (testimonialsRow) {
    const scrollAmount = 400; // Adjust based on your needs
    testimonialsRow.scrollBy({
      left: scrollAmount,
      behavior: 'smooth'
    });
    updateTestimonialsNavigation();
  }
}

/**
 * Update testimonials navigation button states
 */
function updateTestimonialsNavigation() {
  const testimonialsRow = document.querySelector('.testimonials-row');
  const leftBtn = document.querySelector('.testimonial-nav-left');
  const rightBtn = document.querySelector('.testimonial-nav-right');

  if (testimonialsRow && leftBtn && rightBtn) {
    // Check if we can scroll left
    if (testimonialsRow.scrollLeft <= 0) {
      leftBtn.disabled = true;
    } else {
      leftBtn.disabled = false;
    }

    // Check if we can scroll right
    if (testimonialsRow.scrollLeft >= testimonialsRow.scrollWidth - testimonialsRow.clientWidth) {
      rightBtn.disabled = true;
    } else {
      rightBtn.disabled = false;
    }
  }
}

/**
 * Initialize testimonials navigation
 */
function initializeTestimonialsNavigation() {
  const testimonialsRow = document.querySelector('.testimonials-row');
  if (testimonialsRow) {
    // Initial button state update
    updateTestimonialsNavigation();

    // Update button states on scroll
    testimonialsRow.addEventListener('scroll', updateTestimonialsNavigation);

    // Update button states on window resize
    window.addEventListener('resize', updateTestimonialsNavigation);

    // Auto-scroll functionality
    let autoScrollInterval;

    function startAutoScroll() {
      autoScrollInterval = setInterval(() => {
        const testimonialsRow = document.querySelector('.testimonials-row');
        if (testimonialsRow) {
          const maxScroll = testimonialsRow.scrollWidth - testimonialsRow.clientWidth;
          if (testimonialsRow.scrollLeft >= maxScroll) {
            // Reset to beginning
            testimonialsRow.scrollTo({
              left: 0,
              behavior: 'smooth'
            });
          } else {
            // Scroll right
            scrollTestimonialsRight();
          }
        }
      }, 3000); // Auto-scroll every 3 seconds
    }

    function stopAutoScroll() {
      if (autoScrollInterval) {
        clearInterval(autoScrollInterval);
      }
    }

    // Start auto-scroll when page loads
    startAutoScroll();

    // Pause auto-scroll on hover
    testimonialsRow.addEventListener('mouseenter', stopAutoScroll);
    testimonialsRow.addEventListener('mouseleave', startAutoScroll);

    // Pause auto-scroll on touch
    testimonialsRow.addEventListener('touchstart', stopAutoScroll);
    testimonialsRow.addEventListener('touchend', () => {
      setTimeout(startAutoScroll, 2000); // Resume after 2 seconds
    });
  }
}

/**
 * Scroll team carousel left
 */
function scrollTeamLeft() {
  const teamMembers = document.getElementById('teamMembers');
  if (teamMembers) {
    const scrollAmount = 270; // Width of one team member + gap
    teamMembers.scrollBy({
      left: -scrollAmount,
      behavior: 'smooth'
    });
    updateTeamNavigation();
  }
}

/**
 * Scroll team carousel right
 */
function scrollTeamRight() {
  const teamMembers = document.getElementById('teamMembers');
  if (teamMembers) {
    const scrollAmount = 270; // Width of one team member + gap
    teamMembers.scrollBy({
      left: scrollAmount,
      behavior: 'smooth'
    });
    updateTeamNavigation();
  }
}

/**
 * Update team navigation button states
 */
function updateTeamNavigation() {
  const teamMembers = document.getElementById('teamMembers');
  const leftBtn = document.querySelector('.team-nav-left');
  const rightBtn = document.querySelector('.team-nav-right');

  if (teamMembers && leftBtn && rightBtn) {
    // Check if we can scroll left
    if (teamMembers.scrollLeft <= 0) {
      leftBtn.disabled = true;
      leftBtn.style.opacity = '0.5';
    } else {
      leftBtn.disabled = false;
      leftBtn.style.opacity = '1';
    }

    // Check if we can scroll right
    if (teamMembers.scrollLeft >= teamMembers.scrollWidth - teamMembers.clientWidth) {
      rightBtn.disabled = true;
      rightBtn.style.opacity = '0.5';
    } else {
      rightBtn.disabled = false;
      rightBtn.style.opacity = '1';
    }
  }
}

/**
 * Initialize team navigation
 */
function initializeTeamNavigation() {
  const teamMembers = document.getElementById('teamMembers');
  if (teamMembers) {
    // Initial button state update
    updateTeamNavigation();

    // Update button states on scroll
    teamMembers.addEventListener('scroll', updateTeamNavigation);

    // Update button states on window resize
    window.addEventListener('resize', updateTeamNavigation);

    // Add touch/swipe support for mobile
    let startX = 0;
    let scrollLeft = 0;

    teamMembers.addEventListener('touchstart', e => {
      startX = e.touches[0].pageX - teamMembers.offsetLeft;
      scrollLeft = teamMembers.scrollLeft;
    });

    teamMembers.addEventListener('touchmove', e => {
      e.preventDefault();
      const x = e.touches[0].pageX - teamMembers.offsetLeft;
      const walk = (x - startX) * 2; // Scroll speed multiplier
      teamMembers.scrollLeft = scrollLeft - walk;
    });

    // Auto-scroll functionality (optional)
    let autoScrollInterval;

    function startAutoScroll() {
      autoScrollInterval = setInterval(() => {
        const teamMembers = document.getElementById('teamMembers');
        if (teamMembers) {
          const maxScroll = teamMembers.scrollWidth - teamMembers.clientWidth;
          if (teamMembers.scrollLeft >= maxScroll) {
            // Reset to beginning
            teamMembers.scrollTo({
              left: 0,
              behavior: 'smooth'
            });
          } else {
            // Scroll right
            scrollTeamRight();
          }
        }
      }, 3000); // Auto-scroll every 3 seconds
    }

    function stopAutoScroll() {
      if (autoScrollInterval) {
        clearInterval(autoScrollInterval);
      }
    }

    // Start auto-scroll when page loads
    startAutoScroll();

    // Pause auto-scroll on hover
    teamMembers.addEventListener('mouseenter', stopAutoScroll);
    teamMembers.addEventListener('mouseleave', startAutoScroll);

    // Pause auto-scroll on touch
    teamMembers.addEventListener('touchstart', stopAutoScroll);
    teamMembers.addEventListener('touchend', () => {
      setTimeout(startAutoScroll, 2000); // Resume after 2 seconds
    });
  }
}

/**
 * Navigation functionality
 */
function initializeNavigation() {
  // Smooth scrolling for navigation links
  $('.navbar-nav a[href^="#"]').on('click', function (e) {
    e.preventDefault();

    const target = $(this.getAttribute('href'));
    if (target.length) {
      $('html, body').animate(
        {
          scrollTop: target.offset().top - 70 // Account for navbar height
        },
        800,
        'easeInOutQuad'
      );

      // Update active nav item
      $('.navbar-nav .nav-link').removeClass('active');
      $(this).addClass('active');

      // Close mobile menu if open
      $('.navbar-collapse').collapse('hide');
    }
  });

  // Update active nav item on scroll
  $(window).on('scroll', function () {
    updateActiveNavItem();
  });
}

/**
 * Update active navigation item based on scroll position
 */
function updateActiveNavItem() {
  const scrollPos = $(window).scrollTop() + 100;

  $('.navbar-nav a[href^="#"]').each(function () {
    const target = $(this.getAttribute('href'));
    if (target.length && target.offset().top <= scrollPos && target.offset().top + target.outerHeight() > scrollPos) {
      $('.navbar-nav .nav-link').removeClass('active');
      $(this).addClass('active');
    }
  });
}

/**
 * Initialize scroll animations
 */
function initializeAnimations() {
  // Add fade-in class to elements that should animate
  $('.card, .hero-section h1, .hero-section .lead').addClass('fade-in');

  // Trigger animations on scroll
  $(window).on('scroll', function () {
    $('.fade-in').each(function () {
      const elementTop = $(this).offset().top;
      const elementBottom = elementTop + $(this).outerHeight();
      const viewportTop = $(window).scrollTop();
      const viewportBottom = viewportTop + $(window).height();

      if (elementBottom > viewportTop && elementTop < viewportBottom) {
        $(this).addClass('visible');
      }
    });
  });

  // Trigger initial animation check
  $(window).trigger('scroll');
}

/**
 * Form handling functionality
 */
function initializeFormHandling() {
  $('#contact-form').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const submitBtn = form.find('button[type="submit"]');
    const originalText = submitBtn.html();

    // Show loading state
    submitBtn.html('<span class="loading"></span> Sending...');
    submitBtn.prop('disabled', true);

    // Simulate form submission (replace with actual API call)
    setTimeout(function () {
      // Get form data
      const formData = {
        name: $('#name').val(),
        email: $('#email').val(),
        message: $('#message').val()
      };

      console.log('Form submitted with data:', formData);

      // Show success message
      showAlert('success', "Message sent successfully! We'll get back to you soon.");

      // Reset form
      form[0].reset();

      // Reset button
      submitBtn.html(originalText);
      submitBtn.prop('disabled', false);
    }, 2000); // Simulate 2 second delay
  });
}

/**
 * Demo button functionality
 */
function initializeDemoButton() {
  $('#demo-btn').on('click', function () {
    const btn = $(this);
    const originalText = btn.html();

    // Animate button
    btn.addClass('btn-success').html('<i class="bi bi-check-circle"></i> Demo Clicked!');

    // Show demo alert
    showAlert('info', 'This is a demo button! You can customize this functionality in js/main.js');

    // Reset button after 3 seconds
    setTimeout(function () {
      btn.removeClass('btn-success').html(originalText);
    }, 3000);
  });
}

/**
 * Initialize scroll effects
 */
function initializeScrollEffects() {
  // Navbar background change on scroll
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 50) {
      $('.navbar').addClass('navbar-scrolled');
    } else {
      $('.navbar').removeClass('navbar-scrolled');
    }
  });

  // Back to top button (create dynamically)
  createBackToTopButton();
}

/**
 * Create and manage back to top button
 */
function createBackToTopButton() {
  // Create button
  const backToTopBtn = $(`
        <button id="back-to-top" class="btn btn-primary position-fixed" style="
            bottom: 20px; 
            right: 20px; 
            z-index: 1000; 
            border-radius: 50%; 
            height: 50px; 
            display: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        ">
            <i class="bi bi-arrow-up"></i>
        </button>
    `);

  $('body').append(backToTopBtn);

  // Show/hide button based on scroll position
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 300) {
      $('#back-to-top').fadeIn();
    } else {
      $('#back-to-top').fadeOut();
    }
  });

  // Smooth scroll to top
  $('#back-to-top').on('click', function () {
    $('html, body').animate({ scrollTop: 0 }, 800);
  });
}

/**
 * Show alert messages
 * @param {string} type - Alert type (success, danger, warning, info)
 * @param {string} message - Alert message
 */
function showAlert(type, message) {
  const alertId = 'alert-' + Date.now();
  const alertHtml = `
        <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show position-fixed" 
             style="top: 20px; right: 20px; z-index: 1050; max-width: 350px;">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

  $('body').append(alertHtml);

  // Auto-dismiss after 5 seconds
  setTimeout(function () {
    $('#' + alertId).alert('close');
  }, 5000);
}

/**
 * Utility function to get URL parameters
 * @param {string} name - Parameter name
 * @returns {string|null} Parameter value
 */
function getUrlParameter(name) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(name);
}

/**
 * Utility function to format dates
 * @param {Date} date - Date object
 * @returns {string} Formatted date string
 */
function formatDate(date) {
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
}

/**
 * Utility function for API calls
 * @param {string} url - API endpoint
 * @param {Object} options - Request options
 * @returns {Promise} jQuery AJAX promise
 */
function apiCall(url, options = {}) {
  const defaultOptions = {
    type: 'GET',
    dataType: 'json',
    timeout: 10000,
    error: function (xhr, status, error) {
      console.error('API call failed:', error);
      showAlert('danger', 'Something went wrong. Please try again.');
    }
  };

  return $.ajax(url, { ...defaultOptions, ...options });
}

/**
 * Initialize tooltips and popovers (Bootstrap components)
 */
function initializeBootstrapComponents() {
  // Initialize tooltips
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Initialize popovers
  const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });
}

/**
 * Initialize when DOM is ready
 */
$(document).ready(function () {
  initializeBootstrapComponents();
});

// Custom easing function for jQuery animations
$.extend($.easing, {
  easeInOutQuad: function (x, t, b, c, d) {
    if ((t /= d / 2) < 1) return (c / 2) * t * t + b;
    return (-c / 2) * (--t * (t - 2) - 1) + b;
  }
});

// Export functions for global access (if needed)
window.StarterProject = {
  showAlert,
  getUrlParameter,
  formatDate,
  apiCall,
  initializeScrollAnimations
};

/**
 * Initialize scroll-triggered animations
 */
function initializeScrollAnimations() {
  // Create intersection observer for scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate');
      }
    });
  }, observerOptions);

  // Observe all elements with animation classes
  const animatedElements = document.querySelectorAll(
    '.fade-in-up, .fade-in-left, .fade-in-right, .scale-in, .slide-in-bottom'
  );

  animatedElements.forEach(element => {
    observer.observe(element);
  });

  // Add staggered animation to testimonial cards
  const testimonialCards = document.querySelectorAll('.testimonial-card');
  testimonialCards.forEach((card, index) => {
    card.classList.add('fade-in-up');
    card.style.transitionDelay = `${index * 0.2}s`;
    observer.observe(card);
  });

  // Add staggered animation to trend items
  const trendItems = document.querySelectorAll('.trend-item');
  trendItems.forEach((item, index) => {
    item.classList.add('scale-in');
    item.style.transitionDelay = `${index * 0.15}s`;
    observer.observe(item);
  });
}
