<nav id="bottom-nav" style="display:none;">
            <div class="nav-indicator" id="nav-indicator"></div>
            <div class="nav-item active" id="nav-home" onclick="app.navigateTab('view-home', this)">
                <i class="fa-solid fa-house"></i>
                <span>Accueil</span>
            </div>
            <div class="nav-item" id="nav-orders" onclick="app.navigateTab('view-orders', this)">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Commandes</span>
            </div>
            <div class="nav-item" id="nav-wallet" onclick="app.navigateTab('view-wallet', this)">
                <i class="fa-solid fa-wallet"></i>
                <span>Wallet</span>
            </div>
            <div class="nav-item" id="nav-profile" onclick="app.navigateTab('view-profile', this)">
                <i class="fa-regular fa-user"></i>
                <span>Profil</span>
            </div>
        </nav>