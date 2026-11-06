<!DOCTYPE html>
<html lang="en">

<head>
    @include('public.partials.head')
</head>

<body>
    @include('public.partials.header')

    @yield('content')

    @include('public.partials.footer')

    @include('public.partials.scripts')

    <div class="toast-container" id="toast-container"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}"
        data-info="{{ session('info') }}"></div>

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
            border-radius: 12px;
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

        .toast::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
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

        .toast.warning {
            background: #B7791F;
            border-left: 4px solid #FFFFFF;
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

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
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

        .toast:nth-child(1) { animation-delay: 0ms; }
        .toast:nth-child(2) { animation-delay: 100ms; }
        .toast:nth-child(3) { animation-delay: 200ms; }
        .toast:nth-child(4) { animation-delay: 300ms; }
        .toast:nth-child(5) { animation-delay: 400ms; }
    </style>

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
                if (toastContainer.dataset.success) {
                    toast.success(toastContainer.dataset.success, 4000);
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
