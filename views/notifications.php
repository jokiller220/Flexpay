<section id="view-notifications" class="view">
    <!-- Header -->
    <div class="header-simple" style="padding-top: calc(30px + var(--sat)); padding-bottom: 15px;">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <h2 style="text-align: center; margin-right: 40px; font-weight: 700;">Notifications</h2>
    </div>

    <div class="content-padded" style="margin-top: 10px;">
        <div id="notifications-list" style="display: flex; flex-direction: column; gap: 15px;">
            <!-- Rendered by JS -->
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 50vh;">
                <div style="width: 80px; height: 80px; background: rgba(139, 92, 246, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fa-regular fa-bell" style="font-size: 2.5rem; color: var(--primary);"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 8px;">Aucune notification</h3>
                <p style="color: var(--text-muted); text-align: center; font-size: 0.95rem; line-height: 1.5; max-width: 250px;">
                    Vous n'avez pas de nouvelles notifications pour le moment.
                </p>
            </div>
        </div>
    </div>
</section>
