@extends('layouts.public')

@section('title', 'Event Selection - Encore Events')

@section('styles')
<link rel="stylesheet" href="{{ asset('website/css/event-selection.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('content')

<header class="event-header">
    <div class="container">
        <div class="header-content text-center">
            <h1 class="page-title">Event Selection</h1>
            <p class="page-subtitle">Choose from our premium collection of decorations, food, and services to create your perfect event</p>
        </div>
    </div>
</header>

<main class="event-main">
    <div class="container-fluid">
        @if(isset($estimation))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <i class="fas fa-redo me-3"></i>
                    <div>
                        <strong>Re-estimation Mode:</strong> Your previous estimation has been loaded with {{ count($estimation->selected_items ?? []) }} items preselected. You can modify your selections and recalculate the cost.
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">

            <div class="col-lg-9">

                <section class="category-navigation py-3">
                    <div class="category-tabs">
                        <button class="category-tab active" data-category="decoration">
                            <div class="tab-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <div class="tab-content">
                                <h3>Decoration</h3>
                                <p>Lighting, flowers & decor</p>
                            </div>
                            <div class="tab-badge" id="decoration-count">0</div>
                        </button>
                        <button class="category-tab" data-category="food">
                            <div class="tab-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="tab-content">
                                <h3>Food</h3>
                                <p>Appetizers, mains & desserts</p>
                            </div>
                            <div class="tab-badge" id="food-count">0</div>
                        </button>
                        <button class="category-tab" data-category="service">
                            <div class="tab-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="tab-content">
                                <h3>Service</h3>
                                <p>Entertainment & planning</p>
                            </div>
                            <div class="tab-badge" id="service-count">0</div>
                        </button>
                    </div>
                </section>

                <section class="filter-section p-1">
                    <div class="filter-header">
                        <i class="fas fa-filter"></i>
                        <h3>Filter by Category</h3>
                    </div>
                    <div class="filter-tabs-wrapper">
                        <div class="scroll-indicator scroll-indicator-left" id="scroll-indicator-left">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="filter-tabs" id="category-filter-tabs">
                            <button class="filter-tab active" data-category-filter="all">All Categories</button>

                        </div>
                        <div class="scroll-indicator scroll-indicator-right" id="scroll-indicator-right">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </section>

                <section class="items-grid">
                    <div class="row g-4" id="items-container">

                        @foreach($decorationItems as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="item-card" data-category="decoration" data-category-id="{{ $item->category ? $item->category->id : '' }}" data-subcategory="{{ $item->subcategory ? $item->subcategory->id : '' }}" data-subcategory-name="{{ $item->subcategory ? strtolower($item->subcategory->name) : '' }}" data-id="{{ $item->id }}" data-price="₹{{ number_format($item->fixed_amount, 2) }}" data-event-teams="{{ $item->eventTeams->pluck('id')->implode(',') }}">
                                <div class="card-header">
                                    <button class="select-btn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="card-image">
                                    @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                    @else
                                    <img src="https://placehold.co/300x200/F5F5DC/8B4513?text={{ urlencode($item->title) }}" alt="{{ $item->title }}">
                                    @endif
                                </div>
                                <div class="card-content">
                                    <h4 class="item-title">{{ $item->title }}</h4>
                                    <p class="item-description">{{ $item->short_description ?: 'Premium decoration item' }}</p>
                                    <div class="item-meta">
                                        @if($item->category)
                                        <span class="item-tag item-tag-category">{{ ucfirst($item->category->name) }}</span>
                                        @endif
                                        @if($item->subcategory)
                                        <span class="item-tag item-tag-subcategory">{{ ucfirst($item->subcategory->name) }}</span>
                                        @endif
                                    </div>
                                    <div class="card-quantity-controls">
                                        <button type="button" class="qty-btn qty-decrease" aria-label="Decrease quantity">−</button>
                                        <input type="number" class="qty-input" min="1" value="1">
                                        <button type="button" class="qty-btn qty-increase" aria-label="Increase quantity">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        @foreach($foodItems as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="item-card" data-category="food" data-category-id="{{ $item->category ? $item->category->id : '' }}" data-subcategory="{{ $item->subcategory ? $item->subcategory->id : '' }}" data-subcategory-name="{{ $item->subcategory ? strtolower($item->subcategory->name) : '' }}" data-id="{{ $item->id }}" data-price="₹{{ number_format($item->amount_per_person, 2) }}/person">
                                <div class="card-header">
                                    <button class="select-btn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="card-image">
                                    @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                    @else
                                    <img src="https://placehold.co/300x200/F5F5DC/8B4513?text={{ urlencode($item->title) }}" alt="{{ $item->title }}">
                                    @endif
                                </div>
                                <div class="card-content">
                                    <h4 class="item-title">{{ $item->title }}</h4>
                                    <p class="item-description">{{ $item->short_description ?: 'Delicious food option' }}</p>
                                    <div class="item-meta">
                                        @if($item->category)
                                        <span class="item-tag item-tag-category">{{ ucfirst($item->category->name) }}</span>
                                        @endif
                                        @if($item->subcategory)
                                        <span class="item-tag item-tag-subcategory">{{ ucfirst($item->subcategory->name) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        @foreach($serviceItems as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="item-card" data-category="service" data-category-id="{{ $item->category ? $item->category->id : '' }}" data-subcategory="{{ $item->subcategory ? $item->subcategory->id : '' }}" data-subcategory-name="{{ $item->subcategory ? strtolower($item->subcategory->name) : '' }}" data-id="{{ $item->id }}" data-price="₹{{ number_format($item->fixed_amount, 2) }}" data-event-teams="{{ $item->eventTeams->pluck('id')->implode(',') }}">
                                <div class="card-header">
                                    <button class="select-btn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="card-image">
                                    @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                    @else
                                    <img src="https://placehold.co/300x200/F5F5DC/8B4513?text={{ urlencode($item->title) }}" alt="{{ $item->title }}">
                                    @endif
                                </div>
                                <div class="card-content">
                                    <h4 class="item-title">{{ $item->title }}</h4>
                                    <p class="item-description">{{ $item->short_description ?: 'Professional service' }}</p>
                                    <div class="item-meta">
                                        @if($item->category)
                                        <span class="item-tag item-tag-category">{{ ucfirst($item->category->name) }}</span>
                                        @endif
                                        @if($item->subcategory)
                                        <span class="item-tag item-tag-subcategory">{{ ucfirst($item->subcategory->name) }}</span>
                                        @endif
                                    </div>
                                    <div class="card-quantity-controls">
                                        <button type="button" class="qty-btn qty-decrease" aria-label="Decrease quantity">−</button>
                                        <input type="number" class="qty-input" min="1" value="1">
                                        <button type="button" class="qty-btn qty-increase" aria-label="Increase quantity">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="col-lg-3">
                <div class="selected-items-sidebar">
                    <div class="sidebar-header">
                        <h3>Selected Items (<span id="total-selected-count">0</span>)</h3>
                    </div>
                    <div class="selected-items-list" id="selected-items-list">

                    </div>
                </div>

                <div class="estimate-card">
                    <div class="estimate-header">
                        <h3>Event Details</h3>
                    </div>
                    <div class="estimate-content">
                        <div class="form-group">
                            <label for="guest-count">Enter your number of guests</label>
                            <input type="number" id="guest-count" class="form-control" placeholder="Enter number of guests" min="1">
                        </div>
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="catering-boys" class="form-check-input">
                                <label for="catering-boys" class="form-check-label">Need catering boys</label>
                            </div>
                            <div id="selected-seating-info" class="mt-2" style="display: none;">
                                <div class="alert alert-success d-flex align-items-center justify-content-between p-2 mb-0">
                                    <div class="d-flex align-items-center">
                                        <div class="small text-muted" id="selected-seating-name"></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="remove-seating-btn">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" id="selected-seating-id" name="seating_id">
                        </div>
                        <button type="button" class="btn btn-primary estimate-btn" id="estimate-btn">
                            <i class="fas fa-calculator"></i>
                            @if(isset($estimation))
                            Re-calculate
                            @else
                            Let's Estimate
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="seatingModal" tabindex="-1" aria-labelledby="seatingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="seatingModalLabel">Select Seating Arrangement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height:70vh; overflow-y:auto;">
                        <p class="text-muted mb-4">Please choose a seating arrangement for your catering service.</p>
                        <div class="row g-4">
                            @foreach($seatings as $seating)
                            <div class="col-md-6">
                                <div class="card h-100 seating-card" data-id="{{ $seating->id }}" data-title="{{ $seating->title }}" data-price="{{ $seating->catering_boy_per_head }}">
                                    <div class="position-relative">
                                        @if($seating->images->count() > 0)
                                        <div id="carousel-seating-{{ $seating->id }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($seating->images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="{{ $seating->title }}" style="height: 200px; object-fit: cover;">
                                                </div>
                                                @endforeach
                                            </div>
                                            @if($seating->images->count() > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-seating-{{ $seating->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-seating-{{ $seating->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                            @endif
                                        </div>
                                        @else
                                        <img src="https://placehold.co/600x400?text=No+Image" class="card-img-top" alt="{{ $seating->title }}" style="height: 200px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title mb-2">{{ $seating->title }}</h5>
                                        <p class="card-text small text-muted flex-grow-1">{{ Str::limit($seating->description, 100) }}</p>
                                        <button type="button" class="btn btn-outline-primary w-100 mt-2 select-seating-btn">Select</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>

    const toast = {
        success: (message, duration = 3000) => {
            Toastify({
                text: message,
                duration: duration,
                gravity: "top",
                position: "right",
                backgroundColor: "#28a745",
                stopOnFocus: true
            }).showToast();
        },
        error: (message, duration = 3000) => {
            Toastify({
                text: message,
                duration: duration,
                gravity: "top",
                position: "right",
                backgroundColor: "#dc3545",
                stopOnFocus: true
            }).showToast();
        },
        info: (message, duration = 3000) => {
            Toastify({
                text: message,
                duration: duration,
                gravity: "top",
                position: "right",
                backgroundColor: "#17a2b8",
                stopOnFocus: true
            }).showToast();
        }
    };

    document.addEventListener('DOMContentLoaded', function() {

        const categoryTabs = document.querySelectorAll('.category-tab');
        const filterTabs = document.querySelectorAll('.filter-tab');
        const itemCards = document.querySelectorAll('.item-card');
        const selectBtns = document.querySelectorAll('.select-btn');
        const selectedItemsList = document.getElementById('selected-items-list');
        const totalSelectedCount = document.getElementById('total-selected-count');
        const estimateBtn = document.getElementById('estimate-btn');
        const guestCountInput = document.getElementById('guest-count');

        console.log('DOM Elements found:', {
            categoryTabs: categoryTabs.length,
            filterTabs: filterTabs.length,
            itemCards: itemCards.length,
            selectBtns: selectBtns.length,
            selectedItemsList: !!selectedItemsList,
            totalSelectedCount: !!totalSelectedCount,
            guestCountInput: !!guestCountInput,
            estimateBtn: !!estimateBtn
        });

        let selectedItems = [];

        function normalizeId(id) {
            return id != null ? String(id) : '';
        }

        function findSelectedItem(id, category) {
            const normalizedId = normalizeId(id);
            return selectedItems.find(item => item.id === normalizedId && item.category === category);
        }

        function removeSelectedItem(id, category) {
            const normalizedId = normalizeId(id);
            selectedItems = selectedItems.filter(item => !(item.id === normalizedId && item.category === category));
        }
        let currentCategory = 'decoration';
        let currentCategoryFilter = 'all';
        let currentSubcategoryFilter = 'all';
        let allowedEventTeams = new Set();

        function updateScrollIndicators() {
            const filterTabs = document.getElementById('category-filter-tabs');
            const scrollLeftIndicator = document.getElementById('scroll-indicator-left');
            const scrollRightIndicator = document.getElementById('scroll-indicator-right');

            if (!filterTabs || !scrollLeftIndicator || !scrollRightIndicator) return;

            const tolerance = 5;
            const isScrollable = (filterTabs.scrollWidth - filterTabs.clientWidth) > tolerance;
            const scrollLeft = filterTabs.scrollLeft;
            const maxScrollLeft = filterTabs.scrollWidth - filterTabs.clientWidth;
            const scrollRight = maxScrollLeft - scrollLeft;

            if (isScrollable) {

                scrollLeftIndicator.classList.toggle('show', scrollLeft > tolerance);
                scrollLeftIndicator.style.display = 'flex';

                scrollRightIndicator.classList.toggle('show', scrollRight > tolerance);
                scrollRightIndicator.style.display = 'flex';
            } else {

                scrollLeftIndicator.classList.remove('show');
                scrollLeftIndicator.style.display = 'none';
                scrollRightIndicator.classList.remove('show');
                scrollRightIndicator.style.display = 'none';
            }
        }

        const filterTabsContainer = document.getElementById('category-filter-tabs');
        if (filterTabsContainer) {
            filterTabsContainer.addEventListener('scroll', updateScrollIndicators);

            setTimeout(updateScrollIndicators, 100);
            setTimeout(updateScrollIndicators, 500);
        }

        const scrollLeftIndicator = document.getElementById('scroll-indicator-left');
        const scrollRightIndicator = document.getElementById('scroll-indicator-right');

        if (scrollLeftIndicator && filterTabsContainer) {
            scrollLeftIndicator.addEventListener('click', function() {
                filterTabsContainer.scrollBy({
                    left: -200,
                    behavior: 'smooth'
                });
            });
        }

        if (scrollRightIndicator && filterTabsContainer) {
            scrollRightIndicator.addEventListener('click', function() {
                filterTabsContainer.scrollBy({
                    left: 200,
                    behavior: 'smooth'
                });
            });
        }

        window.addEventListener('resize', updateScrollIndicators);

        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function() {

                categoryTabs.forEach(t => t.classList.remove('active'));

                this.classList.add('active');

                currentCategory = this.dataset.category;
                currentCategoryFilter = 'all';
                currentSubcategoryFilter = 'all';
                updateFilterTabs();
                filterItems();
                filterItemsByEventTeam();
            });
        });

        function updateFilterTabs() {

            const currentCategoryItems = Array.from(itemCards).filter(card => card.dataset.category === currentCategory);

            const categoriesData = @json($categories);
            const subcategoriesData = @json($subcategories);

            const categoryMap = new Map();
            const categoriesByType = {};

            categoriesData.forEach(cat => {
                if (cat.type === currentCategory) {
                    categoriesByType[cat.id] = cat.name;
                }
            });

            subcategoriesData.forEach(sub => {
                if (sub.category && sub.category.type === currentCategory) {
                    const catId = sub.category.id;
                    if (!categoriesByType[catId]) {
                        categoriesByType[catId] = sub.category.name;
                    }
                }
            });

            const categoryIds = new Set();
            currentCategoryItems.forEach(card => {
                const categoryId = card.dataset.categoryId;
                if (categoryId) {
                    categoryIds.add(categoryId);
                }
            });

            categoryIds.forEach(catId => {
                if (categoriesByType[catId]) {
                    categoryMap.set(catId, categoriesByType[catId]);
                }
            });

            const subcategoriesByCategory = new Map();
            currentCategoryItems.forEach(card => {
                const categoryId = card.dataset.categoryId;
                const subcategoryId = card.dataset.subcategory;
                const subcategoryName = card.dataset.subcategoryName;

                if (categoryId && subcategoryId && subcategoryName) {
                    if (!subcategoriesByCategory.has(categoryId)) {
                        subcategoriesByCategory.set(categoryId, new Map());
                    }
                    const categorySubcategories = subcategoriesByCategory.get(categoryId);
                    if (!categorySubcategories.has(subcategoryId)) {
                        categorySubcategories.set(subcategoryId, subcategoryName);
                    }
                }
            });

            const categoryFilterTabs = document.getElementById('category-filter-tabs');
            let categoryButtons = '<button class="filter-tab active" data-category-filter="all">All Categories</button>';

            categoryMap.forEach((name, id) => {
                const displayName = name.charAt(0).toUpperCase() + name.slice(1);
                const hasSubcategories = subcategoriesByCategory.has(id.toString()) && subcategoriesByCategory.get(id.toString()).size > 0;
                const subcategories = hasSubcategories ? subcategoriesByCategory.get(id.toString()) : null;

                categoryButtons += `<div class="category-filter-group">`;
                categoryButtons += `<button class="filter-tab category-tab-main" data-category-filter="${id}">${displayName}</button>`;

                if (hasSubcategories) {
                    categoryButtons += `<div class="subcategory-filter-group" data-parent-category="${id}" style="display: none;">`;
                    subcategories.forEach((subName, subId) => {
                        const subDisplayName = subName.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                        categoryButtons += `<button class="filter-tab filter-tab-subcategory" data-category-filter="${id}" data-subcategory-filter="${subId}">${subDisplayName}</button>`;
                    });
                    categoryButtons += `</div>`;
                }
                categoryButtons += `</div>`;
            });

            categoryFilterTabs.innerHTML = categoryButtons;

            categoryFilterTabs.querySelectorAll('.category-tab-main').forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const selectedCategoryId = this.dataset.categoryFilter;

                    categoryFilterTabs.querySelectorAll('.category-tab-main').forEach(t => t.classList.remove('active'));
                    categoryFilterTabs.querySelectorAll('.filter-tab-subcategory').forEach(t => t.classList.remove('active'));

                    categoryFilterTabs.querySelectorAll('.subcategory-filter-group').forEach(group => {
                        group.style.display = 'none';
                    });

                    this.classList.add('active');

                    if (selectedCategoryId !== 'all') {
                        const subcategoryGroup = categoryFilterTabs.querySelector(`.subcategory-filter-group[data-parent-category="${selectedCategoryId}"]`);
                        if (subcategoryGroup) {
                            subcategoryGroup.style.display = 'flex';
                        }
                    }

                    currentCategoryFilter = selectedCategoryId;
                    currentSubcategoryFilter = 'all';
                    filterItems();
                    filterItemsByEventTeam();
                });
            });

            function attachSubcategoryListeners() {
                categoryFilterTabs.querySelectorAll('.filter-tab-subcategory').forEach(tab => {

                    const newTab = tab.cloneNode(true);
                    tab.parentNode.replaceChild(newTab, tab);

                    newTab.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const parentCategory = this.dataset.categoryFilter;

                        categoryFilterTabs.querySelectorAll('.category-tab-main').forEach(t => t.classList.remove('active'));
                        categoryFilterTabs.querySelectorAll('.filter-tab-subcategory').forEach(t => t.classList.remove('active'));

                        this.classList.add('active');

                        const parentTab = categoryFilterTabs.querySelector(`.category-tab-main[data-category-filter="${parentCategory}"]`);
                        if (parentTab) {
                            parentTab.classList.add('active');

                            categoryFilterTabs.querySelectorAll('.subcategory-filter-group').forEach(group => {
                                group.style.display = 'none';
                            });
                            const subcategoryGroup = categoryFilterTabs.querySelector(`.subcategory-filter-group[data-parent-category="${parentCategory}"]`);
                            if (subcategoryGroup) {
                                subcategoryGroup.style.display = 'flex';
                            }
                        }

                        currentCategoryFilter = parentCategory;
                        currentSubcategoryFilter = this.dataset.subcategoryFilter;
                        filterItems();
                        filterItemsByEventTeam();
                    });
                });
            }

            attachSubcategoryListeners();

            categoryFilterTabs.querySelector('[data-category-filter="all"]').addEventListener('click', function() {
                categoryFilterTabs.querySelectorAll('.category-tab-main').forEach(t => t.classList.remove('active'));
                categoryFilterTabs.querySelectorAll('.filter-tab-subcategory').forEach(t => t.classList.remove('active'));

                categoryFilterTabs.querySelectorAll('.subcategory-filter-group').forEach(group => {
                    group.style.display = 'none';
                });

                this.classList.add('active');
                currentCategoryFilter = 'all';
                currentSubcategoryFilter = 'all';
                filterItems();
                filterItemsByEventTeam();
            });

            currentCategoryFilter = 'all';
            currentSubcategoryFilter = 'all';

            setTimeout(updateScrollIndicators, 100);
            setTimeout(updateScrollIndicators, 300);
            setTimeout(updateScrollIndicators, 600);
        }

        function filterItems() {
            itemCards.forEach(card => {
                const cardCategory = card.dataset.category;
                const cardCategoryId = card.dataset.categoryId;
                const cardSubcategory = card.dataset.subcategory;
                const cardEventTeams = card.dataset.eventTeams;
                const column = card.closest('.col-md-6.col-lg-4');

                if (cardCategory !== currentCategory) {
                    column.style.display = 'none';
                    return;
                }

                let matchesCategoryFilter = false;
                if (currentCategoryFilter === 'all') {
                    matchesCategoryFilter = true;
                } else {

                    matchesCategoryFilter = cardCategoryId === currentCategoryFilter;
                }

                if (!matchesCategoryFilter) {
                    column.style.display = 'none';
                    return;
                }

                let matchesSubcategoryFilter = false;
                if (currentSubcategoryFilter === 'all') {
                    matchesSubcategoryFilter = true;
                } else {
                    matchesSubcategoryFilter = cardSubcategory === currentSubcategoryFilter;
                }

                if (!matchesSubcategoryFilter) {
                    column.style.display = 'none';
                    return;
                }

                if (cardCategory === 'decoration' || cardCategory === 'service') {
                    if (!isItemCompatible(cardEventTeams, cardCategory)) {
                        column.style.display = 'none';
                        return;
                    }
                }

                column.style.display = 'block';
            });
        }

        function isItemCompatible(itemEventTeams, itemCategory) {

            if (itemCategory === 'food') {
                return true;
            }

            if (selectedItems.length === 0) {
                return true;
            }

            if (allowedEventTeams.size === 0) {
                return true;
            }

            const itemTeams = itemEventTeams ? itemEventTeams.split(',').map(id => parseInt(id.trim())) : [];
            return itemTeams.some(teamId => allowedEventTeams.has(teamId));
        }

        function updateAllowedEventTeams() {
            allowedEventTeams.clear();

            selectedItems.forEach(item => {
                if (item.category !== 'food' && item.eventTeams) {
                    const teams = item.eventTeams.split(',').map(id => parseInt(id.trim()));
                    teams.forEach(teamId => allowedEventTeams.add(teamId));
                }
            });

        }

        function filterItemsByEventTeam() {

            filterItems();
        }

        selectBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.item-card');
                const itemId = card.dataset.id;
                const itemTitle = card.querySelector('.item-title').textContent;
                const itemPrice = card.dataset.price;
                const itemCategory = card.dataset.category;
                const itemEventTeams = card.dataset.eventTeams || '';
                const normalizedId = normalizeId(itemId);

                if (this.classList.contains('selected')) {

                    removeSelectedItem(itemId, itemCategory);
                    this.classList.remove('selected');
                    this.innerHTML = '<i class="fas fa-plus"></i>';
                    card.classList.remove('selected');

                    updateAllowedEventTeams();
                } else {

                    if (!isItemCompatible(itemEventTeams, itemCategory)) {
                        toast.error('This item is from a different event team. Please select items from the same event team across decoration and service categories.');
                        return;
                    }

                    const itemImage = card.querySelector('.card-image img');
                    const imageSrc = itemImage ? itemImage.src : null;

                    let quantity = 1;
                    if (itemCategory !== 'food') {
                        const qtyInput = card.querySelector('.qty-input');
                        quantity = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
                    }

                    selectedItems.push({
                        id: normalizedId,
                        title: itemTitle,
                        price: itemPrice,
                        category: itemCategory,
                        image: imageSrc,
                        eventTeams: itemEventTeams,
                        quantity: quantity
                    });
                    this.classList.add('selected');
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    card.classList.add('selected');

                    updateAllowedEventTeams();
                }

                updateSelectedItemsList();
                updateCategoryCounts();
                filterItemsByEventTeam();
                updateSelectedItemsDisplay();

                console.log('Item selection updated. Selected items:', selectedItems);
                console.log('Allowed event teams:', Array.from(allowedEventTeams));
            });
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('qty-decrease') || e.target.classList.contains('qty-increase')) {
                const controls = e.target.closest('.card-quantity-controls');
                const input = controls.querySelector('.qty-input');
                const currentValue = parseInt(input.value) || 1;

                if (e.target.classList.contains('qty-decrease')) {
                    input.value = Math.max(1, currentValue - 1);
                } else if (e.target.classList.contains('qty-increase')) {
                    input.value = currentValue + 1;
                }

                const card = controls.closest('.item-card');
                const itemId = card.dataset.id;
                const itemCategory = card.dataset.category;
                const selectedItem = findSelectedItem(itemId, itemCategory);
                if (selectedItem) {
                    selectedItem.quantity = parseInt(input.value);
                    updateSelectedItemsList();
                }
            }
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('qty-input') && e.target.closest('.card-quantity-controls')) {
                const value = Math.max(1, parseInt(e.target.value) || 1);
                e.target.value = value;

                const card = e.target.closest('.item-card');
                const itemId = card.dataset.id;
                const itemCategory = card.dataset.category;
                const selectedItem = findSelectedItem(itemId, itemCategory);
                if (selectedItem) {
                    selectedItem.quantity = value;
                    updateSelectedItemsList();
                }
            }
        });

        function updateSelectedItemsDisplay() {

            document.querySelectorAll('.item-card').forEach(card => {
                const itemId = card.dataset.id;
                const itemCategory = card.dataset.category;
                const normalizedId = normalizeId(itemId);
                const isSelected = selectedItems.some(item => item.id === normalizedId && item.category === itemCategory);

                if (isSelected) {
                    card.classList.add('selected');
                    const selectBtn = card.querySelector('.select-btn');
                    if (selectBtn) {
                        selectBtn.classList.add('selected');
                        selectBtn.innerHTML = '<i class="fas fa-check"></i>';
                    }
                    const qtyControls = card.querySelector('.card-quantity-controls');
                    if (qtyControls) qtyControls.setAttribute('aria-hidden', 'false');
                } else {
                    card.classList.remove('selected');
                    const selectBtn = card.querySelector('.select-btn');
                    if (selectBtn) {
                        selectBtn.classList.remove('selected');
                        selectBtn.innerHTML = '<i class="fas fa-plus"></i>';
                    }
                    const qtyControls = card.querySelector('.card-quantity-controls');
                    if (qtyControls) qtyControls.setAttribute('aria-hidden', 'true');
                }
            });
        }

        function updateSelectedItemsList() {
            totalSelectedCount.textContent = selectedItems.length;

            if (selectedItems.length === 0) {
                selectedItemsList.innerHTML = '<p class="text-muted text-center">No items selected</p>';
            } else {
                selectedItemsList.innerHTML = selectedItems.map(item => `
                <div class="selected-item py-3" data-id="${item.id}" data-category="${item.category}">
                    <div class="selected-item-image">
                        ${item.image ? `<img src="${item.image}" alt="${item.title}" class="selected-item-thumbnail">` : `<div class="selected-item-thumbnail placeholder"><i class="fas fa-image"></i></div>`}
                    </div>
                    <div class="item-details">
                        <h5>${item.title}</h5>
                        <p class="item-category" style="color: white;">${item.category}</p>
                    </div>
                    ${item.category !== 'food' ? `
                    <div class="quantity-controls" data-id="${item.id}" data-category="${item.category}">
                        <button type="button" class="qty-btn qty-decrease" aria-label="Decrease quantity">−</button>
                        <input type="number" class="qty-input" min="1" value="${item.quantity || 1}">
                        <button type="button" class="qty-btn qty-increase" aria-label="Increase quantity">+</button>
                    </div>
                    ` : ''}
                    <button class="remove-btn" data-id="${item.id}" data-category="${item.category}" title="Remove item">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `).join('');

                selectedItemsList.querySelectorAll('.remove-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const itemId = this.dataset.id;
                        const itemCategory = this.dataset.category;
                        removeSelectedItem(itemId, itemCategory);

                        const card = document.querySelector(`.item-card[data-id="${itemId}"][data-category="${itemCategory}"]`);
                        if (card) {
                            const selectBtn = card.querySelector('.select-btn');
                            if (selectBtn) {
                                selectBtn.classList.remove('selected');
                                selectBtn.innerHTML = '<i class="fas fa-plus"></i>';
                            }
                            card.classList.remove('selected');
                        }

                        updateAllowedEventTeams();
                        filterItemsByEventTeam();

                        updateSelectedItemsList();
                        updateCategoryCounts();
                        updateSelectedItemsDisplay();
                    });
                });

                selectedItemsList.querySelectorAll('.quantity-controls').forEach(ctrl => {
                    const id = ctrl.getAttribute('data-id');
                    const category = ctrl.getAttribute('data-category');
                    const input = ctrl.querySelector('.qty-input');
                    const decBtn = ctrl.querySelector('.qty-decrease');
                    const incBtn = ctrl.querySelector('.qty-increase');

                    function setQuantity(newQty) {
                        const qty = Math.max(1, parseInt(newQty || '1', 10));
                        input.value = qty;
                        const idx = selectedItems.findIndex(i => i.id === normalizeId(id) && i.category === category);
                        if (idx !== -1) {
                            selectedItems[idx].quantity = qty;
                        }
                    }

                    decBtn.addEventListener('click', function() {
                        setQuantity(parseInt(input.value || '1', 10) - 1);
                    });

                    incBtn.addEventListener('click', function() {
                        setQuantity(parseInt(input.value || '1', 10) + 1);
                    });

                    input.addEventListener('change', function() {
                        setQuantity(this.value);
                    });
                });
            }
        }

        function updateCategoryCounts() {
            const decorationCount = selectedItems.filter(item => item.category === 'decoration').length;
            const foodCount = selectedItems.filter(item => item.category === 'food').length;
            const serviceCount = selectedItems.filter(item => item.category === 'service').length;

            console.log('Updating category counts:', {
                decoration: decorationCount,
                food: foodCount,
                service: serviceCount,
                total: selectedItems.length
            });

            const decorationElement = document.getElementById('decoration-count');
            const foodElement = document.getElementById('food-count');
            const serviceElement = document.getElementById('service-count');

            if (decorationElement) {
                decorationElement.textContent = decorationCount;
                console.log('Updated decoration count:', decorationCount);
            } else {
                console.warn('Decoration count element not found');
            }

            if (foodElement) {
                foodElement.textContent = foodCount;
                console.log('Updated food count:', foodCount);
            } else {
                console.warn('Food count element not found');
            }

            if (serviceElement) {
                serviceElement.textContent = serviceCount;
                console.log('Updated service count:', serviceCount);
            } else {
                console.warn('Service count element not found');
            }
        }

            const cateringCheckbox = document.getElementById('catering-boys');
            const seatingModal = new bootstrap.Modal(document.getElementById('seatingModal'));
            const selectedSeatingInfo = document.getElementById('selected-seating-info');
            const selectedSeatingName = document.getElementById('selected-seating-name');
            const selectedSeatingPrice = document.getElementById('selected-seating-price');
            const selectedSeatingIdInput = document.getElementById('selected-seating-id');
            const removeSeatingBtn = document.getElementById('remove-seating-btn');
            const selectSeatingBtns = document.querySelectorAll('.select-seating-btn');

            cateringCheckbox.addEventListener('change', function() {
                if (this.checked) {

                    seatingModal.show();
                } else {

                    clearSeatingSelection();
                }
            });

            document.getElementById('seatingModal').addEventListener('hidden.bs.modal', function () {
                if (cateringCheckbox.checked && !selectedSeatingIdInput.value) {
                    cateringCheckbox.checked = false;
                }
            });

            selectSeatingBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = this.closest('.seating-card');
                    const id = card.dataset.id;
                    const title = card.dataset.title;
                    const price = parseFloat(card.dataset.price);

                    selectedSeatingName.textContent = title;

                    selectedSeatingIdInput.value = id;
                    selectedSeatingInfo.style.display = 'block';

                    seatingModal.hide();
                });
            });

            removeSeatingBtn.addEventListener('click', function() {
                cateringCheckbox.checked = false;
                clearSeatingSelection();
            });

            function clearSeatingSelection() {
                selectedSeatingIdInput.value = '';
                selectedSeatingInfo.style.display = 'none';
                selectedSeatingName.textContent = '';
                selectedSeatingPrice.textContent = '';
            }

            estimateBtn.addEventListener('click', function() {
                const guestCount = parseInt(guestCountInput.value);
                const cateringBoys = cateringCheckbox.checked;
                const seatingId = selectedSeatingIdInput.value;

                if (!guestCount || guestCount < 1) {
                    toast.error('Please enter a valid number of guests');
                    return;
                }

                if (selectedItems.length === 0) {
                    toast.error('Please select at least one item');
                    return;
                }

                if (cateringBoys && !seatingId) {
                    toast.error('Please select a seating arrangement for catering');
                    seatingModal.show();
                    return;
                }

                const data = {
                    selected_items: JSON.stringify(selectedItems),
                    guest_count: guestCount,
                    catering_boys: cateringBoys,
                    seating_id: seatingId,
                    _token: '{{ csrf_token() }}'
                };

                const originalBtnText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Calculating...';
                this.disabled = true;

                fetch('{{ route("public.event-selection.estimate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toast.success('Estimation completed! Redirecting to results...', 2000);

                        localStorage.setItem('lastEstimationId', data.estimation.id);

                        setTimeout(() => {
                            window.location.href = data.redirect_url;
                        }, 1500);

                        console.log('Event Estimation Saved:', data.estimation);
                    } else {
                        console.error('Server error:', data.message);
                        toast.error(data.message || 'Something went wrong');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    toast.error('Something went wrong. Please try again.');
                })
                .finally(() => {

                    estimateBtn.disabled = false;
                    const isReEstimation = @json(isset($estimation));
                    if (isReEstimation) {
                        estimateBtn.innerHTML = '<i class="fas fa-calculator"></i> Re-calculate';
                    } else {
                        estimateBtn.innerHTML = '<i class="fas fa-calculator"></i> Let\'s Estimate';
                    }
                });
        });

        @if(isset($estimation) || isset($lastEstimation))

        function loadEstimationData() {
            const estimationData = @json($estimation ?? $lastEstimation);
            const isReEstimation = @json(isset($estimation));

            console.log('Loading estimation data:', estimationData);
            console.log('Selected items:', estimationData.selected_items);
            console.log('Decoration items:', estimationData.decoration_items);
            console.log('Food items:', estimationData.food_items);
            console.log('Service items:', estimationData.service_items);
            console.log('Is re-estimation:', isReEstimation);

            if (isReEstimation) {
                guestCountInput.value = estimationData.guest_count;
                document.getElementById('catering-boys').checked = estimationData.catering_boys;
            }

            selectedItems = [];
            updateSelectedItemsDisplay();

            if (isReEstimation) {
                console.log('Re-estimation mode: Auto-selecting items');

                const allSelectedItems = [];

                if (estimationData.decoration_items && Array.isArray(estimationData.decoration_items)) {
                    allSelectedItems.push(...estimationData.decoration_items);
                }
                if (estimationData.food_items && Array.isArray(estimationData.food_items)) {
                    allSelectedItems.push(...estimationData.food_items);
                }
                if (estimationData.service_items && Array.isArray(estimationData.service_items)) {
                    allSelectedItems.push(...estimationData.service_items);
                }

                console.log('All selected items from detailed data:', allSelectedItems);

                if (allSelectedItems.length === 0 && estimationData.selected_items && Array.isArray(estimationData.selected_items)) {
                    allSelectedItems.push(...estimationData.selected_items);
                    console.log('Using fallback selected_items:', allSelectedItems);
                }

                if (allSelectedItems.length > 0) {
                    console.log('Processing', allSelectedItems.length, 'selected items');
                    allSelectedItems.forEach((item, index) => {
                        console.log(`Looking for item ${index + 1}:`, item);

                        const itemCategory = item.category;
                        const itemId = normalizeId(item.id);
                        let itemCard = document.querySelector(`.item-card[data-id="${itemId}"][data-category="${itemCategory}"]`);
                        console.log('Primary selector result:', itemCard);

                        if (!itemCard) {
                            itemCard = document.querySelector(`.item-card[data-id="${itemId}"]`);
                            console.log('Fallback selector result:', itemCard);
                        }

                        if (!itemCard) {
                            const allCards = document.querySelectorAll('.item-card');
                            console.log('Searching by title in', allCards.length, 'cards');
                            for (let card of allCards) {
                                const titleElement = card.querySelector('.item-title, h3, h4, .card-title');
                                if (titleElement && titleElement.textContent.trim() === item.title) {
                                    itemCard = card;
                                    console.log('Found by title:', card);
                                    break;
                                }
                            }
                        }

                        console.log('Found item card:', itemCard);
                        if (itemCard) {
                            itemCard.classList.add('selected');

                            const selectBtn = itemCard.querySelector('.select-btn');
                            if (selectBtn) {
                                selectBtn.classList.add('selected');
                                selectBtn.innerHTML = '<i class="fas fa-check"></i>';
                            }

                            if (itemCategory !== 'food') {
                                const qtyInput = itemCard.querySelector('.qty-input');
                                if (qtyInput && item.quantity) {
                                    qtyInput.value = item.quantity;
                                    console.log('Set quantity for', item.title, ':', item.quantity);
                                }
                            }

                            const itemImageElement = itemCard.querySelector('.card-image img');
                            const itemData = {
                                id: itemId,
                                title: item.title,
                                price: itemCard.dataset.price || item.price_per_person || item.fixed_price || item.price,
                                category: itemCategory,
                                image: itemImageElement ? itemImageElement.src : (item.image || null),
                                eventTeams: itemCard.dataset.eventTeams || (item.eventTeams ? String(item.eventTeams) : ''),
                                quantity: item.quantity || 1
                            };

                            if (!findSelectedItem(itemId, itemCategory)) {
                                selectedItems.push(itemData);
                            }
                            console.log('Item selected:', item.title, 'Category:', itemCategory, 'Quantity:', item.quantity || 1);
                        } else {
                            console.warn('Item card not found for:', item);

                            const allCards = document.querySelectorAll('.item-card');
                            console.log('Available item cards:', Array.from(allCards).map(card => ({
                                id: card.getAttribute('data-id'),
                                category: card.getAttribute('data-category'),
                                title: card.querySelector('.item-title, h3, h4, .card-title')?.textContent?.trim()
                            })));
                        }
                    });
                } else {
                    console.warn('No selected items found in any format');
                }
            } else {
                console.log('Regular event-selection mode: Not auto-selecting items');
            }

            updateSelectedItemsDisplay();

            updateSelectedItemsList();

            updateCategoryCounts();

            updateAllowedEventTeams();
            filterItemsByEventTeam();

            console.log('Final selectedItems after loading:', selectedItems);
            console.log('Final category breakdown:', {
                decoration: selectedItems.filter(item => item.category === 'decoration').length,
                food: selectedItems.filter(item => item.category === 'food').length,
                service: selectedItems.filter(item => item.category === 'service').length
            });

            if (isReEstimation) {
                toast.info(`Previous estimation loaded for re-estimation! ${selectedItems.length} items selected. You can modify and recalculate.`, 4000);
            }

        }

        setTimeout(() => {
            console.log('Loading estimation data after DOM ready...');
            loadEstimationData();
        }, 200);
        @endif

        updateFilterTabs();
        filterItems();
        filterItemsByEventTeam();
        updateSelectedItemsList();
        updateCategoryCounts();

        console.log('Event selection page initialized');
    });
</script>
@endsection