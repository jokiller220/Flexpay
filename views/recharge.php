<div id="view-recharge" class="view">
    <!-- Header -->
    <div class="header-simple" style="padding-top: calc(30px + var(--sat)); padding-bottom: 15px;">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <h2 id="recharge-page-title" style="text-align: center; margin-right: 40px; font-weight: 700;">Recharger le Wallet</h2>
    </div>

    <!-- Content -->
    <div class="content-padded" style="display:flex; flex-direction:column; align-items:center; margin-top: 20px;">
        <!-- Provider Icon & Info -->
        <div id="recharge-provider-icon" style="width: 80px; height: 80px; border-radius: 20px; display: flex; justify-content: center; align-items: center; font-size: 36px; margin-bottom: 15px; background: var(--secondary); color: white;">
            <i class="fa-solid fa-wallet"></i>
        </div>
        <p id="recharge-provider-desc" style="font-size: 0.9rem; color: var(--text-muted); text-align: center; margin-bottom: 30px;">
            Saisissez les informations pour recharger votre compte.
        </p>

        <!-- Form -->
        <form id="recharge-form" onsubmit="app.submitRecharge(event)" style="width: 100%;">
            <div class="of-section">
                <div class="of-q">Méthode de rechargement</div>
                <div class="input-group">
                    <i class="fa-solid fa-building-columns"></i>
                    <select id="recharge-method" required style="width: 100%; border: none; background: transparent; color: var(--text-main); font-size: 1.05rem; padding: 12px; padding-left: 50px; outline: none; -webkit-appearance: none; appearance: none;">
                        <option value="" disabled selected>Choisissez un moyen de paiement</option>
                        <option value="Flooz">Flooz (Moov Africa)</option>
                        <option value="T-Money">T-Money (Togocel)</option>
                    </select>
                    <!-- Custom dropdown arrow -->
                    <i class="fa-solid fa-chevron-down" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none;"></i>
                </div>
            </div>

            <div class="of-section">
                <div class="of-q">Numéro de téléphone</div>
                <div class="input-group">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <input type="tel" id="recharge-phone" placeholder="Numéro de compte" required style="padding-left: 50px; font-size: 1.05rem;">
                </div>
            </div>

            <div class="of-section">
                <div class="of-q">Montant à recharger</div>
                <div class="input-group">
                    <i class="fa-solid fa-coins"></i>
                    <input type="number" id="recharge-amount" placeholder="Montant (FCFA)" min="500" required style="padding-left: 50px; font-size: 1.05rem; font-weight: bold; color: var(--primary);">
                </div>
                <div class="of-hint" style="text-align: right; margin-top: 5px;">Minimum: 500 FCFA</div>
            </div>

            <div style="margin-top: 40px;">
                <button type="submit" class="btn btn-primary btn-block" style="padding: 18px; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(106,13,173,0.3);">Confirmer le rechargement</button>
            </div>
        </form>
    </div>
</div>
