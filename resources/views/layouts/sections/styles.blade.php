

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>

#global-search {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 0.5rem;
    color: #697a8d;
    transition: all 0.3s ease;
}

#global-search:focus {
    background: rgba(255, 255, 255, 0.95);
    border-color: #962C50;
    box-shadow: 0 0 0 0.2rem rgba(150, 44, 80, 0.25);
    color: #697a8d;
}

#global-search::placeholder {
    color: rgba(105, 122, 141, 0.7);
}

#search-results {
    border: 1px solid #d9dee3;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

#search-results a {
    transition: background-color 0.2s ease;
}

#search-results a:hover {
    background-color: #f5f5f9;
    text-decoration: none;
}

#search-results a:last-child {
    border-bottom: none !important;
}

.bg-label-primary {
    background-color: rgba(150, 44, 80, 0.1) !important;
    color: #962C50 !important;
}

.bg-label-success {
    background-color: rgba(40, 199, 111, 0.1) !important;
    color: #28c76f !important;
}

.bg-label-warning {
    background-color: rgba(255, 193, 7, 0.1) !important;
    color: #ffc107 !important;
}

@media (max-width: 768px) {
    #global-search {
        min-width: 200px !important;
    }

    #search-results {
        min-width: 300px !important;
    }
}

.bg-gradient-primary {
    background: linear-gradient(135deg, rgba(150, 44, 80, 0.8), rgba(212, 165, 184, 0.6)) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    box-shadow:
        0 8px 32px rgba(150, 44, 80, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
}

.card {
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    background: rgba(255, 255, 255, 0.1) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
    box-shadow:
        0 8px 32px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
    position: relative !important;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    border-radius: 1rem;
    pointer-events: none;
    z-index: 1;
}

.card > * {
    position: relative;
    z-index: 2;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.15) !important;
}

.avatar-initial {
    transition: all 0.3s ease;
}

.avatar-initial:hover {
    transform: scale(1.1);
}

.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-warning:hover,
.btn-outline-info:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}

.badge {
    font-weight: 500;
}

.btn-outline-primary,
.btn-outline-success,
.btn-outline-warning,
.btn-outline-info {
    border-width: 2px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background-color: #962C50;
    border-color: #962C50;
    color: white;
}

.btn-outline-success:hover {
    background-color: #28c76f;
    border-color: #28c76f;
    color: white;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #000;
}

.btn-outline-info:hover {
    background-color: #00cfe8;
    border-color: #00cfe8;
    color: white;
}

.bg-light {
    background-color: #f8f9fa !important;
    transition: all 0.3s ease;
}

.bg-light:hover {
    background-color: #e9ecef !important;
}

.fas {
    transition: all 0.3s ease;
}

.card:hover .fas {
    transform: scale(1.1);
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

@media (max-width: 768px) {
    .display-1 {
        font-size: 3rem !important;
    }

    .fs-2 {
        font-size: 1.5rem !important;
    }
}

.card {
    border-radius: 1rem !important;
    overflow: hidden;
}

.card-header {
    border-radius: 1rem 1rem 0 0 !important;
}

.card-body {
    border-radius: 0 0 1rem 1rem !important;
}

.avatar {
    border-radius: 0.75rem !important;
}

.avatar-initial {
    border-radius: 0.75rem !important;
}

.avatar-initial.rounded-circle {
    border-radius: 50% !important;
}

.btn {
    border-radius: 0.75rem !important;
    font-weight: 500;
}

.btn-sm {
    border-radius: 0.5rem !important;
}

.btn-lg {
    border-radius: 1rem !important;
}

.badge {
    border-radius: 0.5rem !important;
}

.badge.rounded-pill {
    border-radius: 50rem !important;
}

.form-control {
    border-radius: 0.75rem !important;
}

.form-select {
    border-radius: 0.75rem !important;
}

.dropdown-menu {
    border-radius: 0.75rem !important;
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.dropdown-item {
    border-radius: 0.5rem !important;
    margin: 0.25rem;
    padding: 0.5rem 0.75rem;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    border-radius: 0.5rem !important;
}

.navbar {
    border-radius: 0 0 1rem 1rem !important;
}

#global-search {
    border-radius: 2rem !important;
    padding: 0.75rem 1.25rem;
}

#search-results {
    border-radius: 1rem !important;
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.btn-outline-primary,
.btn-outline-success,
.btn-outline-warning,
.btn-outline-info {
    border-radius: 1rem !important;
    padding: 1.5rem 1rem;
}

.bg-light {
    border-radius: 0.75rem !important;
}

.card.h-100 {
    border-radius: 1.25rem !important;
}

.bg-gradient-primary {
    border-radius: 1.5rem !important;
}

.menu-item .menu-link {
    border-radius: 0.5rem !important;
    margin: 0.125rem 0;
}

.menu-item.active .menu-link {
    border-radius: 0.5rem !important;
}

.table {
    border-radius: 0.75rem !important;
    overflow: hidden;
}

.table thead th {
    border-radius: 0 !important;
}

.modal-content {
    border-radius: 1rem !important;
    border: none;
}

.modal-header {
    border-radius: 1rem 1rem 0 0 !important;
}

.modal-footer {
    border-radius: 0 0 1rem 1rem !important;
}

.alert {
    border-radius: 0.75rem !important;
    border: none;
}

.progress {
    border-radius: 0.5rem !important;
}

.progress-bar {
    border-radius: 0.5rem !important;
}

.rounded-xl {
    border-radius: 1rem !important;
}

.rounded-2xl {
    border-radius: 1.5rem !important;
}

.rounded-3xl {
    border-radius: 2rem !important;
}

.card,
.btn,
.avatar,
.badge,
.form-control,
.dropdown-menu,
.alert,
.progress {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card:hover {
    transform: translateY(-8px) scale(1.02);
    border-radius: 1.25rem !important;
    background: rgba(255, 255, 255, 0.2) !important;
    backdrop-filter: blur(25px) !important;
    -webkit-backdrop-filter: blur(25px) !important;
}

.btn:hover {
    transform: translateY(-2px);
    border-radius: 0.875rem !important;
}

.fas,
.far,
.fab {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.shadow-curved {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1), 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #962C50 0%, #d4a5b8 100%) !important;
    border-radius: 1.5rem !important;
}

@media (max-width: 768px) {
    .card {
        border-radius: 0.75rem !important;
    }

    .btn {
        border-radius: 0.5rem !important;
    }

    .avatar {
        border-radius: 0.5rem !important;
    }

    #global-search {
        border-radius: 1.5rem !important;
    }
}

.layout-menu-toggle .nav-link {
    padding: 0.75rem !important;
    border-radius: 0.75rem !important;
    transition: all 0.3s ease;
}

.layout-menu-toggle .nav-link:hover {
    background-color: rgba(150, 44, 80, 0.1) !important;
    transform: scale(1.1);
}

.layout-menu-toggle .fas.fa-bars {
    color: #697a8d !important;
    transition: all 0.3s ease;
}

.layout-menu-toggle .nav-link:hover .fas.fa-bars {
    color: #962C50 !important;
    transform: rotate(90deg);
}

.layout-menu-toggle .fas.fa-bars.fs-4 {
    font-size: 1.5rem !important;
    font-weight: 600;
}

.layout-menu-toggle .nav-link {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.layout-menu-toggle .nav-link:hover {
    box-shadow: 0 4px 8px rgba(150, 44, 80, 0.2);
}

.layout-menu {
    height: 100vh;
    overflow-y: auto;
}

.menu-inner {
    flex-grow: 1;
}

.menu-inner .menu-item {
    margin-bottom: 0.5rem;
}

.menu-inner .menu-link {
    padding: 0.875rem 1.5rem;
    border-radius: 0.75rem;
    margin: 0.25rem 0.75rem;
    transition: all 0.3s ease;
    font-weight: 500;
}

.menu-inner .menu-link:hover {
    background-color: rgba(150, 44, 80, 0.1);
    transform: translateX(4px);
    box-shadow: 0 2px 8px rgba(150, 44, 80, 0.15);
}

.menu-inner .menu-item.active .menu-link {
    background-color: #962C50;
    color: white;
    box-shadow: 0 4px 12px rgba(150, 44, 80, 0.3);
}

.menu-inner .menu-item.active .menu-link:hover {
    background-color: #782340;
    transform: translateX(4px);
}

.menu-inner .menu-icon {
    width: 1.5rem;
    margin-right: 0.75rem;
    font-size: 1.1rem;
}

.menu-inner .menu-sub {
    margin-left: 1rem;
    padding-left: 0.5rem;
    border-left: 2px solid rgba(150, 44, 80, 0.2);
}

.menu-inner .menu-sub .menu-link {
    padding: 0.625rem 1rem;
    margin: 0.125rem 0.5rem;
    font-size: 0.9rem;
    border-radius: 0.5rem;
}

.menu-inner .menu-sub .menu-link:hover {
    background-color: rgba(150, 44, 80, 0.08);
    transform: translateX(2px);
}

.menu-header {
    padding: 1rem 1.5rem 0.5rem;
    margin: 1rem 0.75rem 0.5rem;
    color: rgba(255, 255, 255, 0.6);
    font-weight: 600;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.menu-header-text {
    position: relative;
}

.menu-header-text::after {
    content: '';
    position: absolute;
    bottom: -0.5rem;
    left: 0;
    width: 2rem;
    height: 2px;
    background: linear-gradient(90deg, #962C50, transparent);
    border-radius: 1px;
}

.menu-footer {
    background: linear-gradient(135deg, rgba(150, 44, 80, 0.15) 0%, rgba(212, 165, 184, 0.1) 100%);
    border-top: 1px solid rgba(150, 44, 80, 0.3);
    margin-top: auto;
    backdrop-filter: blur(10px);
    position: relative;
}

.menu-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(150, 44, 80, 0.5), transparent);
}

.menu-footer .btn {
    border-radius: 0.75rem;
    font-weight: 500;
    transition: all 0.3s ease;
    background: rgba(150, 44, 80, 0.2);
    border: 1px solid rgba(150, 44, 80, 0.4);
    color: white;
    position: relative;
    overflow: hidden;
}

.menu-footer .btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.5s ease;
}

.menu-footer .btn:hover {
    background: rgba(150, 44, 80, 0.4);
    border-color: rgba(150, 44, 80, 0.6);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(150, 44, 80, 0.3);
}

.menu-footer .btn:hover::before {
    left: 100%;
}

.menu-footer .btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(150, 44, 80, 0.2);
}

.menu-footer .avatar {
    border: 2px solid rgba(150, 44, 80, 0.3);
    box-shadow: 0 2px 8px rgba(150, 44, 80, 0.2);
}

.menu-footer h6 {
    color: #000000;
    font-weight: 600;
}

.menu-footer small {
    color: rgba(0, 0, 0, 0.7);
}

.app-brand {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    min-height: 80px;
    display: flex;
    align-items: center;
}

.app-brand-link {
    transition: all 0.3s ease;
}

.app-brand-link:hover {
    transform: scale(1.02);
}

.app-brand-text {
    font-size: 1.25rem;
    font-weight: 700;
    background: linear-gradient(135deg, #962C50, #d4a5b8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.app-brand-logo img {
    transition: all 0.3s ease;
    filter: brightness(1) contrast(1);
}

.app-brand-logo img:hover {
    transform: scale(1.05);
    filter: brightness(1.1) contrast(1.1);
}

.app-brand-link:hover .app-brand-logo img {
    transform: scale(1.05);
}

.layout-menu-toggle {
    transition: all 0.3s ease;
}

.layout-menu-toggle:hover {
    background-color: rgba(150, 44, 80, 0.1);
    border-radius: 0.5rem;
}

.layout-menu::-webkit-scrollbar {
    width: 4px;
}

.layout-menu::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.layout-menu::-webkit-scrollbar-thumb {
    background: rgba(150, 44, 80, 0.5);
    border-radius: 2px;
}

.layout-menu::-webkit-scrollbar-thumb:hover {
    background: rgba(150, 44, 80, 0.7);
}

@media (max-width: 1199.98px) {
    .menu-inner .menu-link {
        padding: 0.75rem 1.25rem;
        margin: 0.25rem 0.5rem;
    }

    .menu-inner .menu-icon {
        width: 1.25rem;
        margin-right: 0.5rem;
    }

    .menu-footer {
        padding: 1rem;
    }

    .app-brand {
        min-height: 70px;
        padding: 1rem;
    }

    .app-brand-logo img {
        height: 40px !important;
    }
}

@media (max-width: 768px) {
    .app-brand {
        min-height: 60px;
        padding: 0.75rem;
    }

    .app-brand-logo img {
        height: 36px !important;
    }

    .app-brand-text {
        font-size: 1rem;
    }
}

.card-body {
    background: rgba(255, 255, 255, 0.05) !important;
    backdrop-filter: blur(10px) !important;
    -webkit-backdrop-filter: blur(10px) !important;
}

.card-header {
    background: rgba(255, 255, 255, 0.1) !important;
    backdrop-filter: blur(15px) !important;
    -webkit-backdrop-filter: blur(15px) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.card.h-100 {
    background: rgba(255, 255, 255, 0.08) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
}

.card .btn {
    background: rgba(255, 255, 255, 0.1) !important;
    backdrop-filter: blur(10px) !important;
    -webkit-backdrop-filter: blur(10px) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

.card .btn:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    backdrop-filter: blur(15px) !important;
    -webkit-backdrop-filter: blur(15px) !important;
}

</style>

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/materialdesignicons.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.css')) }}" />

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/core.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/theme-default.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/demo.css')) }}" />

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')) }}" />

@yield('vendor-style')

@yield('page-style')
