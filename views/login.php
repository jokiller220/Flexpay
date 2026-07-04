<section id="view-login" class="view no-nav">
            <div class="header-simple">
                <h2>Se connecter</h2>
            </div>
            <div class="form-container">
                <div class="avatar-upload" style="margin: 20px 0 20px 0;">
                    <div class="avatar-placeholder"><i class="fa-solid fa-lock"></i></div>
                </div>
                <form id="login-form" onsubmit="app.handleLogin(event)">
                    <div class="input-group">
                        <i class="fa-solid fa-mobile-screen"></i>
                        <input type="tel" id="login-phone" placeholder="Téléphone (Ex: 07 12 34 56 78)" required>
                    </div>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="login-password" placeholder="Mot de passe" required>
                        <i class="fa-regular fa-eye-slash toggle-password" onclick="app.togglePasswordVisibility('login-password', this)"></i>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-4">Se connecter</button>
                </form>
                <p class="auth-link">Vous n'avez pas de compte ? <a href="#" onclick="app.navigate('view-register')">S'inscrire</a></p>
            </div>
        </section>