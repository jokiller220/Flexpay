<section id="view-services" class="view with-bottom-nav">
    <div class="container">
        <div class="header-simple" style="display: flex; align-items: center; gap: 15px; border-bottom:none; margin-bottom: 20px;">
            <i class="fa-solid fa-arrow-left" style="font-size: 20px; cursor: pointer; color: var(--text-color);" onclick="app.navigate('view-home')"></i>
            <div>
                <h2 style="margin: 0; font-size: 20px; font-weight: 700;">Tous les services</h2>
                <span style="font-size: 13px; color: var(--text-muted);">Choisissez un service à commander</span>
            </div>
        </div>

        <div class="desktop-split">
            <div class="desktop-col-full" style="width: 100%;">
                
                <!-- Streaming / SaaS -->
                <div class="section-title mt-0" style="margin-bottom: 12px;">
                    <h3 style="font-size: 16px; font-weight: 700;">Streaming & Logiciels</h3>
                </div>
                <div class="services-grid" id="all-services-streaming" style="margin-bottom: 24px;">
                    <!-- Populated by JS -->
                </div>

                <!-- Gaming -->
                <div class="section-title mt-4" style="margin-bottom: 12px;">
                    <h3 style="font-size: 16px; font-weight: 700;">Gaming & Cartes Cadeaux</h3>
                </div>
                <div class="services-grid" id="all-services-gaming" style="margin-bottom: 24px;">
                    <!-- Populated by JS -->
                </div>

                <!-- E-commerce -->
                <div class="section-title mt-4" style="margin-bottom: 12px;">
                    <h3 style="font-size: 16px; font-weight: 700;">E-commerce</h3>
                </div>
                <div class="services-grid" id="all-services-ecommerce" style="margin-bottom: 24px;">
                    <!-- Populated by JS -->
                </div>
                
                <!-- Autres -->
                <div class="section-title mt-4" style="margin-bottom: 12px;">
                    <h3 style="font-size: 16px; font-weight: 700;">Utilitaires & Autres</h3>
                </div>
                <div class="services-grid" id="all-services-other" style="margin-bottom: 24px;">
                    <!-- Populated by JS -->
                </div>

            </div>
        </div>
    </div>
</section>
