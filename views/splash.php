<section id="view-splash" class="view no-nav active" style="background-color: #0A0A1A !important; display: flex; justify-content: center; align-items: center; position: fixed; top: -50px; left: 0; right: 0; height: 120vh !important; overflow: hidden; padding: 0; margin: 0; z-index: 9999;">
    <div class="splash-logo" style="width: 400px; height: 400px; margin-top: -150px;">
        <!-- Splash screen logo maximized and shifted up -->
        <img src="<?php echo $basePath; ?>assets/images/logosolo.png" alt="FlexPay Logo" style="width: 100%; height: 100%; object-fit: contain;">
    </div>

    <!-- Loading Animation -->
    <div style="position: absolute; bottom: 120px; display: flex; flex-direction: column; align-items: center; width: 100%;">
        <div style="display: flex; gap: 8px; margin-bottom: 20px;">
            <div class="loading-dot" style="animation-delay: 0s;"></div>
            <div class="loading-dot" style="animation-delay: 0.2s;"></div>
            <div class="loading-dot" style="animation-delay: 0.4s;"></div>
        </div>
        <div style="width: 180px; height: 4px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden;">
            <div class="loading-progress"></div>
        </div>
    </div>

    <style>
        .loading-dot {
            width: 8px;
            height: 8px;
            background: #FFFFFF;
            border-radius: 50%;
            animation: pulseDot 1.2s infinite ease-in-out;
        }
        .loading-progress {
            width: 0%;
            height: 100%;
            background: #FF9900;
            border-radius: 4px;
            animation: fillProgress 2.5s ease-out forwards;
        }
        @keyframes pulseDot {
            0%, 100% { opacity: 0.2; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        @keyframes fillProgress {
            0% { width: 0%; }
            30% { width: 40%; }
            70% { width: 85%; }
            100% { width: 100%; }
        }
    </style>
</section>
