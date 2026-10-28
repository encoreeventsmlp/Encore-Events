{{--
<div id="preloader" class="preloader">
    <div class="preloader-container">

        <div class="preloader-text">
            <h3 class="loading-title">Encore Events</h3>
            <p class="loading-subtitle">Creating Your Perfect Event Experience</p>
            <div class="loading-dots">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        <div class="preloader-decoration">
            <div class="decoration-circle circle-1"></div>
            <div class="decoration-circle circle-2"></div>
            <div class="decoration-circle circle-3"></div>
        </div>
    </div>
</div>

<style>

.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #962C50 0%, #802544 50%, #6B1A3A 100%);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 1;
    visibility: visible;
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    transform: scale(1);
}

.preloader.fade-out {
    opacity: 0;
    visibility: hidden;
    transform: scale(1.1);
}

.preloader.slide-out {
    transform: translateY(-100%);
    opacity: 0;
}

.preloader.zoom-out {
    transform: scale(0.8);
    opacity: 0;
}

.preloader.spin-out {
    transform: rotate(360deg) scale(0.5);
    opacity: 0;
}

.preloader.flip-out {
    transform: rotateY(90deg) scale(0.8);
    opacity: 0;
}

.preloader.bounce-out {
    animation: bounceOut 0.8s ease-in-out forwards;
}

.preloader.shake-out {
    animation: shakeOut 0.8s ease-in-out forwards;
}

.preloader.pulse-out {
    animation: pulseOut 0.8s ease-in-out forwards;
}

.preloader.rotate-out {
    transform: rotate(180deg) translateY(-50px);
    opacity: 0;
}

.preloader.slide-left {
    transform: translateX(-100%);
    opacity: 0;
}

.preloader.slide-right {
    transform: translateX(100%);
    opacity: 0;
}

.preloader.dissolve {
    animation: dissolve 0.8s ease-in-out forwards;
}

.preloader-container {
    text-align: center;
    position: relative;
    max-width: 400px;
    width: 100%;
    padding: 2rem;
}

.preloader-container {
    animation: containerFloat 3s ease-in-out infinite, containerPulse 2s ease-in-out infinite;
}

@keyframes containerFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
}

@keyframes containerPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.02); }
}

.preloader-text {
    color: white;
    margin-bottom: 2rem;
    animation: textFloat 3s ease-in-out infinite;
}

.loading-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-family: 'Dancing Script', cursive;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    animation: titleGlow 2s ease-in-out infinite alternate, titleWave 3s ease-in-out infinite;
    display: inline-block;
}

.loading-subtitle {
    font-size: 1rem;
    margin-bottom: 1rem;
    opacity: 0.9;
    font-weight: 300;
    animation: subtitleFade 2.5s ease-in-out infinite;
}

@keyframes titleGlow {
    0% { text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); }
    100% { text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(255, 255, 255, 0.3); }
}

@keyframes titleWave {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-2px) rotate(1deg); }
    50% { transform: translateY(-4px) rotate(0deg); }
    75% { transform: translateY(-2px) rotate(-1deg); }
}

@keyframes subtitleFade {
    0%, 100% { opacity: 0.9; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.02); }
}

@keyframes textFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-3px); }
}

.loading-dots {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    animation: dotsContainer 2s ease-in-out infinite;
}

.dot {
    width: 8px;
    height: 8px;
    background: #ffffff;
    border-radius: 50%;
    animation: dotPulse 1.5s ease-in-out infinite, dotGlow 2s ease-in-out infinite;
    box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
}

.dot:nth-child(2) {
    animation-delay: 0.3s;
    background: #ffd700;
    box-shadow: 0 0 8px rgba(255, 215, 0, 0.6);
}

.dot:nth-child(3) {
    animation-delay: 0.6s;
    background: #ff6b6b;
    box-shadow: 0 0 10px rgba(255, 107, 107, 0.7);
}

@keyframes dotPulse {
    0%, 100% {
        transform: scale(1);
        opacity: 0.7;
    }
    50% {
        transform: scale(1.4);
        opacity: 1;
    }
}

@keyframes dotGlow {
    0%, 100% {
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }
    50% {
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
    }
}

@keyframes dotsContainer {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-2px); }
}

.preloader-decoration {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
}

.decoration-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 4s ease-in-out infinite, circleGlow 3s ease-in-out infinite;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
}

.circle-1 {
    width: 20px;
    height: 20px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.circle-2 {
    width: 15px;
    height: 15px;
    top: 60%;
    right: 15%;
    animation-delay: 1s;
}

.circle-3 {
    width: 25px;
    height: 25px;
    bottom: 20%;
    left: 20%;
    animation-delay: 2s;
}

.circle-4 {
    width: 12px;
    height: 12px;
    top: 30%;
    right: 25%;
    animation-delay: 1.5s;
}

.circle-5 {
    width: 18px;
    height: 18px;
    bottom: 30%;
    right: 30%;
    animation-delay: 2.5s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
        opacity: 0.7;
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg) scale(1);
        opacity: 0.3;
    }
    25% {
        transform: translateY(-10px) rotate(90deg) scale(1.1);
        opacity: 0.5;
    }
    50% {
        transform: translateY(-20px) rotate(180deg) scale(1.2);
        opacity: 0.7;
    }
    75% {
        transform: translateY(-10px) rotate(270deg) scale(1.1);
        opacity: 0.5;
    }
}

@keyframes circleGlow {
    0%, 100% {
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
    }
    50% {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
        background: rgba(255, 255, 255, 0.2);
    }
}

@keyframes bounceOut {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    25% {
        transform: scale(1.1);
        opacity: 0.8;
    }
    50% {
        transform: scale(0.9);
        opacity: 0.6;
    }
    75% {
        transform: scale(1.05);
        opacity: 0.3;
    }
    100% {
        transform: scale(0.3);
        opacity: 0;
    }
}

@keyframes shakeOut {
    0% {
        transform: translateX(0) scale(1);
        opacity: 1;
    }
    10% {
        transform: translateX(-10px) scale(1);
        opacity: 0.9;
    }
    20% {
        transform: translateX(10px) scale(1);
        opacity: 0.8;
    }
    30% {
        transform: translateX(-8px) scale(0.95);
        opacity: 0.7;
    }
    40% {
        transform: translateX(8px) scale(0.9);
        opacity: 0.6;
    }
    50% {
        transform: translateX(-6px) scale(0.85);
        opacity: 0.5;
    }
    60% {
        transform: translateX(6px) scale(0.8);
        opacity: 0.4;
    }
    70% {
        transform: translateX(-4px) scale(0.7);
        opacity: 0.3;
    }
    80% {
        transform: translateX(4px) scale(0.6);
        opacity: 0.2;
    }
    90% {
        transform: translateX(-2px) scale(0.4);
        opacity: 0.1;
    }
    100% {
        transform: translateX(0) scale(0.2);
        opacity: 0;
    }
}

@keyframes pulseOut {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    25% {
        transform: scale(1.2);
        opacity: 0.8;
    }
    50% {
        transform: scale(0.8);
        opacity: 0.6;
    }
    75% {
        transform: scale(1.1);
        opacity: 0.3;
    }
    100% {
        transform: scale(0.1);
        opacity: 0;
    }
}

@keyframes dissolve {
    0% {
        transform: scale(1);
        opacity: 1;
        filter: blur(0px);
    }
    25% {
        transform: scale(1.05);
        opacity: 0.8;
        filter: blur(1px);
    }
    50% {
        transform: scale(0.95);
        opacity: 0.6;
        filter: blur(2px);
    }
    75% {
        transform: scale(0.9);
        opacity: 0.3;
        filter: blur(4px);
    }
    100% {
        transform: scale(0.8);
        opacity: 0;
        filter: blur(8px);
    }
}

@media (max-width: 768px) {
    .preloader-container {
        padding: 1rem;
        max-width: 300px;
    }

    .loading-title {
        font-size: 1.5rem;
    }

    .loading-subtitle {
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .preloader-container {
        padding: 0.5rem;
        max-width: 250px;
    }

    .loading-title {
        font-size: 1.3rem;
    }

    .loading-subtitle {
        font-size: 0.8rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('preloader');

    const closingAnimation = 'fade-out';

    function hidePreloader() {
        if (preloader && !preloader.classList.contains('fade-out')) {

            preloader.classList.add(closingAnimation);

            setTimeout(function() {
                if (preloader && preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 800);
        }
    }

    window.addEventListener('load', function() {
        setTimeout(hidePreloader, 1000);
    });

    setTimeout(hidePreloader, 5000);

    let userInteracted = false;

    ['click', 'keydown', 'scroll', 'touchstart'].forEach(function(event) {
        document.addEventListener(event, function() {
            if (!userInteracted && preloader &&
                !preloader.classList.contains('fade-out')) {
                userInteracted = true;

                setTimeout(hidePreloader, 200);
            }
        }, { once: true });
    });
});
</script>
--}}
