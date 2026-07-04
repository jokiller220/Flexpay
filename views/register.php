<section id="view-register" class="view no-nav">
            <div class="header-simple">
                <button class="back-btn" onclick="window.history.back()"><i class="fa-solid fa-chevron-left"></i></button>
                <h2>Créer un compte</h2>
            </div>
            <div class="form-container">
                <div class="avatar-upload">
                    <div class="avatar-placeholder"><i class="fa-solid fa-user"></i></div>
                </div>
                <form id="register-form" onsubmit="app.handleRegister(event)">
                    <div class="input-group">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="register-name" placeholder="Nom complet" required>
                    </div>
                    <div class="input-group">
                        <i class="fa-solid fa-mobile-screen"></i>
                        <input type="tel" id="register-phone" placeholder="Téléphone (Ex: 07 12 34 56 78)" required>
                    </div>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="register-password" placeholder="Mot de passe" required>
                        <i class="fa-regular fa-eye-slash toggle-password" onclick="app.togglePasswordVisibility('register-password', this)"></i>
                    </div>
                    <div class="input-group">
                        <i class="fa-solid fa-gift"></i>
                        <input type="text" id="register-referral" placeholder="Code de parrainage (Optionnel)">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-4">S'inscrire</button>
                </form>
                <p class="auth-link">Vous avez déjà un compte ? <a href="#" onclick="app.navigate('view-login')">Se connecter</a></p>
            </div>
        </section>