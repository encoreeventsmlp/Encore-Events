// ===================================
// Event Selection Page JavaScript
// ===================================

$(document).ready(function() {
    // Initialize the page
    initializeEventSelection();
    
    // Add fade-in animation to elements
    addFadeInAnimation();
});

// Initialize Event Selection Page
function initializeEventSelection() {
    // Category tab switching
    setupCategoryTabs();
    
    // Initialize with decoration category (default)
    const defaultCategory = 'decoration';
    updateFilterTabs(defaultCategory);
    updateFilterTabText(defaultCategory);
    filterItemsByCategory(defaultCategory);
    
    // Filter functionality
    setupFilterTabs();
    
    // Item selection/deselection
    setupItemSelection();
    
    // Remove item functionality
    setupRemoveItems();
    
    // Initialize selected items data
    initializeSelectedItems();
}

// Category Tab Switching
function setupCategoryTabs() {
    $('.category-tab').on('click', function() {
        const category = $(this).data('category');
        
        // Update active tab
        $('.category-tab').removeClass('active');
        $(this).addClass('active');
        
        // Update filter tabs based on category
        updateFilterTabs(category);
        
        // Filter items by category
        filterItemsByCategory(category);
        
        // Update filter tab text
        updateFilterTabText(category);
    });
}

// Update Filter Tabs Based on Category
function updateFilterTabs(category) {
    const filterTabs = $('.filter-tab');
    
    // Remove all filter tabs
    filterTabs.remove();
    
    // Add new filter tabs based on category
    const filterContainer = $('.filter-tabs');
    
    switch(category) {
        case 'decoration':
            filterContainer.append(`
                <button class="filter-tab active" data-filter="all">All Decorations</button>
                <button class="filter-tab" data-filter="lighting">Lighting</button>
                <button class="filter-tab" data-filter="flowers">Flowers</button>
                <button class="filter-tab" data-filter="textiles">Textiles</button>
            `);
            break;
        case 'food':
            filterContainer.append(`
                <button class="filter-tab active" data-filter="all">All Food</button>
                <button class="filter-tab" data-filter="appetizers">Appetizers</button>
                <button class="filter-tab" data-filter="mains">Main Courses</button>
                <button class="filter-tab" data-filter="desserts">Desserts</button>
            `);
            break;
        case 'service':
            filterContainer.append(`
                <button class="filter-tab active" data-filter="all">All Services</button>
                <button class="filter-tab" data-filter="entertainment">Entertainment</button>
                <button class="filter-tab" data-filter="planning">Planning</button>
                <button class="filter-tab" data-filter="staffing">Staffing</button>
            `);
            break;
    }
    
    // Re-attach filter tab events
    setupFilterTabs();
}

// Update Filter Tab Text
function updateFilterTabText(category) {
    const filterHeader = $('.filter-header h3');
    
    switch(category) {
        case 'decoration':
            filterHeader.text('Filter by Category');
            break;
        case 'food':
            filterHeader.text('Filter by Type');
            break;
        case 'service':
            filterHeader.text('Filter by Service');
            break;
    }
}

// Filter Tabs Setup
function setupFilterTabs() {
    $('.filter-tab').on('click', function() {
        const filter = $(this).data('filter');
        
        // Update active filter tab
        $('.filter-tab').removeClass('active');
        $(this).addClass('active');
        
        // Filter items
        filterItemsBySubcategory(filter);
    });
}

// Filter Items by Category
function filterItemsByCategory(category) {
    $('.item-card').each(function() {
        const itemCategory = $(this).data('category');
        
        if (itemCategory === category) {
            $(this).closest('.col-md-6').show();
        } else {
            $(this).closest('.col-md-6').hide();
        }
    });
}

// Filter Items by Subcategory
function filterItemsBySubcategory(subcategory) {
    // Get the current active category
    const activeCategory = $('.category-tab.active').data('category');
    
    $('.item-card').each(function() {
        const itemCategory = $(this).data('category');
        const itemSubcategory = $(this).data('subcategory');
        
        // Only filter items that belong to the current active category
        if (itemCategory === activeCategory) {
            if (subcategory === 'all' || itemSubcategory === subcategory) {
                $(this).closest('.col-md-6').show();
            } else {
                $(this).closest('.col-md-6').hide();
            }
        }
    });
}

// Item Selection Setup
function setupItemSelection() {
    $(document).on('click', '.select-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const itemCard = $(this).closest('.item-card');
        const isSelected = itemCard.hasClass('selected');
        
        if (isSelected) {
            deselectItem(itemCard);
        } else {
            selectItem(itemCard);
        }
    });
}

// Select Item
function selectItem(itemCard) {
    const itemId = generateItemId(itemCard);
    const itemData = getItemData(itemCard);
    
    // Add selected class
    itemCard.addClass('selected');
    
    // Update select button
    const selectBtn = itemCard.find('.select-btn');
    selectBtn.addClass('selected').html('<i class="fas fa-check"></i>');
    
    // Add selected badge
    if (!itemCard.find('.selected-badge').length) {
        itemCard.find('.card-header').prepend('<span class="selected-badge">Selected</span>');
    }
    
    // Add to selected items
    addToSelectedItems(itemId, itemData);
    
    // Update category count
    updateCategoryCount(itemData.category);
    
    // Update total count only
    updateTotalCount();
}

// Deselect Item
function deselectItem(itemCard) {
    const itemId = generateItemId(itemCard);
    const itemData = getItemData(itemCard);
    
    // Remove selected class
    itemCard.removeClass('selected');
    
    // Update select button
    const selectBtn = itemCard.find('.select-btn');
    selectBtn.removeClass('selected').html('<i class="fas fa-plus"></i>');
    
    // Remove selected badge
    itemCard.find('.selected-badge').remove();
    
    // Remove from selected items
    removeFromSelectedItems(itemId);
    
    // Update category count
    updateCategoryCount(itemData.category);
    
    // Update total count only
    updateTotalCount();
}

// Generate Item ID
function generateItemId(itemCard) {
    const title = itemCard.find('.item-title').text();
    return title.toLowerCase().replace(/\s+/g, '-');
}

// Get Item Data
function getItemData(itemCard) {
    return {
        id: generateItemId(itemCard),
        title: itemCard.find('.item-title').text(),
        description: itemCard.find('.item-description').text(),
        category: itemCard.data('category'),
        subcategory: itemCard.data('subcategory'),
        image: itemCard.find('.card-image img').attr('src'),
        tag: itemCard.find('.item-tag').text()
    };
}

// Add to Selected Items
function addToSelectedItems(itemId, itemData) {
    // Check if item already exists
    if ($(`[data-item-id="${itemId}"]`).length) {
        return;
    }
    
    const selectedItemHtml = `
        <div class="selected-item" data-item-id="${itemId}">
            <div class="item-image">
                <img src="${itemData.image}" alt="${itemData.title}">
            </div>
            <div class="item-details">
                <h5>${itemData.title}</h5>
                <p>${itemData.category.charAt(0).toUpperCase() + itemData.category.slice(1)} • ${itemData.subcategory.charAt(0).toUpperCase() + itemData.subcategory.slice(1)}</p>
            </div>
            <button class="remove-item">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    $('#selected-items-list').append(selectedItemHtml);
}

// Remove from Selected Items
function removeFromSelectedItems(itemId) {
    $(`[data-item-id="${itemId}"]`).remove();
}

// Setup Remove Items
function setupRemoveItems() {
    $(document).on('click', '.remove-item', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const selectedItem = $(this).closest('.selected-item');
        const itemId = selectedItem.data('item-id');
        
        // Remove from sidebar
        selectedItem.remove();
        
        // Deselect corresponding item card
        const itemCard = $(`.item-card`).filter(function() {
            return generateItemId($(this)) === itemId;
        });
        
        if (itemCard.length) {
            deselectItem(itemCard);
        }
    });
}

// Update Category Count
function updateCategoryCount(category) {
    const count = $(`.item-card.selected[data-category="${category}"]`).length;
    $(`#${category}-count`).text(count);
}

// Update Total Count Only
function updateTotalCount() {
    $('#total-selected-count').text($('.item-card.selected').length);
}

// Initialize Selected Items
function initializeSelectedItems() {
    // Count selected items by category
    const decorationCount = $('.item-card.selected[data-category="decoration"]').length;
    const foodCount = $('.item-card.selected[data-category="food"]').length;
    const serviceCount = $('.item-card.selected[data-category="service"]').length;
    
    // Update category counts
    $('#decoration-count').text(decorationCount);
    $('#food-count').text(foodCount);
    $('#service-count').text(serviceCount);
    
    // Update total count only
    updateTotalCount();
}

// Fade In Animation
function addFadeInAnimation() {
    const elements = $('.category-tab, .filter-tab, .item-card');
    
    elements.each(function(index) {
        $(this).addClass('fade-in');
        
        setTimeout(() => {
            $(this).addClass('visible');
        }, index * 50);
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
    
    // Auto hide after 3 seconds
    setTimeout(() => {
        hideNotification(notification);
    }, 3000);
    
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

// Smooth scrolling for sidebar
$('.selected-items-list').on('scroll', function() {
    // Add smooth scrolling behavior
    $(this).css('scroll-behavior', 'smooth');
});

// Hover effects for item cards
$('.item-card').on('mouseenter', function() {
    $(this).addClass('hovered');
}).on('mouseleave', function() {
    $(this).removeClass('hovered');
});

// Add loading state for item selection
function addLoadingState(itemCard) {
    const selectBtn = itemCard.find('.select-btn');
    selectBtn.addClass('loading').prop('disabled', true);
    
    setTimeout(() => {
        selectBtn.removeClass('loading').prop('disabled', false);
    }, 500);
}

// Export selected items data
function getSelectedItemsData() {
    const selectedItems = [];
    
    $('.item-card.selected').each(function() {
        selectedItems.push(getItemData($(this)));
    });
    
    return selectedItems;
}

// Save selected items to localStorage
function saveSelectedItems() {
    const selectedItems = getSelectedItemsData();
    localStorage.setItem('selectedEventItems', JSON.stringify(selectedItems));
}

// Load selected items from localStorage
function loadSelectedItems() {
    // This function is kept for potential future use but doesn't auto-load items
    // Items will only be selected when user manually clicks on them
}

// Auto-save on item selection/deselection
$(document).on('itemSelected itemDeselected', function() {
    saveSelectedItems();
});

// Estimate button functionality
$(document).ready(function() {
    $('#estimate-btn').on('click', function() {
        const guestCount = $('#guest-count').val();
        const needCatering = $('#catering-boys').is(':checked');
        const selectedItems = getSelectedItemsData();
        
        // Validate guest count
        if (!guestCount || guestCount < 1) {
            showNotification('Please enter a valid number of guests (minimum 1)', 'error');
            return;
        }
        
        // Show estimate details
        showEstimate(guestCount, needCatering, selectedItems);
    });
});

function showEstimate(guestCount, needCatering, selectedItems) {
    // Save data to localStorage for the result page
    localStorage.setItem('guestCount', guestCount);
    localStorage.setItem('needCatering', needCatering);
    
    showNotification('Generating your estimation...', 'success');
    
    // Redirect to estimation result page
    setTimeout(() => {
        window.location.href = 'estimation-result.html';
    }, 1500);
}
