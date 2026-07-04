<div id="view-p2p" class="view">
    <!-- Header -->
    <div class="header-simple" style="padding-top: calc(30px + var(--sat)); padding-bottom: 15px;">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <h2 id="p2p-page-title" style="text-align: center; margin-right: 40px; font-weight: 700;">Envoyer (P2P)</h2>
    </div>

    <div class="content-padded" style="margin-top: 10px;">
        <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px; text-align: center;">Envoyez instantanément et gratuitement à un autre compte Flexpay.</p>
        
        <form id="p2p-form" onsubmit="app.submitP2P(event)">
            <div class="input-group" style="margin-bottom: 15px;">
                <i class="fa-solid fa-mobile-screen"></i>
                <input type="tel" id="p2p-phone" placeholder="Numéro du bénéficiaire" required>
            </div>
            
            <div class="input-group" style="margin-bottom: 25px;">
                <i class="fa-solid fa-coins"></i>
                <input type="number" id="p2p-amount" placeholder="Montant (FCFA)" min="100" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 12px; padding: 14px; font-size: 1.05rem; font-weight: 600;">Confirmer l'envoi</button>
        </form>
    </div>
</div>
