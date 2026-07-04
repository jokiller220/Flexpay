<section id="view-wallet" class="view with-bottom-nav">
            <div class="container">
                <div class="header-simple" style="display: flex; justify-content: space-between; align-items: center; border-bottom:none;">
                    <h2 style="margin: 0; text-align: left;">Portefeuille & transactions</h2>
                    <button class="settings-btn" onclick="alert('Paramètres du portefeuille')"><i class="fa-solid fa-gear"></i></button>
                </div>
                
                <div class="desktop-split">
                    <!-- Left: balance & deposit methods -->
                    <div class="desktop-col-left">
                        <div class="wallet-balance-card">
                            <span>Solde disponible</span>
                            <h2 id="wallet-balance-display">0 <span>FCFA</span></h2>
                            <p id="wallet-referral-display" style="font-size: 0.85rem; margin-top: 5px; opacity: 0.8;">Code de parrainage: <strong>—</strong></p>
                        </div>
                        
                        <div class="action-buttons-grid mt-4" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <button class="btn btn-primary" onclick="app.openP2PView()" style="border-radius: 12px; padding: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                <i class="fa-solid fa-paper-plane" style="font-size: 1.2rem;"></i>
                                <span style="font-size: 0.9rem; font-weight: 500;">Envoyer</span>
                            </button>
                            <button class="btn btn-primary" onclick="app.openRechargeView()" style="border-radius: 12px; padding: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                <i class="fa-solid fa-plus" style="font-size: 1.2rem;"></i>
                                <span style="font-size: 0.9rem; font-weight: 500;">Recharger</span>
                            </button>
                        </div>
                    </div>

                    <!-- Right: transactions list -->
                    <div class="desktop-col-right">
                        <div class="section-title" style="margin-top:0px;">
                            <h3>Historique des transactions</h3>
                            <div class="dropdown">
                                <span>Tous <i class="fa-solid fa-chevron-down"></i></span>
                            </div>
                        </div>
                        <div class="transactions-list" id="wallet-tx-list">
                            <!-- Loaded dynamically -->
                        </div>
                    </div>
                </div>
            </div>
        </section>