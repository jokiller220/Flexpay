<section id="view-about" class="view">
    <!-- Header -->
    <div class="header-simple" style="padding-top: calc(30px + var(--sat)); padding-bottom: 15px;">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <h2 style="text-align: center; margin-right: 40px; font-weight: 700;">À propos</h2>
    </div>

    <div class="content-padded" style="margin-top: 10px; display: flex; flex-direction: column; align-items: center;">
        
        <!-- App Logo & Version -->
        <div style="margin: 40px 0; display: flex; flex-direction: column; align-items: center;">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, var(--primary), #D946EF); border-radius: 25px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 15px 30px rgba(139, 92, 246, 0.4);">
                <i class="fa-solid fa-wallet" style="color: white; font-size: 3rem;"></i>
            </div>
            <h1 style="font-size: 1.8rem; font-weight: 800; margin: 0; background: linear-gradient(to right, #fff, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">FlexPay</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 5px;">Version 1.0.0 (Build 42)</p>
        </div>

        <!-- Links List -->
        <div style="width: 100%; background: rgba(255, 255, 255, 0.03); border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; border-bottom: 1px solid var(--border-color); cursor: pointer;" onclick="alert('Conditions générales d\'utilisation')">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <i class="fa-solid fa-file-contract" style="color: var(--text-muted); width: 20px; text-align: center;"></i>
                    <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-light);">Conditions d'utilisation</span>
                </div>
                <i class="fa-solid fa-chevron-right" style="color: var(--text-muted); font-size: 0.8rem;"></i>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; border-bottom: 1px solid var(--border-color); cursor: pointer;" onclick="alert('Politique de confidentialité')">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <i class="fa-solid fa-shield-check" style="color: var(--text-muted); width: 20px; text-align: center;"></i>
                    <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-light);">Politique de confidentialité</span>
                </div>
                <i class="fa-solid fa-chevron-right" style="color: var(--text-muted); font-size: 0.8rem;"></i>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; border-bottom: 1px solid var(--border-color); cursor: pointer;" onclick="alert('Licenses open-source')">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <i class="fa-solid fa-code-branch" style="color: var(--text-muted); width: 20px; text-align: center;"></i>
                    <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-light);">Licences open-source</span>
                </div>
                <i class="fa-solid fa-chevron-right" style="color: var(--text-muted); font-size: 0.8rem;"></i>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; cursor: pointer;" onclick="alert('Ouverture du site officiel')">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <i class="fa-solid fa-globe" style="color: var(--text-muted); width: 20px; text-align: center;"></i>
                    <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-light);">Site officiel</span>
                </div>
                <i class="fa-solid fa-arrow-up-right-from-square" style="color: var(--text-muted); font-size: 0.8rem;"></i>
            </div>
            
        </div>

        <!-- Social Media Links -->
        <div style="display: flex; gap: 20px; margin-top: 40px; margin-bottom: 20px;">
            <a href="#" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--text-light); transition: all 0.3s; border: 1px solid var(--border-color);">
                <i class="fa-brands fa-twitter" style="font-size: 1.2rem;"></i>
            </a>
            <a href="#" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--text-light); transition: all 0.3s; border: 1px solid var(--border-color);">
                <i class="fa-brands fa-facebook-f" style="font-size: 1.2rem;"></i>
            </a>
            <a href="#" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--text-light); transition: all 0.3s; border: 1px solid var(--border-color);">
                <i class="fa-brands fa-instagram" style="font-size: 1.2rem;"></i>
            </a>
        </div>

        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 10px;">&copy; 2026 FlexPay. Tous droits réservés.</p>
    </div>
</section>
