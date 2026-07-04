<section id="view-orders" class="view with-bottom-nav">
            <div class="container">
                <div class="header-simple" style="border-bottom:none; display:flex; justify-content:center; align-items:center;">
                    <h2 style="margin: 0; font-size:1.6rem;">Suivi de commandes</h2>
                </div>
                <div class="tabs" style="justify-content: center; margin-bottom: 20px;">
                    <button class="tab active" onclick="app.filterOrders('toutes', this)">Toutes</button>
                    <button class="tab" onclick="app.filterOrders('en cours', this)">En cours</button>
                    <button class="tab" onclick="app.filterOrders('terminées', this)">Terminées</button>
                </div>
                <div class="orders-list" id="orders-tracking-list" style="max-width:800px; margin:0 auto;">
                    <!-- Loaded dynamically -->
                </div>
            </div>
        </section>