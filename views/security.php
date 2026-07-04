<section id="view-security" class="view">
    <!-- Header -->
    <div class="header-simple" style="padding-top: calc(30px + var(--sat)); padding-bottom: 15px;">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <h2 style="text-align: center; margin-right: 40px; font-weight: 700;">Sécurité</h2>
    </div>

    <div class="content-padded" style="margin-top: 10px;">
        <!-- Changement de mot de passe -->
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; color: var(--text-light);">Changer le mot de passe</h3>
        <form id="form-security-password" onsubmit="app.submitPasswordChange(event)" style="background: rgba(255, 255, 255, 0.03); padding: 20px; border-radius: 16px; border: 1px solid var(--border-color); margin-bottom: 30px;">
            <div class="input-group" style="margin-bottom: 15px;">
                <div style="position: relative;">
                    <i class="fa-solid fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                    <input type="password" id="sec-current-password" placeholder="Mot de passe actuel" required style="width: 100%; padding: 14px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-light); font-size: 1rem; outline: none; transition: border-color 0.3s;">
                    <i class="fa-solid fa-eye-slash" onclick="app.togglePasswordVisibility('sec-current-password', this)" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); cursor: pointer;"></i>
                </div>
            </div>
            <div class="input-group" style="margin-bottom: 15px;">
                <div style="position: relative;">
                    <i class="fa-solid fa-key" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                    <input type="password" id="sec-new-password" placeholder="Nouveau mot de passe" required style="width: 100%; padding: 14px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-light); font-size: 1rem; outline: none; transition: border-color 0.3s;">
                    <i class="fa-solid fa-eye-slash" onclick="app.togglePasswordVisibility('sec-new-password', this)" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); cursor: pointer;"></i>
                </div>
            </div>
            <div class="input-group" style="margin-bottom: 20px;">
                <div style="position: relative;">
                    <i class="fa-solid fa-check-double" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                    <input type="password" id="sec-confirm-password" placeholder="Confirmer le mot de passe" required style="width: 100%; padding: 14px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-light); font-size: 1rem; outline: none; transition: border-color 0.3s;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 12px; padding: 14px; font-weight: 600;">Mettre à jour</button>
        </form>

        <!-- Options Avancées -->
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; color: var(--text-light);">Options avancées</h3>
        <div style="background: rgba(255, 255, 255, 0.03); padding: 0 20px; border-radius: 16px; border: 1px solid var(--border-color); margin-bottom: 30px;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-bottom: 1px solid var(--border-color);">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-shield-halved" style="color: var(--success); font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 600; margin: 0; color: var(--text-light);">Authentification 2FA</h4>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">Non activée</span>
                    </div>
                </div>
                <!-- Toggle Switch -->
                <label style="position: relative; display: inline-block; width: 44px; height: 24px;">
                    <input type="checkbox" style="opacity: 0; width: 0; height: 0;" onchange="alert('Fonctionnalité 2FA en cours de développement')">
                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: var(--border-color); border-radius: 24px; transition: .4s;">
                        <span style="position: absolute; content: ''; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; border-radius: 50%; transition: .4s;"></span>
                    </span>
                </label>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 0; cursor: pointer;" onclick="alert('Vos appareils:\n- iPhone 13 (Actif)\n- Windows PC (Il y a 2 jours)')">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 40px; height: 40px; background: rgba(59, 130, 246, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-mobile-screen" style="color: var(--info); font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 600; margin: 0; color: var(--text-light);">Appareils connectés</h4>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">Gérer les sessions</span>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-right" style="color: var(--text-muted);"></i>
            </div>
            
        </div>
    </div>
</section>
