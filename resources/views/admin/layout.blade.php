<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Encore Events Admin Panel">
    <meta name="author" content="Encore Events">
    <meta name="keywords" content="encore events, admin, dashboard, event management">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.svg') }}" />

    <title>@yield('title', 'Admin Panel') - Encore Events</title>

    <link href="{{ asset('adminkit-css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/breadcrumbs.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .toast {
            background: #962C50;
            color: white;
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateX(100%) scale(0.8);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            min-width: 300px;
            opacity: 0;
            position: relative;
            overflow: hidden;
        }

        .toast::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .toast.show {
            transform: translateX(0) scale(1);
            opacity: 1;
        }

        .toast.show::before {
            left: 100%;
        }

        .toast.hide {
            transform: translateX(100%) scale(0.8);
            opacity: 0;
        }

        .toast.success {
            background: #28a745;
        }

        .toast.error {
            background: #dc3545;
        }

        .toast.info {
            background: #0dcaf0;
        }

        .toast-icon {
            font-size: 18px;
            animation: bounce 0.6s ease-in-out;
        }

        .toast-close {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-left: auto;
            opacity: 0.7;
            transition: all 0.2s ease;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-close:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .toast-message {
            flex: 1;
            animation: slideInText 0.5s ease-out 0.2s both;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes slideInText {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            50% {
                box-shadow: 0 4px 20px rgba(40, 167, 69, 0.3);
            }

            100% {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }
        }

        .toast.success {
            animation: pulse 2s ease-in-out infinite;
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 0 0 8px 8px;
            width: 100%;
            transform-origin: left;
        }

        @keyframes progress {
            0% {
                transform: scaleX(1);
            }

            100% {
                transform: scaleX(0);
            }
        }

        .toast:hover {
            transform: translateX(0) scale(1.02);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .toast:hover .toast-progress {
            animation-play-state: paused;
        }

        .toast:nth-child(1) {
            animation-delay: 0ms;
        }

        .toast:nth-child(2) {
            animation-delay: 100ms;
        }

        .toast:nth-child(3) {
            animation-delay: 200ms;
        }

        .toast:nth-child(4) {
            animation-delay: 300ms;
        }

        .toast:nth-child(5) {
            animation-delay: 400ms;
        }
    </style>
    <style>

        :root {
            --bs-primary: #962C50;
            --bs-primary-rgb: 150, 44, 80;
        }

        .btn-primary {
            background-color: #962C50;
            border-color: #962C50;
        }

        .btn-primary:hover {
            background-color: #7a2441;
            border-color: #7a2441;
        }

        .btn-primary:focus {
            background-color: #7a2441;
            border-color: #7a2441;
            box-shadow: 0 0 0 0.2rem rgba(150, 44, 80, 0.25);
        }

        .btn-outline-primary {
            color: #962C50;
            border-color: #962C50;
        }

        .btn-outline-primary:hover {
            background-color: #962C50;
            border-color: #962C50;
        }

        .text-primary {
            color: #962C50 !important;
        }

        .bg-primary {
            background-color: #962C50 !important;
        }

        .border-primary {
            border-color: #962C50 !important;
        }

        .pagination-btn.active {
            background-color: #962C50;
            border-color: #962C50;
        }

        .pagination-btn.active:hover {
            background-color: #7a2441;
            border-color: #7a2441;
        }

        .sidebar-item.active .sidebar-link {
            background-color: #962C50;
            color: white;
        }

        .sidebar-item.active .sidebar-link:hover {
            background-color: #7a2441;
        }

        .navbar-brand {
            color: #962C50;
        }

        .card-header {
            border-bottom-color: rgba(150, 44, 80, 0.125);
        }

        .border-bottom {
            border-bottom-color: rgba(150, 44, 80, 0.125) !important;
        }

        .alert-primary {
            background-color: rgba(150, 44, 80, 0.1);
            border-color: rgba(150, 44, 80, 0.2);
            color: #962C50;
        }

        .form-control:focus {
            border-color: #962C50;
            box-shadow: 0 0 0 0.2rem rgba(150, 44, 80, 0.25);
        }

        .form-select:focus {
            border-color: #962C50;
            box-shadow: 0 0 0 0.2rem rgba(150, 44, 80, 0.25);
        }

        .dropdown-item:focus {
            background-color: rgba(150, 44, 80, 0.1);
        }

        .dropdown-item:hover {
            background-color: rgba(150, 44, 80, 0.1);
        }

        .badge.bg-primary {
            background-color: #962C50 !important;
        }

        .badge {
            color: #962C50 !important;
        }

        .avatar.bg-primary {
            background-color: #962C50 !important;
        }

        .hot-toast {
            font-family: 'Inter', sans-serif !important;
        }

        .hot-toast-success {
            background-color: #962C50 !important;
            color: white !important;
            border: none !important;
        }

        .hot-toast-success .hot-toast-icon {
            color: white !important;
        }

        .hot-toast-error {
            background-color: #dc3545 !important;
            color: white !important;
            border: none !important;
        }

        .hot-toast-error .hot-toast-icon {
            color: white !important;
        }

        .hot-toast-info {
            background-color: #0dcaf0 !important;
            color: white !important;
            border: none !important;
        }

        .hot-toast-info .hot-toast-icon {
            color: white !important;
        }

        .custom-pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .pagination-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            border: 1px solid #e3e6f0;
            border-radius: 6px;
            background-color: #fff;
            color: #5a5c69;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .pagination-btn:hover {
            background-color: rgba(150, 44, 80, 0.1);
            border-color: #962C50;
            color: #962C50;
            text-decoration: none;
        }

        .pagination-btn.active {
            background-color: #962C50;
            border-color: #962C50;
            color: #fff;
        }

        .pagination-btn.active:hover {
            background-color: #7a2441;
            border-color: #7a2441;
            color: #fff;
        }

        .pagination-btn.disabled {
            background-color: #f8f9fc;
            border-color: #e3e6f0;
            color: #b7b9cc;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination-btn.disabled:hover {
            background-color: #f8f9fc;
            border-color: #e3e6f0;
            color: #b7b9cc;
        }

        .pagination-dots {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            color: #5a5c69;
            font-size: 14px;
            font-weight: 500;
        }

        .fallback-icon {
            display: none;
            font-size: 18px;
            font-weight: bold;
        }

        .pagination-btn:not(:has(svg)) .fallback-icon {
            display: inline;
        }

        .pagination-btn i[data-feather] {
            display: inline;
        }

        .pagination-btn:not(:has(svg)) i[data-feather] {
            display: none;
        }

        .pagination-btn:not(:has(svg)) .fallback-icon {
            display: inline;
        }

        @media (max-width: 768px) {
            .custom-pagination {
                gap: 4px;
            }

            .pagination-btn {
                min-width: 36px;
                height: 36px;
                padding: 6px 8px;
                font-size: 13px;
            }

            .pagination-dots {
                min-width: 36px;
                height: 36px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <div class="toast-container" id="toast-container"
        data-welcome="{{ session('welcome') }}"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}"
        data-info="{{ session('info') }}"></div>

    <div class="wrapper">

        @include('admin.sections.menu')

        <div class="main">

            @include('admin.sections.navbar')

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            @include('admin.sections.footer')

        </div>

    </div>

    <script src="{{ asset('adminkit-js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
    <script>

        class CustomToast {
            constructor() {
                this.container = document.getElementById('toast-container');
            }

            show(message, type = 'success', duration = 3000) {
                const toast = document.createElement('div');
                toast.className = `toast ${type}`;

                const icon = this.getIcon(type);
                toast.innerHTML = `
                    <span class="toast-icon">${icon}</span>
                    <span class="toast-message">${message}</span>
                    <button class="toast-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="toast-progress"></div>
                `;

                this.container.appendChild(toast);

                setTimeout(() => toast.classList.add('show'), 100);

                const progressBar = toast.querySelector('.toast-progress');
                if (progressBar) {
                    progressBar.style.animation = `progress ${duration}ms linear forwards`;
                }

                setTimeout(() => {
                    toast.classList.add('hide');
                    setTimeout(() => toast.remove(), 400);
                }, duration);
            }

            getIcon(type) {
                const icons = {
                    success: '<i class="fas fa-check-circle"></i>',
                    error: '<i class="fas fa-exclamation-circle"></i>',
                    info: '<i class="fas fa-info-circle"></i>',
                    warning: '<i class="fas fa-exclamation-triangle"></i>'
                };
                return icons[type] || icons.success;
            }

            success(message, duration = 3000) {
                this.show(message, 'success', duration);
            }

            error(message, duration = 4000) {
                this.show(message, 'error', duration);
            }

            info(message, duration = 3000) {
                this.show(message, 'info', duration);
            }

            warning(message, duration = 3000) {
                this.show(message, 'warning', duration);
            }
        }

        const toast = new CustomToast();

        window.toast = toast;

        window.showToast = {
            success: function(message, duration = 3000) {
                toast.success(message, duration);
            },
            error: function(message, duration = 4000) {
                toast.error(message, duration);
            },
            info: function(message, duration = 3000) {
                toast.info(message, duration);
            },
            warning: function(message, duration = 3000) {
                toast.warning(message, duration);
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const toastContainer = document.getElementById('toast-container');
            if (toastContainer) {
                if (toastContainer.dataset.welcome) {
                    toast.success(toastContainer.dataset.welcome, 4000);
                }
                if (toastContainer.dataset.success) {
                    toast.success(toastContainer.dataset.success, 3000);
                }
                if (toastContainer.dataset.error) {
                    toast.error(toastContainer.dataset.error, 4000);
                }
                if (toastContainer.dataset.info) {
                    toast.info(toastContainer.dataset.info, 3000);
                }
            }
        });
    </script>
</body>

</html>