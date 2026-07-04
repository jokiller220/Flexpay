<section id="view-personal-info" class="view">
    <!-- Header -->
    <div class="header-simple" style="padding-top: calc(30px + var(--sat)); padding-bottom: 15px;">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <h2 style="text-align: center; margin-right: 40px; font-weight: 700;">Infos Personnelles</h2>
    </div>

    <div class="content-padded" style="margin-top: 20px;">
        <form id="form-personal-info" onsubmit="event.preventDefault(); alert('Informations mises à jour avec succès'); window.history.back();">
            
            <div style="text-align: center; margin-bottom: 30px; position: relative;">
                <div style="display: inline-block; position: relative;">
                    <img id="pi-avatar-display" src="<?php echo $basePath; ?>assets/images/avatar.png" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; border: 3px solid var(--primary); object-fit: cover; box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);">
                    <button type="button" class="btn" style="position: absolute; bottom: 0; right: 0; background: var(--primary); color: white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border: 3px solid var(--background); box-shadow: 0 4px 10px rgba(0,0,0,0.2);" onclick="document.getElementById('avatar-upload').click()">
                        <i class="fa-solid fa-camera" style="font-size: 0.9rem;"></i>
                    </button>
                </div>
            </div>

            <div class="input-group" style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 8px; margin-left: 5px;">Nom complet</label>
                <div style="position: relative;">
                    <i class="fa-regular fa-user" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                    <input type="text" id="pi-name" value="Jean David" placeholder="Votre nom" required style="width: 100%; padding: 14px 14px 14px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-light); font-size: 1rem; outline: none; transition: border-color 0.3s;">
                </div>
            </div>

            <div class="input-group" style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 8px; margin-left: 5px;">Adresse Email</label>
                <div style="position: relative;">
                    <i class="fa-regular fa-envelope" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                    <input type="email" id="pi-email" value="jean.david@email.com" placeholder="Votre email" required style="width: 100%; padding: 14px 14px 14px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-light); font-size: 1rem; outline: none; transition: border-color 0.3s;">
                </div>
            </div>

            <div class="input-group" style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 8px; margin-left: 5px;">Numéro de téléphone</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-phone" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                    <input type="tel" id="pi-phone" value="+228 97 12 34 56" placeholder="Votre numéro" required style="width: 100%; padding: 14px 14px 14px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); border-radius: 12px; color: var(--text-light); font-size: 1rem; outline: none; transition: border-color 0.3s;" readonly>
                </div>
                <small style="color: var(--text-muted); margin-left: 5px; font-size: 0.75rem; margin-top: 5px; display: block;">Le numéro de téléphone ne peut pas être modifié.</small>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 12px; padding: 15px; font-size: 1.05rem; font-weight: 600; margin-top: 20px; box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);">Enregistrer les modifications</button>
        </form>
    </div>
</section>
