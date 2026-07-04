<section id="view-otp" class="view no-nav">
            <div class="header-simple">
                <button class="back-btn" onclick="window.history.back()"><i class="fa-solid fa-chevron-left"></i></button>
                <h2>Vérification OTP</h2>
            </div>
            <div class="otp-container">
                <div class="otp-illustration" style="margin: 10px 0 20px 0; display: flex; justify-content: center;">
                    <svg width="120" height="120" viewBox="0 0 100 100" fill="none">
                        <rect x="32" y="10" width="36" height="68" rx="8" stroke="#6A0DAD" strokeWidth="3" fill="#0B1021" />
                        <rect x="36" y="14" width="28" height="52" rx="4" fill="#FFFFFF" stroke="#6A0DAD" strokeWidth="1" />
                        <circle cx="50" cy="71" r="3" fill="#6A0DAD" />
                        <circle cx="43" cy="22" r="1.5" fill="#E5E7EB" />
                        <circle cx="50" cy="22" r="1.5" fill="#E5E7EB" />
                        <circle cx="57" cy="22" r="1.5" fill="#E5E7EB" />
                        <circle cx="43" cy="28" r="1.5" fill="#E5E7EB" />
                        <circle cx="50" cy="28" r="1.5" fill="#E5E7EB" />
                        <circle cx="57" cy="28" r="1.5" fill="#E5E7EB" />
                        <circle cx="43" cy="34" r="1.5" fill="#E5E7EB" />
                        <circle cx="50" cy="34" r="1.5" fill="#E5E7EB" />
                        <circle cx="57" cy="34" r="1.5" fill="#E5E7EB" />
                        <rect x="52" y="18" width="40" height="24" rx="6" fill="#8A2BE2" style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15));" />
                        <path d="M 53,30 L 46,36 L 56,36 Z" fill="#8A2BE2" />
                        <text x="72" y="33" fill="#FFFFFF" fontSize="10" fontWeight="800" textAnchor="middle">1234</text>
                    </svg>
                </div>
                <p class="text-center">Nous avons envoyé un code<br>à <strong id="otp-phone-display">+228 97 12 34 56</strong></p>
                <div class="otp-inputs">
                    <input type="number" maxlength="1" placeholder="1" oninput="app.otpInput(this, 0)" onkeydown="app.otpKeydown(event, 0)">
                    <input type="number" maxlength="1" placeholder="2" oninput="app.otpInput(this, 1)" onkeydown="app.otpKeydown(event, 1)">
                    <input type="number" maxlength="1" placeholder="3" oninput="app.otpInput(this, 2)" onkeydown="app.otpKeydown(event, 2)">
                    <input type="number" maxlength="1" placeholder="4" oninput="app.otpInput(this, 3)" onkeydown="app.otpKeydown(event, 3)">
                </div>
                <p class="resend-link text-center">Renvoyer le code dans <span class="timer">00:45</span></p>
                <button class="btn btn-primary btn-block mt-4" onclick="app.confirmOTP()">Vérifier</button>
            </div>
        </section>