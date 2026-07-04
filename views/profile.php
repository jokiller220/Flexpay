<section id="view-profile" class="view with-bottom-nav">
            <div class="container" style="max-width:800px; margin:0 auto; padding:0;">
                <div class="profile-header">
                    <h2>Profil</h2>
                    <input type="file" id="avatar-upload" style="display:none;" accept="image/*" onchange="app.uploadAvatar(event)">
                    <button class="edit-btn" onclick="document.getElementById('avatar-upload').click()"><i class="fa-solid fa-pen"></i></button>
                    <div class="profile-user-info">
                        <img id="profile-avatar-display" src="<?php echo $basePath; ?>assets/images/avatar.png" alt="Avatar" style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid white; object-fit: cover;">
                        <div class="profile-text">
                            <h3 id="profile-name-display">Jean David</h3>
                            <span id="profile-phone-display">+228 97 12 34 56</span>
                        </div>
                    </div>
                </div>
                <div class="content-padded profile-menu" style="background:#fff; border-radius:12px; margin-top:20px; border: 1px solid var(--border-color); padding: 20px;">
                    <div class="menu-item" onclick="app.openPersonalInfo()">
                        <i class="fa-regular fa-user"></i>
                        <div class="menu-text">
                            <h4>Informations personnelles</h4>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="menu-item" onclick="app.openSecurity()">
                        <i class="fa-solid fa-lock"></i>
                        <div class="menu-text">
                            <h4>Sécurité</h4>
                            <span>Changer le mot de passe</span>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="menu-item" onclick="app.openSupport()">
                        <i class="fa-regular fa-comments"></i>
                        <div class="menu-text">
                            <h4>Support / Chat</h4>
                            <span>Besoin d'aide ?</span>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="menu-item" onclick="app.openNotifications()">
                        <i class="fa-regular fa-bell"></i>
                        <div class="menu-text">
                            <h4>Notifications</h4>
                            <span>Gérer vos alertes</span>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="menu-item" onclick="app.openAbout()">
                        <i class="fa-solid fa-circle-info"></i>
                        <div class="menu-text">
                            <h4>À propos de FlexPay</h4>
                            <span>Version 1.0.0</span>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div style="text-align: center; margin-top: 35px;">
                        <span style="color: #EF4444; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 1.05rem;" onclick="app.handleLogout()">
                            <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                        </span>
                    </div>
                </div>
            </div>
        </section>