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
    <link href="{{ asset('admin/css/admin-theme.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .toast {
            background: #263D32;
            color: #FFFFFF;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 10px 30px rgba(32, 33, 31, 0.15);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(100%) scale(0.9);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            min-width: 300px;
            opacity: 0;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .toast.show {
            transform: translateX(0) scale(1);
            opacity: 1;
        }

        .toast.hide {
            transform: translateX(100%) scale(0.9);
            opacity: 0;
        }

        .toast.success {
            background: #263D32;
            border-left: 4px solid #B9975B;
        }

        .toast.error {
            background: #C24141;
            border-left: 4px solid #FFFFFF;
        }

        .toast.info {
            background: #2B6CB0;
            border-left: 4px solid #B9975B;
        }

        .toast-icon {
            font-size: 18px;
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
        }

        .toast-close:hover {
            opacity: 1;
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
            min-width: 38px;
            height: 38px;
            padding: 6px 10px;
            border: 1px solid #E6E3DC;
            border-radius: 8px;
            background-color: #FFFFFF;
            color: #20211F;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .pagination-btn:hover {
            background-color: #F2F0EB;
            border-color: #B9975B;
            color: #263D32;
        }

        .pagination-btn.active {
            background-color: #263D32;
            border-color: #263D32;
            color: #FFFFFF;
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