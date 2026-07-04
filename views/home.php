<section id="view-home" class="view with-bottom-nav">
            <div class="home-header">
                <div style="display: flex; align-items: center; gap: 0px;">
                    <img src="<?php echo $basePath; ?>assets/images/logosolo.png?v=<?php echo time(); ?>" alt="FlexPay Logo" style="height: 44px; width: 44px; object-fit: contain; transform: scale(1.5); transform-origin: center; margin-left: 4px; margin-right: -8px;">
                    <span style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px; color: white;">FLEX<span style="color: #FF9900;">PAY</span></span>
                </div>
                <button class="notif-btn" style="font-size: 22px;" onclick="app.openNotifications()"><i class="fa-regular fa-bell"></i></button>
            </div>
            
            <div class="container">
                <div class="wallet-card">
                    <div class="wallet-header">
                        <span>Solde Wallet</span>
                        <i class="fa-solid fa-arrow-up-right-from-square" style="opacity: 0.7;"></i>
                    </div>
                    <div class="wallet-balance">
                        <h2 id="home-balance-display">0 <span>FCFA</span></h2>
                        <i class="fa-regular fa-eye" style="cursor: pointer; font-size: 16px; opacity: 0.8;" onclick="app.toggleBalanceObscure(this)"></i>
                    </div>
                    <button class="btn btn-recharge" onclick="app.navigate('view-wallet')"><i class="fa-solid fa-plus" style="font-size: 14px; margin-right: 6px;"></i> Recharger</button>
                </div>

                <!-- Services Populaires -->
                <div class="section-title mt-4">
                    <h3 style="font-size: 16px; font-weight: 700;">Services populaires</h3>
                    <a href="#" onclick="app.navigate('view-services')">Voir tout</a>
                </div>
                <div class="services-grid" style="margin-top: 10px; margin-bottom: 12px;">
                    <div class="service-item" onclick="app.openOrderForm('Netflix')">
                        <div class="service-icon" style="background:transparent; padding: 0; overflow:hidden;">
                            <img src="<?php echo $basePath; ?>assets/images/services/logo_netflix.png" alt="Netflix" style="width:100%; height:100%; object-fit:contain; border-radius:14px;">
                        </div>
                        <span>Netflix</span>
                    </div>
                    <div class="service-item" onclick="app.openOrderForm('Spotify')">
                        <div class="service-icon" style="background:transparent; padding: 0; overflow:hidden;">
                            <img src="<?php echo $basePath; ?>assets/images/services/logo_spotify.png" alt="Spotify" style="width:100%; height:100%; object-fit:contain; border-radius:14px;">
                        </div>
                        <span>Spotify</span>
                    </div>
                    <div class="service-item" onclick="app.openOrderForm('Shein')">
                        <div class="service-icon" style="background:transparent; padding: 0; overflow:hidden;">
                            <img src="<?php echo $basePath; ?>assets/images/services/logo_shein.png" alt="Shein" style="width:100%; height:100%; object-fit:contain; border-radius:14px;">
                        </div>
                        <span>Shein</span>
                    </div>
                    <div class="service-item" onclick="app.openOrderForm('Amazon')">
                        <div class="service-icon" style="background:transparent; padding: 0; overflow:hidden;">
                            <img src="<?php echo $basePath; ?>assets/images/services/logo_amazone.png" alt="Amazon" style="width:100%; height:100%; object-fit:contain; border-radius:14px;">
                        </div>
                        <span>Amazon</span>
                    </div>
                    <div class="service-item" onclick="app.openOrderForm('AliExpress')">
                        <div class="service-icon" style="background:transparent; padding: 0; overflow:hidden;">
                            <img src="<?php echo $basePath; ?>assets/images/services/logo_aliexpress.webp" alt="AliExpress" style="width:100%; height:100%; object-fit:contain; border-radius:14px;">
                        </div>
                        <span>AliExpress</span>
                    </div>
                    <div class="service-item" onclick="app.openOrderForm('Disney+')">
                        <div class="service-icon" style="background:#fff; padding: 10px; overflow:hidden;">
                            <img src="<?php echo $basePath; ?>assets/images/services/logo_disney.png" alt="Disney+" style="width:100%; height:100%; object-fit:contain;">
                        </div>
                        <span>Disney+</span>
                    </div>
                    <div class="service-item" onclick="app.openOrderForm('Amazon Prime')">
                        <div class="service-icon" style="background:transparent; padding: 0; overflow:hidden;">
                            <img src="<?php echo $basePath; ?>assets/images/services/logo_amazone.png" alt="Amazon Prime" style="width:100%; height:100%; object-fit:contain; border-radius:14px;">
                        </div>
                        <span>Amazon Prime</span>
                    </div>
                </div>

                <!-- Dernières transactions -->
                <div class="section-title" style="margin-top: 16px;">
                    <h3 style="font-size: 16px; font-weight: 700;">Dernières transactions</h3>
                    <a href="#" onclick="app.navigate('view-wallet')">Voir tout</a>
                </div>
                <div class="transactions-list" id="home-tx-list">
                    <!-- Loaded dynamically -->
                </div>
            </div>
        </section>