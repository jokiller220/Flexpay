<header id="desktop-header">
            <div style="display: flex; align-items: center; gap: 8px;">
                <img src="<?php echo $basePath; ?>assets/images/logosolo.png?v=<?php echo time(); ?>" alt="FlexPay Logo" style="height: 32px; margin-left: 20px;">
                <span style="font-size: 22px; font-weight: 800; color: white;">FLEX<span style="color: #FF9900;">PAY</span></span>
            </div>

            <div class="desktop-nav-links">
                <span class="desktop-nav-item active" id="desk-home" onclick="app.navigate('view-home')">Accueil</span>
                <span class="desktop-nav-item" id="desk-orders" onclick="app.navigate('view-orders')">Commandes</span>
                <span class="desktop-nav-item" id="desk-wallet" onclick="app.navigate('view-wallet')">Wallet</span>
                <span class="desktop-nav-item" id="desk-profile" onclick="app.navigate('view-profile')">Profil</span>
            </div>

            <div style="display: flex; align-items: center; gap: 20px;">
                <button class="notif-btn" style="font-size: 1.3rem;"><i class="fa-regular fa-bell"></i></button>
                <img id="nav-avatar-display" src="<?php echo $basePath; ?>assets/images/avatar.png" alt="Avatar" style="width: 36px; height: 36px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.2); cursor: pointer; object-fit: cover;" onclick="app.navigate('view-profile')">
            </div>
        </header>