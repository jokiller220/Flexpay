
        // -----------------------------------------------------------------------
        // SERVICE CATALOG — Marges par catégorie
        //   Streaming / SaaS : +1 500 FCFA flat
        //   Gaming           : +2 000 FCFA flat
        //   Shein / AliExpress: +10 % du prix produit
        //   Amazon           : +12 % du prix produit
        // Plans: prix COÛT (sans marge). Prix affiché client = coût + marge.
        // -----------------------------------------------------------------------
        const SERVICE_CATALOG = {
            'Netflix':         { category:'streaming', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_netflix.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'flat', margin:1500, plans:[
                {name:'Basic',price:2500,features:['1 écran (téléphone, tablette, PC)','Qualité Standard (480p)','Téléchargement sur 1 appareil']},
                {name:'Standard',price:4500,features:['2 écrans simultanés','Qualité Full HD (1080p)','Téléchargement sur 2 appareils']},
                {name:'Premium',price:6500,features:['4 écrans simultanés','Qualité Ultra HD (4K) + HDR','Audio Spatial Netflix','Téléchargement sur 6 appareils']}
            ] },
            'Spotify':         { category:'streaming', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_spotify.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'flat', margin:1500, plans:[
                {name:'Personnel',price:1500,features:['1 compte individuel','Écoute sans publicité','Téléchargement pour écoute hors ligne','Qualité audio supérieure']},
                {name:'Duo',price:2200,features:['2 comptes indépendants (couple)','Écoute sans publicité','Téléchargement pour écoute hors ligne']},
                {name:'Famille',price:3000,features:['Jusqu\'à 6 comptes indépendants','Contrôle du contenu explicite','Écoute sans publicité']}
            ] },
            'Disney+':         { category:'streaming', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_disney.png" style="width:100%;height:100%;object-fit:contain;padding:4px;">', bg:'#fff', marginType:'flat', margin:1500, plans:[
                {name:'Standard',price:3000,features:['2 écrans simultanés','Qualité Full HD (1080p)','Son 5.1']},
                {name:'Premium',price:6000,features:['4 écrans simultanés','Qualité Ultra HD (4K) + HDR','Son Dolby Atmos']}
            ] },
            'Apple TV':        { category:'streaming', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_appletv.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'flat', margin:1500, plans:[
                {name:'Mensuel',price:3500,features:['Tout le catalogue Apple Originals','Partage familial jusqu\'à 5 personnes','Qualité 4K HDR']}
            ] },
            'Apple Music':     { category:'streaming', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_applemusic.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'flat', margin:1500, plans:[
                {name:'Individuel',price:2000,features:['Plus de 100 millions de titres sans pub','Audio Spatial avec Dolby Atmos','Écoute hors ligne']},
                {name:'Famille',price:4000,features:['Jusqu\'à 6 personnes avec comptes séparés','Plus de 100 millions de titres']}
            ] },
            'Deezer':          { category:'streaming', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_deezer.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'flat', margin:1500, plans:[
                {name:'Premium',price:2000,features:['Plus de 120 millions de titres sans pub','Écoute hors ligne','Qualité FLAC Haute Fidélité']},
                {name:'Famille',price:3500,features:['Jusqu\'à 6 comptes séparés','Audio Haute Fidélité','Écoute sans publicité']}
            ] },

            'Shein':       { category:'ecommerce', delay:'15-30 jours', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_shein.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'pct', marginPct:0.10 },
            'AliExpress':  { category:'ecommerce', delay:'15-45 jours', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_aliexpress.webp" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'pct', marginPct:0.10 },
            'Amazon':      { category:'ecommerce', delay:'72h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_amazone.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'pct', marginPct:0.12 },
            'Amazon Prime':{ category:'streaming', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_amazone.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'flat', margin:1500, plans:[
                {name:'Mensuel',price:3500,features:['Accès illimité à des milliers de films et séries','Livraison gratuite Amazon','Prime Video, Music et Reading inclus']},
                {name:'Annuel',price:30000,features:['Accès illimité à des milliers de films et séries','Livraison gratuite Amazon','Prime Video, Music et Reading inclus','Économisez sur l\'abonnement annuel']}
            ] },
            'PlayStation': { category:'gaming', delay:'3h max', icon:'<i class="fa-brands fa-playstation" style="color:#fff"></i>', bg:'#003087', marginType:'flat', margin:2000, plans:[
                {name:'PS Plus Essential (1 mois)',price:5000,features:['Accès au multijoueur en ligne','Jeux mensuels gratuits','Réductions exclusives']},
                {name:'PS Plus Extra (1 mois)',price:8000,features:['Catalogue de centaines de jeux PS4/PS5','Multijoueur en ligne','Jeux mensuels gratuits']},
                {name:'PS Plus Premium (1 mois)',price:10000,features:['Catalogue de jeux classiques rétro','Essais de jeux récents','Streaming dans le cloud','Catalogue Extra + Essential']},
                {name:'Carte cadeau 10€',price:7500,features:['Code prépayé de 10€','Créditer votre compte PlayStation Store immédiatement']},
                {name:'Carte cadeau 20€',price:14500,features:['Code prépayé de 20€','Créditer votre compte PlayStation Store immédiatement']},
                {name:'Carte cadeau 50€',price:36000,features:['Code prépayé de 50€','Créditer votre compte PlayStation Store immédiatement']}
            ] },
            'Xbox':        { category:'gaming', delay:'3h max', icon:'<i class="fa-brands fa-xbox" style="color:#fff"></i>', bg:'#107C10', marginType:'flat', margin:2000, plans:[
                {name:'Game Pass Core (1 mois)',price:5000,features:['Multijoueur en ligne console','Catalogue de plus de 25 jeux de qualité','Offres membres']},
                {name:'Game Pass Ultimate (1 mois)',price:8500,features:['Des centaines de jeux PC/Console/Cloud','Nouveaux jeux dès le premier jour','Abonnement EA Play inclus','Multijoueur en ligne']},
                {name:'Carte cadeau 15€',price:11000,features:['Code prépayé de 15€ Xbox Store','Achetez des jeux, extensions ou abonnements']},
                {name:'Carte cadeau 25€',price:18000,features:['Code prépayé de 25€ Xbox Store','Achetez des jeux, extensions ou abonnements']}
            ] },
            'Steam':       { category:'gaming', delay:'3h max', icon:'<i class="fa-brands fa-steam" style="color:#c6d4df"></i>', bg:'#1b2838', marginType:'flat', margin:2000, plans:[
                {name:'Carte cadeau 10€',price:7500,features:['Code Steam prépayé de 10€','Créditer instantanément votre porte-monnaie Steam']},
                {name:'Carte cadeau 20€',price:14500,features:['Code Steam prépayé de 20€','Créditer instantanément votre porte-monnaie Steam']},
                {name:'Carte cadeau 50€',price:36000,features:['Code Steam prépayé de 50€','Créditer instantanément votre porte-monnaie Steam']},
                {name:'Carte cadeau 100€',price:72000,features:['Code Steam prépayé de 100€','Créditer instantanément votre porte-monnaie Steam']}
            ] },
            'NordVPN':     { category:'other', delay:'3h max', icon:'<span style="font-weight:800;font-size:11px;color:#fff">VPN</span>', bg:'#4687FF', marginType:'flat', margin:1500, plans:[
                {name:'1 mois',price:5000,features:['Chiffrement AES 256 bits','Plus de 5000 serveurs','Jusqu\'à 6 appareils simultanés']},
                {name:'6 mois',price:25000,features:['Chiffrement AES 256 bits','Plus de 5000 serveurs','Jusqu\'à 6 appareils simultanés']},
                {name:'1 an',price:40000,features:['Chiffrement AES 256 bits','Plus de 5000 serveurs','Jusqu\'à 6 appareils simultanés']}
            ] },
            'ExpressVPN':  { category:'other', delay:'3h max', icon:'<span style="font-weight:800;font-size:11px;color:#fff">VPN</span>', bg:'#DA3940', marginType:'flat', margin:1500, plans:[
                {name:'1 mois',price:6500,features:['VPN ultra-rapide sécurisé','Serveurs dans 94 pays','Jusqu\'à 5 appareils simultanés']},
                {name:'6 mois',price:35000,features:['VPN ultra-rapide sécurisé','Serveurs dans 94 pays','Jusqu\'à 5 appareils simultanés']},
                {name:'1 an',price:60000,features:['VPN ultra-rapide sécurisé','Serveurs dans 94 pays','Jusqu\'à 5 appareils simultanés']}
            ] },
            'Canva Pro':   { category:'other', delay:'3h max', icon:'<i class="fa-solid fa-pen-nib" style="color:#fff"></i>', bg:'#7D2AE8', marginType:'flat', margin:1500, plans:[
                {name:'1 mois',price:7000,features:['100+ millions de photos, vidéos et graphiques','Outil de suppression d\'arrière-plan','Planificateur de réseaux sociaux']},
                {name:'1 an',price:60000,features:['100+ millions de photos, vidéos et graphiques','Outil de suppression d\'arrière-plan','Planificateur de réseaux sociaux']}
            ] },
            'ChatGPT Plus':{ category:'other', delay:'3h max', icon:'<img src="'+window.BASE_PATH+'assets/images/services/logo_chatgpt.png" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">', bg:'transparent', marginType:'flat', margin:1500, plans:[
                {name:'Mensuel',price:12000,features:['Accès prioritaire à GPT-4','Temps de réponse accéléré','DALL-E 3, Browsing et analyse avancée']}
            ] },
        };

        class FlexPayApp {
            constructor() {
                this.currentUser = null;
                this.balance = 0;
                this.orders = [];
                this.transactions = [];
                this.activeFilter = 'toutes';
                this.selectedRechargeMethod = '';

                // Universal order form state
                this.orderState = {
                    serviceName: null,
                    catalog: null,
                    step: 1,
                    totalSteps: 3,
                    isNewAccount: null,
                    email: '',
                    password: '',
                    plan: null,
                    planPrice: 0,          // cost price (without margin)
                    clientTotal: 0,        // what client actually pays
                    productUrl: '',
                    productVariant: '',
                    rawProductPrice: 0,    // ecommerce: price entered by client
                    deliveryName: '',
                    deliveryStreet: '',
                    deliveryCity: '',
                    deliveryPhone: '',
                    delayAccepted: false,
                    margin: 0,             // computed margin (FCFA)
                    totalPrice: 0,         // ecommerce raw product price (alias)
                };

                this.init();
            }

            async init() {
                const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;
                
                // Render static UI components that depend on catalog
                this.renderAllServices();

                await this.reloadData();
                this.fetchUsdRate(); // preload exchange rate
                this.loadNotifications(); // load unread notifications
                
                // Show splash screen for 2.5 seconds (gives time for data to load)
                const splashDelay = 2500;
                setTimeout(() => {
                    const splashEl = document.getElementById('view-splash');
                    if (splashEl) splashEl.style.display = 'none';
                    const startupBg = document.getElementById('startup-bg');
                    if (startupBg) startupBg.remove();
                    document.body.style.backgroundColor = '';
                    
                    if (this.currentUser) {
                        this.navigate('view-home');
                    } else {
                        this.navigate('view-login');
                    }
                }, splashDelay);

                window.addEventListener('storage', (e) => {
                    if (e.key === 'flexpay_db_update') {
                        this.reloadData();
                    }
                });

                window.addEventListener('popstate', (e) => {
                    if (e.state && e.state.viewId) {
                        this.navigate(e.state.viewId, false);
                    }
                });

                // iOS Keyboard scroll bug fix
                if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
                    document.addEventListener('focusin', (e) => {
                        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                            setTimeout(() => {
                                document.body.scrollTop = 0;
                                window.scrollTo(0, 0);
                            }, 100);
                        }
                    });
                    document.addEventListener('focusout', () => {
                        document.body.scrollTop = 0;
                        window.scrollTo(0, 0);
                    });
                }
            }

            async reloadData() {
                try {
                    const res = await fetch('api.php?action=get_data');
                    const data = await res.json();
                    
                    if (data.status === 'success') {
                        this.currentUser = data.user;
                        this.balance = parseFloat(data.user.balance);
                        this.orders = data.orders;
                        this.transactions = data.transactions;
                        
                        this.updateUI();
                    } else {
                        this.currentUser = null;
                    }
                } catch (err) {
                    console.error("Erreur de récupération des données: ", err);
                }
            }

            updateUI() {
                if (!this.currentUser) return;

                // Update Balances
                const formattedBal = this.formatPrice(this.balance);
                document.getElementById('home-balance-display').innerHTML = formattedBal + ' <span>FCFA</span>';
                document.getElementById('wallet-balance-display').innerHTML = formattedBal + ' <span>FCFA</span>';
                
                if (this.currentUser.referral_code) {
                    const refEl = document.getElementById('wallet-referral-display');
                    if (refEl) refEl.innerHTML = `Code de parrainage: <strong>${this.currentUser.referral_code}</strong> <i class="fa-regular fa-copy" style="cursor:pointer;" onclick="navigator.clipboard.writeText('${this.currentUser.referral_code}');alert('Code copié !')"></i>`;
                }

                // Update Lists
                this.renderTransactions('home-tx-list', this.transactions.slice(0, 3));
                this.renderTransactions('wallet-tx-list', this.transactions);

                // Update Profile
                document.getElementById('profile-name-display').textContent = this.currentUser.name;
                document.getElementById('profile-phone-display').textContent = this.currentUser.phone;
                
                const avatarSrc = this.currentUser.avatar ? this.currentUser.avatar : ''+window.BASE_PATH+'assets/images/avatar.png';
                document.getElementById('profile-avatar-display').src = avatarSrc;
                document.getElementById('nav-avatar-display').src = avatarSrc;

                this.renderOrders();
            }

            formatPrice(price) {
                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }

            renderAllServices() {
                const containers = {
                    'streaming': document.getElementById('all-services-streaming'),
                    'gaming': document.getElementById('all-services-gaming'),
                    'ecommerce': document.getElementById('all-services-ecommerce'),
                    'other': document.getElementById('all-services-other')
                };

                // Clear containers
                for (let k in containers) {
                    if (containers[k]) containers[k].innerHTML = '';
                }

                // Render catalog items
                for (let [name, data] of Object.entries(SERVICE_CATALOG)) {
                    const cat = data.category;
                    const ctn = containers[cat];
                    if (ctn) {
                        ctn.innerHTML += `
                            <div class="service-card" onclick="app.openOrderForm('${name}')">
                                <div class="service-icon" style="background-color: ${data.bg}">
                                    ${data.icon}
                                </div>
                                <div class="service-name">${name}</div>
                            </div>
                        `;
                    }
                }
            }

            togglePasswordVisibility(inputId, icon) {
                const input = document.getElementById(inputId);
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                }
            }

            // Centralized Routing System
            navigate(viewId, pushState = true) {
                const currentActive = document.querySelector('.view.active');
                if (currentActive && currentActive.id === viewId) return;

                if (pushState) {
                    history.pushState({ viewId: viewId }, '', '#' + viewId);
                }

                document.querySelectorAll('.view').forEach(v => {
                    v.classList.remove('active');
                });
                
                const targetView = document.getElementById(viewId);
                if (targetView) {
                    targetView.classList.add('active');
                }

                // Show navigation headers and tabs only for authenticated screens
                const isTab = ['view-home', 'view-orders', 'view-wallet', 'view-profile'].includes(viewId);
                const hasNav = isTab || viewId === 'view-order-form';

                // Desktop top navigation header
                const desktopHeader = document.getElementById('desktop-header');
                desktopHeader.style.display = (hasNav && window.innerWidth >= 768) ? 'flex' : 'none';

                // Mobile bottom tab bar
                const bottomNav = document.getElementById('bottom-nav');
                bottomNav.style.display = (isTab && window.innerWidth < 768) ? 'flex' : 'none';

                // Sync navigation items active states
                if (isTab) {
                    // Mobile tabs
                    document.querySelectorAll('#bottom-nav .nav-item').forEach(item => item.classList.remove('active'));
                    const navMapMobile = {
                        'view-home': 'nav-home',
                        'view-orders': 'nav-orders',
                        'view-wallet': 'nav-wallet',
                        'view-profile': 'nav-profile'
                    };
                    const activeNavItemMobile = document.getElementById(navMapMobile[viewId]);
                    if (activeNavItemMobile) {
                        activeNavItemMobile.classList.add('active');
                        // Animate the fluid indicator
                        const indicator = document.getElementById('nav-indicator');
                        if (indicator) {
                            const items = Array.from(activeNavItemMobile.parentNode.querySelectorAll('.nav-item'));
                            const index = items.indexOf(activeNavItemMobile);
                            if (index !== -1) {
                                indicator.style.transform = `translateX(${index * 100}%)`;
                            }
                        }
                    }

                    // Desktop tabs
                    document.querySelectorAll('#desktop-header .desktop-nav-item').forEach(item => item.classList.remove('active'));
                    const navMapDesktop = {
                        'view-home': 'desk-home',
                        'view-orders': 'desk-orders',
                        'view-wallet': 'desk-wallet',
                        'view-profile': 'desk-profile'
                    };
                    const activeNavItemDesktop = document.getElementById(navMapDesktop[viewId]);
                    if (activeNavItemDesktop) activeNavItemDesktop.classList.add('active');
                }
            }

            navigateTab(viewId, navItem) {
                this.navigate(viewId);
            }

            // Auth handlers
            togglePasswordVisibility(inputId, iconEl) {
                const input = document.getElementById(inputId);
                if (!input) return;
                if (input.type === 'password') {
                    input.type = 'text';
                    iconEl.classList.remove('fa-eye-slash');
                    iconEl.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    iconEl.classList.remove('fa-eye');
                    iconEl.classList.add('fa-eye-slash');
                }
            }

            async handleLogin(e) {
                e.preventDefault();
                const phone = document.getElementById('login-phone').value;
                const password = document.getElementById('login-password').value;

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'login', phone, password })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.reloadData();
                        this.navigate('view-home');
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur de connexion.");
                }
            }

            async handleRegister(e) {
                e.preventDefault();
                const name = document.getElementById('register-name').value;
                const phone = document.getElementById('register-phone').value;
                const password = document.getElementById('register-password').value;
                const referral_code = document.getElementById('register-referral') ? document.getElementById('register-referral').value : '';

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'register', name, phone, password, referral_code })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        document.getElementById('otp-phone-display').textContent = phone;
                        this.navigate('view-otp');
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur d'inscription.");
                }
            }

            otpInput(input, idx) {
                if (input.value.length > 1) {
                    input.value = input.value.slice(-1);
                }
                if (input.value && idx < 3) {
                    const nextInput = document.querySelectorAll('.otp-inputs input')[idx + 1];
                    if (nextInput) nextInput.focus();
                }
            }

            otpKeydown(e, idx) {
                if (e.key === 'Backspace' && !e.target.value && idx > 0) {
                    const prevInput = document.querySelectorAll('.otp-inputs input')[idx - 1];
                    if (prevInput) prevInput.focus();
                }
            }

            async confirmOTP() {
                let code = '';
                document.querySelectorAll('.otp-inputs input').forEach(input => code += input.value);
                
                if (code.length < 4) {
                    alert("Entrez le code de vérification.");
                    return;
                }

                if (code !== '1234') {
                    alert("Code OTP incorrect. Veuillez saisir le code de vérification '1234' affiché.");
                    return;
                }

                localStorage.setItem('flexpay_db_update', Date.now());
                await this.reloadData();
                this.navigate('view-home');
            }

            async handleLogout() {
                if (!confirm('Voulez-vous vraiment vous déconnecter ?')) return;
                try {
                    await fetch('api.php?action=logout');
                    this.currentUser = null;
                    localStorage.setItem('flexpay_db_update', Date.now());
                    this.navigate('view-login');
                } catch (err) {
                    console.error(err);
                }
            }

            // Transactions list renderer
            renderTransactions(containerId, list) {
                const container = document.getElementById(containerId);
                if (!container) return;

                if (list.length === 0) {
                    container.innerHTML = '<p class="text-center text-muted py-3">Aucune transaction récente</p>';
                    return;
                }

                container.innerHTML = list.map(tx => {
                    const isPositive = parseFloat(tx.amount) > 0;
                    const sign = isPositive ? '+' : '';
                    const amtClass = isPositive ? 'positive' : 'negative';
                    const s = tx.service.toLowerCase();
                    
                    let iconHtml = '<div class="tx-icon bg-light text-dark"><i class="fa-solid fa-shopping-bag"></i></div>';
                    if (s.includes('netflix')) {
                        iconHtml = '<div class="tx-icon bg-dark text-white"><i class="fa-brands fa-neos"></i></div>';
                    } else if (s.includes('spotify')) {
                        iconHtml = '<div class="tx-icon bg-dark text-white"><i class="fa-brands fa-spotify" style="color:#1DB954;"></i></div>';
                    } else if (s.includes('flooz')) {
                        iconHtml = '<div class="tx-icon bg-yellow text-dark"><i class="fa-solid fa-wallet"></i></div>';
                    } else if (s.includes('tmoney')) {
                        iconHtml = '<div class="tx-icon bg-red text-white"><i class="fa-solid fa-wallet"></i></div>';
                    }

                    const statusText = tx.status || 'Confirmée';
                    const statusClass = statusText === 'En attente' ? 'status-warning-text' : 'status-success-text';

                    return `
                        <div class="tx-item">
                            ${iconHtml}
                            <div class="tx-details">
                                <h4>${tx.title}</h4>
                                <span>${tx.date}</span>
                            </div>
                            <div class="tx-amount-group" style="display:flex; flex-direction:column; align-items:flex-end; gap:4px;">
                                <div class="tx-amount ${amtClass}">${sign}${this.formatPrice(Math.abs(parseFloat(tx.amount)))} FCFA</div>
                                <div class="${statusClass}" style="font-size:0.75rem; font-weight:500;">${statusText}</div>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            // Orders list renderer
            renderOrders() {
                const container = document.getElementById('orders-tracking-list');
                if (!container) return;

                let filtered = this.orders;
                if (this.activeFilter === 'en cours') {
                    filtered = this.orders.filter(o => o.status.toLowerCase() === 'en traitement' || o.status.toLowerCase() === 'reçue');
                } else if (this.activeFilter === 'terminées') {
                    filtered = this.orders.filter(o => o.status.toLowerCase() === 'validée' || o.status.toLowerCase() === 'terminée');
                }

                if (filtered.length === 0) {
                    container.innerHTML = '<p class="text-center text-muted py-4">Aucune commande trouvée</p>';
                    return;
                }

                container.innerHTML = filtered.map(order => {
                    const s = order.service.toLowerCase();
                    const cat = (order.category || 'streaming').toLowerCase();
                    
                    // Icon from catalog if available
                    const catEntry = SERVICE_CATALOG[order.service.split(' ').slice(0,2).join(' ')] ||
                                     Object.entries(SERVICE_CATALOG).find(([k]) => s.startsWith(k.toLowerCase()))?.[1];
                    let iconBg = catEntry ? catEntry.bg : (cat==='ecommerce'?'#E62E04': cat==='gaming'?'#003087': '#6A0DAD');
                    let iconInner = catEntry ? catEntry.icon : `<i class="fa-solid fa-cube" style="color:#fff"></i>`;
                    let iconHtml = `<div class="order-icon" style="background:${iconBg};">${iconInner}</div>`;

                    let statusClass = 'status-warning';
                    if (order.status.toLowerCase() === 'validée' || order.status.toLowerCase() === 'terminée') {
                        statusClass = 'status-success';
                    } else if (order.status.toLowerCase() === 'reçue') {
                        statusClass = 'status-info';
                    }

                    // Show tracking number if available (ecommerce)
                    const trackingHtml = order.tracking_number ?
                        `<div class="order-tracking"><i class="fa-solid fa-truck"></i> Suivi: <strong>${order.tracking_number}</strong></div>` : '';

                    return `
                        <div class="order-card">
                            ${iconHtml}
                            <div class="order-info">
                                <h4>${order.service}</h4>
                                <span class="order-id">#${order.id}</span>
                                <span class="order-date">${order.date}</span>
                                ${trackingHtml}
                            </div>
                            <div class="order-status ${statusClass}">${order.status}</div>
                        </div>
                    `;
                }).join('');
            }

            filterOrders(status, btn) {
                this.activeFilter = status;
                document.querySelectorAll('.tabs .tab').forEach(tab => tab.classList.remove('active'));
                btn.classList.add('active');
                this.renderOrders();
            }

            // Wallet Recharge Full View
            openRechargeView() {
                document.getElementById('recharge-page-title').textContent = "Recharger le Wallet";
                document.getElementById('recharge-form').reset();
                this.navigate('view-recharge');
            }

            closeRechargeModal(e) {
                // Obsolete, replaced by navigate('view-wallet')
            }

            closeRechargeModalForce() {
                // Obsolete, replaced by navigate('view-wallet')
                this.navigate('view-wallet');
            }

            async submitRecharge(e) {
                e.preventDefault();
                const method = document.getElementById('recharge-method').value;
                const phone = document.getElementById('recharge-phone').value;
                const amount = parseFloat(document.getElementById('recharge-amount').value);

                if (!method) {
                    alert("Veuillez choisir un moyen de paiement.");
                    return;
                }

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            action: 'recharge',
                            method: method,
                            phone: phone,
                            amount: amount
                        })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        alert("Votre rechargement a été effectué avec succès !");
                        this.navigate('view-wallet');
                        
                        document.getElementById('recharge-form').reset();
                        
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.reloadData();
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur de recharge.");
                }
            }

            // P2P Transfer
            openP2PView() {
                this.navigate('view-p2p');
            }

            async submitP2P(e) {
                e.preventDefault();
                const receiver_phone = document.getElementById('p2p-phone').value;
                const amount = parseFloat(document.getElementById('p2p-amount').value);

                if (!confirm(`Confirmer l'envoi de ${amount} FCFA au ${receiver_phone} ?`)) return;

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'p2p_transfer', receiver_phone, amount })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        alert("Transfert effectué avec succès !");
                        this.navigate('view-wallet');
                        document.getElementById('p2p-form').reset();
                        
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.reloadData();
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur de transfert P2P.");
                }
            }

            // -----------------------------------------------------------------------
            // UNIVERSAL ORDER FORM
            // -----------------------------------------------------------------------
            // Helper: compute margin from catalog
            computeMargin(catalog, rawPrice) {
                if (catalog.marginType === 'pct') {
                    return Math.round(rawPrice * catalog.marginPct);
                }
                return catalog.margin || 1500;
            }

            openOrderForm(serviceName) {
                const catalog = SERVICE_CATALOG[serviceName];
                if (!catalog) { alert('Service non disponible.'); return; }

                const isEcommerce = catalog.category === 'ecommerce';
                const firstPlan   = catalog.plans ? catalog.plans[0] : null;
                const flatMargin  = catalog.marginType === 'flat' ? (catalog.margin || 1500) : 0;

                this.orderState = {
                    serviceName,
                    catalog,
                    step: 1,
                    totalSteps: isEcommerce ? 4 : 3,
                    isNewAccount: null,
                    email: '',
                    password: '',
                    plan: firstPlan,
                    planPrice:   firstPlan ? firstPlan.price : 0,
                    clientTotal: firstPlan ? firstPlan.price + flatMargin : 0,
                    productUrl: '',
                    productVariant: '',
                    rawProductPrice: 0,
                    deliveryName:  this.currentUser ? this.currentUser.name  : '',
                    deliveryStreet: '',
                    deliveryCity:  '',
                    deliveryPhone: this.currentUser ? this.currentUser.phone : '',
                    delayAccepted: false,
                    margin: flatMargin,
                    totalPrice: 0,
                };

                document.getElementById('order-form-title').textContent = serviceName;
                document.getElementById('order-form-service-icon-small').innerHTML =
                    `<div style="width:36px;height:36px;border-radius:8px;background:${catalog.bg};display:flex;align-items:center;justify-content:center;flex-shrink:0;">${catalog.icon}</div>`;

                this.renderOrderStep();
                this.navigate('view-order-form');
            }

            renderOrderStep() {
                const state = this.orderState;
                const cat = state.catalog.category;
                const body = document.getElementById('order-form-body');
                const stepper = document.getElementById('order-form-stepper');
                const nextBtn = document.getElementById('order-form-next-btn');

                // Render step dots
                stepper.innerHTML = Array.from({length: state.totalSteps}, (_, i) =>
                    `<div class="step-dot ${i+1 === state.step ? 'active' : i+1 < state.step ? 'done' : ''}"></div>`
                ).join('');

                // Back btn — first step → go home, else go back
                document.getElementById('order-form-back-btn').onclick =
                    state.step === 1 ? () => this.navigate('view-home') : () => this.orderFormBack();

                nextBtn.textContent = 'Continuer';
                nextBtn.style.opacity = '1';
                nextBtn.disabled = false;

                // ---------------------------------------------------------------
                // STREAMING / GAMING / OTHER — 3 steps
                // Step 1: Account type (new/existing)
                // Step 2: Email + password + plan
                // Step 3: Recap + pay
                // ---------------------------------------------------------------
                if (cat !== 'ecommerce') {
                    if (state.step === 1) {
                        body.innerHTML = `
                            <div class="of-section">
                                <h3 class="of-q">Avez-vous déjà un compte ${state.serviceName} ?</h3>
                                ${state.catalog.delay ? `<div class="delay-banner"><i class="fa-solid fa-clock"></i> Délai de livraison : <strong>${state.catalog.delay}</strong></div>` : ''}
                                <div class="account-choice-grid">
                                    <div class="account-choice-card ${state.isNewAccount===false?'selected':''}" onclick="app.setAccountType(false)">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <strong>Oui, j'ai un compte</strong>
                                        <span>Je veux activer / upgrader mon abonnement</span>
                                    </div>
                                    <div class="account-choice-card ${state.isNewAccount===true?'selected':''}" onclick="app.setAccountType(true)">
                                        <i class="fa-solid fa-user-plus"></i>
                                        <strong>Non, créer un compte</strong>
                                        <span>Je veux un nouveau compte + abonnement</span>
                                    </div>
                                </div>
                            </div>`;
                        nextBtn.textContent = 'Continuer';
                        nextBtn.style.opacity = state.isNewAccount === null ? '0.5' : '1';
                        nextBtn.disabled = state.isNewAccount === null;

                    } else if (state.step === 2) {
                        const isNew = state.isNewAccount;
                        const plansHtml = (state.catalog.plans || []).map((p, i) => {
                            const isActive = state.plan && state.plan.name === p.name;
                            const features = p.features || [];
                            return `
                            <div class="plan-card ${isActive ? 'active' : ''}" data-index="${i}" onclick="app.selectOrderPlan(${i})" style="flex-direction: column; align-items: flex-start; gap: 0;">
                                <div style="display: flex; width: 100%; justify-content: space-between; align-items: center;">
                                    <div class="plan-info">
                                        <h4>${p.name}</h4>
                                        <span>${this.formatPrice(p.price + state.margin)} FCFA<small>/mois</small></span>
                                    </div>
                                    <div class="plan-check">
                                        <i class="fa-${isActive ? 'solid fa-circle-check' : 'regular fa-circle'}"></i>
                                    </div>
                                </div>
                                <div class="plan-features-wrapper" style="overflow: hidden; max-height: ${isActive ? '200px' : '0'}; opacity: ${isActive ? '1' : '0'}; transition: all 0.3s ease-in-out; width: 100%; margin-top: ${isActive ? '12px' : '0'}; padding-top: ${isActive ? '12px' : '0'}; border-top: 1px dashed rgba(255,255,255,${isActive ? '0.15' : '0'});">
                                    <ul style="margin: 0; padding: 0 0 0 16px; font-size: 0.8rem; color: var(--text-muted); text-align: left; display: flex; flex-direction: column; gap: 6px; list-style-type: disc;">
                                        ${features.map(f => `<li>${f}</li>`).join('')}
                                    </ul>
                                </div>
                            </div>`;
                        }).join('');

                        body.innerHTML = `
                            <div class="of-section">
                                <h3 class="of-q">${isNew ? 'Informations du nouveau compte' : 'Email de votre compte existant'}</h3>
                                <div class="input-group">
                                    <i class="fa-regular fa-envelope"></i>
                                    <input type="email" id="of-email" placeholder="Adresse e-mail" value="${state.email}" oninput="app.orderState.email=this.value">
                                </div>
                                ${isNew ? `
                                <div class="input-group">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="text" id="of-password" placeholder="Mot de passe souhaité" value="${state.password}" oninput="app.orderState.password=this.value">
                                </div>` : ''}
                            </div>
                            ${state.catalog.plans ? `
                            <div class="of-section">
                                <h3 class="of-q">Choisissez votre forfait</h3>
                                <div class="plans-list">${plansHtml}</div>
                            </div>` : ''}`;

                    } else if (state.step === 3) {
                        const plan = state.plan;
                        const total = plan ? plan.price + state.margin : state.totalPrice;
                        const balanceOk = this.balance >= total;
                        body.innerHTML = `
                            <div class="of-section">
                                <h3 class="of-q">Récapitulatif de commande</h3>
                                <div class="recap-card">
                                    <div class="recap-row"><span>Service</span><strong>${state.serviceName} ${plan ? plan.name : ''}</strong></div>
                                    <div class="recap-row"><span>Type de compte</span><strong>${state.isNewAccount ? 'Nouveau compte' : 'Compte existant'}</strong></div>
                                    <div class="recap-row"><span>Email</span><strong>${state.email || '—'}</strong></div>
                                    ${state.isNewAccount ? `<div class="recap-row"><span>Mot de passe</span><strong>${state.password ? '••••••' : '—'}</strong></div>` : ''}
                                    <div class="recap-row recap-total"><span>Total à payer</span><strong>${this.formatPrice(total)} FCFA</strong></div>
                                    <div class="recap-row"><span>Solde actuel</span><strong class="${balanceOk?'text-success':'text-danger'}">${this.formatPrice(Math.round(this.balance))} FCFA</strong></div>
                                </div>
                                ${!balanceOk ? `<div class="alert-insufficient"><i class="fa-solid fa-triangle-exclamation"></i> Solde insuffisant. Rechargez votre Wallet.</div>` : ''}
                            </div>`;
                        nextBtn.textContent = `Payer ${this.formatPrice(total)} FCFA`;
                        nextBtn.style.opacity = balanceOk ? '1' : '0.5';
                        nextBtn.disabled = !balanceOk;
                    }

                // ---------------------------------------------------------------
                // E-COMMERCE — 4 steps
                // Step 1: Product link
                // Step 2: Variant (size/color/qty)
                // Step 3: Delivery address
                // Step 4: Recap + pay
                // ---------------------------------------------------------------
                } else {
                    if (state.step === 1) {
                        const hasDelay = !!state.catalog.delay;
                        body.innerHTML = `
                            <div class="of-section">
                                <h3 class="of-q">Collez le lien du produit</h3>
                                ${hasDelay ? `<div class="delay-banner"><i class="fa-solid fa-clock"></i> Délai estimé : <strong>${state.catalog.delay}</strong></div>` : ''}
                                <div class="input-group" style="margin-bottom: 10px;">
                                    <i class="fa-solid fa-link"></i>
                                    <input type="url" id="of-product-url" placeholder="https://..." value="${state.productUrl}" 
                                           oninput="app.orderState.productUrl=this.value" 
                                           onblur="if(this.value) app.analyzeLink(document.getElementById('btn-analyze'))"
                                           onpaste="setTimeout(() => { if(this.value) app.analyzeLink(document.getElementById('btn-analyze')) }, 100)">
                                </div>
                                <button type="button" id="btn-analyze" class="btn" style="width:100%; background:rgba(255,255,255,0.1); color:#fff; border-radius:12px; padding:10px; margin-bottom: 10px; font-weight: 500;" onclick="app.analyzeLink(this)">
                                    <i class="fa-solid fa-magnifying-glass"></i> Analyser le lien automatiquement
                                </button>
                                <div id="link-preview-container">
                                    ${state.productTitle ? `
                                    <div style="display:flex; gap:10px; align-items:center; background:rgba(255,255,255,0.05); padding:10px; border-radius:12px; margin-bottom:10px;">
                                        ${state.productImage ? `<img src="${state.productImage}" style="width:50px; height:50px; object-fit:cover; border-radius:8px;">` : `<div style="width:50px;height:50px;border-radius:8px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;"><i class="fa-solid fa-image text-muted"></i></div>`}
                                        <div style="flex:1; overflow:hidden;">
                                            <h4 style="margin:0; font-size:13px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${state.productTitle}</h4>
                                        </div>
                                    </div>` : ''}
                                </div>
                                <p class="of-hint">Copiez l'URL complète depuis l'appli ou le site</p>
                            </div>`;

                    } else if (state.step === 2) {
                        const tot = state.rawProductPrice > 0 ? this.calcEcomTotal(state.rawProductPrice, state.catalog) : 0;
                        const usdRate = this.usdRate || 0;
                        body.innerHTML = `
                            <div class="of-section">
                                <h3 class="of-q">Détails du produit</h3>
                                
                                ${state.productTitle ? `
                                <div style="display:flex; gap:10px; align-items:center; background:rgba(255,255,255,0.05); padding:10px; border-radius:12px; margin-bottom:15px;">
                                    ${state.productImage ? `<img src="${state.productImage}" style="width:40px; height:40px; object-fit:cover; border-radius:8px;">` : ''}
                                    <div style="flex:1; overflow:hidden;">
                                        <h4 style="margin:0; font-size:12px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; opacity:0.8;">${state.productTitle}</h4>
                                    </div>
                                </div>` : ''}

                                <div class="input-group">
                                    <i class="fa-solid fa-tag"></i>
                                    <input type="text" id="of-variant" placeholder="Taille / Couleur / Quantité (ex: M, Rouge, x2)" value="${state.productVariant}" oninput="app.orderState.productVariant=this.value">
                                </div>
                                ${usdRate > 0 ? `
                                <div style="background:rgba(255,153,0,0.08); border:1px solid rgba(255,153,0,0.25); border-radius:10px; padding:10px 14px; margin-top:12px;">
                                    <div style="font-size:12px; color:var(--text-muted); margin-bottom:6px;"><i class="fa-solid fa-arrow-right-arrow-left" style="color:#FF9900;"></i> Convertisseur USD → FCFA (taux live +3%)</div>
                                    <div style="display:flex; gap:8px; align-items:center;">
                                        <div class="input-group" style="margin:0; flex:1;">
                                            <i class="fa-solid fa-dollar-sign" style="color:#FF9900;"></i>
                                            <input type="number" id="of-usd-price" placeholder="Prix en USD" step="0.01" oninput="app.convertUsdToFcfa(this.value)" style="background:transparent;">
                                        </div>
                                        <span style="color:var(--text-muted); font-size:20px;">→</span>
                                        <span id="of-usd-converted" style="font-weight:700; color:#FF9900; min-width:80px;">—</span>
                                    </div>
                                </div>` : ''}
                                <div class="input-group mt-2">
                                    <i class="fa-solid fa-coins"></i>
                                    <input type="number" id="of-product-price" placeholder="Prix du produit (FCFA)" value="${state.rawProductPrice||''}" oninput="app.updateEcommercePrice(this.value)">
                                </div>
                                <div class="price-total-row" id="of-price-total" style="display:${tot>0?'flex':'none'}">
                                    <span>Total tout inclus (produit + frais de service)</span><strong>${tot>0 ? this.formatPrice(tot)+' FCFA' : ''}</strong>
                                </div>
                            </div>`;

                    } else if (state.step === 3) {
                        body.innerHTML = `
                            <div class="of-section">
                                <h3 class="of-q">Adresse de livraison</h3>
                                <div class="delivery-grid">
                                    <div class="input-group">
                                        <i class="fa-regular fa-user"></i>
                                        <input type="text" id="of-del-name" placeholder="Nom complet" value="${state.deliveryName}" oninput="app.orderState.deliveryName=this.value">
                                    </div>
                                    <div class="input-group">
                                        <i class="fa-solid fa-mobile-screen"></i>
                                        <input type="tel" id="of-del-phone" placeholder="Téléphone" value="${state.deliveryPhone}" oninput="app.orderState.deliveryPhone=this.value">
                                    </div>
                                </div>
                                <div class="input-group mt-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <input type="text" id="of-del-street" placeholder="Rue / Quartier / N° maison" value="${state.deliveryStreet}" oninput="app.orderState.deliveryStreet=this.value">
                                </div>
                                <div class="input-group mt-2">
                                    <i class="fa-solid fa-city"></i>
                                    <input type="text" id="of-del-city" placeholder="Ville / Pays" value="${state.deliveryCity}" oninput="app.orderState.deliveryCity=this.value">
                                </div>
                            </div>`;

                    } else if (state.step === 4) {
                        const tot = state.rawProductPrice > 0 ? this.calcEcomTotal(state.rawProductPrice, state.catalog) : 0;
                        const balanceOk = this.balance >= tot;
                        body.innerHTML = `
                            <div class="of-section">
                                <h3 class="of-q">Récapitulatif de commande</h3>
                                <div class="recap-card">
                                    <div class="recap-row"><span>Service</span><strong>${state.serviceName}</strong></div>
                                    <div class="recap-row"><span>Produit</span><strong class="text-truncate" style="max-width:180px;overflow:hidden;white-space:nowrap;">${state.productTitle || state.productUrl || '—'}</strong></div>
                                    <div class="recap-row"><span>Variante</span><strong>${state.productVariant || '—'}</strong></div>
                                    <div class="recap-row"><span>Livraison à</span><strong>${state.deliveryCity || '—'}</strong></div>
                                    <div class="recap-row recap-total"><span>Total à payer</span><strong>${this.formatPrice(tot)} FCFA</strong></div>
                                    <div class="recap-row"><span>Solde actuel</span><strong class="${balanceOk?'text-success':'text-danger'}">${this.formatPrice(Math.round(this.balance))} FCFA</strong></div>
                                </div>
                                ${state.catalog.delay ? `<div class="delay-banner"><i class="fa-solid fa-clock"></i> Délai estimé : <strong>${state.catalog.delay}</strong></div>` : ''}
                                ${!balanceOk ? `<div class="alert-insufficient"><i class="fa-solid fa-triangle-exclamation"></i> Solde insuffisant. Rechargez votre Wallet.</div>` : ''}
                            </div>`;
                        nextBtn.textContent = `Payer ${this.formatPrice(tot)} FCFA`;
                        nextBtn.style.opacity = balanceOk ? '1' : '0.5';
                        nextBtn.disabled = !balanceOk;
                    }
                }
            }

            setAccountType(isNew) {
                this.orderState.isNewAccount = isNew;
                this.renderOrderStep();
            }

            selectOrderPlan(idx) {
                const plans = this.orderState.catalog.plans;
                if (!plans || !plans[idx]) return;

                const clickedPlan = plans[idx];
                const isAlreadySelected = this.orderState.plan && this.orderState.plan.name === clickedPlan.name;

                if (isAlreadySelected) {
                    // Toggle/collapse/expand the advantages wrapper for this specific card
                    const cardEl = document.querySelector(`.plan-card[data-index="${idx}"]`);
                    if (cardEl) {
                        const wrapper = cardEl.querySelector('.plan-features-wrapper');
                        if (wrapper) {
                            const isOpen = wrapper.style.maxHeight !== '0px' && wrapper.style.maxHeight !== '0';
                            if (isOpen) {
                                wrapper.style.maxHeight = '0';
                                wrapper.style.opacity = '0';
                                wrapper.style.marginTop = '0';
                                wrapper.style.paddingTop = '0';
                                wrapper.style.borderTopColor = 'transparent';
                            } else {
                                wrapper.style.maxHeight = '200px';
                                wrapper.style.opacity = '1';
                                wrapper.style.marginTop = '12px';
                                wrapper.style.paddingTop = '12px';
                                wrapper.style.borderTopColor = 'rgba(255,255,255,0.15)';
                            }
                        }
                    }
                    return;
                }

                // Update state
                this.orderState.plan = clickedPlan;
                this.orderState.planPrice = clickedPlan.price;
                this.orderState.clientTotal = clickedPlan.price + (this.orderState.catalog.margin || 1500);

                // Update DOM directly for smooth transitions without complete redraw
                document.querySelectorAll('.plan-card').forEach((card) => {
                    const cardIndex = parseInt(card.getAttribute('data-index'));
                    const wrapper = card.querySelector('.plan-features-wrapper');
                    const icon = card.querySelector('.plan-check i');
                    
                    if (cardIndex === idx) {
                        card.classList.add('active');
                        if (icon) icon.className = 'fa-solid fa-circle-check';
                        if (wrapper) {
                            wrapper.style.maxHeight = '200px';
                            wrapper.style.opacity = '1';
                            wrapper.style.marginTop = '12px';
                            wrapper.style.paddingTop = '12px';
                            wrapper.style.borderTopColor = 'rgba(255,255,255,0.15)';
                        }
                    } else {
                        card.classList.remove('active');
                        if (icon) icon.className = 'fa-regular fa-circle';
                        if (wrapper) {
                            wrapper.style.maxHeight = '0';
                            wrapper.style.opacity = '0';
                            wrapper.style.marginTop = '0';
                            wrapper.style.paddingTop = '0';
                            wrapper.style.borderTopColor = 'transparent';
                        }
                    }
                });
            }

            // Helper: compute ecom total (product price + pct margin)
            calcEcomTotal(rawPrice, catalog) {
                if (catalog.marginType === 'pct') {
                    const m = Math.round(rawPrice * (catalog.marginPct || 0.10));
                    return rawPrice + m;
                }
                return rawPrice + (catalog.margin || 1500);
            }

            async analyzeLink(btn) {
                const url = this.orderState.productUrl;
                if (!url) { alert("Veuillez coller un lien d'abord."); return; }
                
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Analyse en cours...';
                btn.disabled = true;

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'link_preview', url })
                    });
                    const data = await res.json();
                    
                    if (data.status === 'success') {
                        this.orderState.productTitle = data.title;
                        this.orderState.productImage = data.image;
                        if (data.price > 0) this.orderState.rawProductPrice = data.price;
                        
                        document.getElementById('link-preview-container').innerHTML = `
                            <div style="display:flex; gap:10px; align-items:center; background:rgba(255,255,255,0.05); padding:10px; border-radius:12px; margin-bottom:10px;">
                                ${data.image ? `<img src="${data.image}" style="width:50px; height:50px; object-fit:cover; border-radius:8px;">` : `<div style="width:50px;height:50px;border-radius:8px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;"><i class="fa-solid fa-image text-muted"></i></div>`}
                                <div style="flex:1; overflow:hidden;">
                                    <h4 style="margin:0; font-size:13px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${data.title}</h4>
                                    ${data.price > 0 ? `<span style="color:#2ecc71; font-weight:bold; font-size:12px;">Prix détecté : ${data.price} (Devise du site)</span>` : `<span style="color:var(--text-muted); font-size:12px;">Prix non détecté (Sécurité site)</span>`}
                                </div>
                            </div>
                        `;
                    }
                } catch (err) {
                    console.error("Erreur d'analyse du lien", err);
                } finally {
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Image et Titre récupérés !';
                    btn.disabled = false;
                }
            }

            updateEcommercePrice(val) {
                const raw = parseFloat(val) || 0;
                this.orderState.rawProductPrice = raw;
                this.orderState.totalPrice      = raw; // keep alias in sync
                const tot = raw > 0 ? this.calcEcomTotal(raw, this.orderState.catalog) : 0;
                const totalRow = document.getElementById('of-price-total');
                if (totalRow) {
                    totalRow.style.display = raw > 0 ? 'flex' : 'none';
                    if (raw > 0) {
                        totalRow.querySelector('strong').textContent = this.formatPrice(tot) + ' FCFA';
                    }
                }
            }

            convertUsdToFcfa(usdVal) {
                const usd = parseFloat(usdVal) || 0;
                const rate = this.usdRate || 620;
                const fcfa = Math.round(usd * rate);
                const converted = document.getElementById('of-usd-converted');
                if (converted) {
                    converted.textContent = fcfa > 0 ? this.formatPrice(fcfa) + ' FCFA' : '—';
                }
                // Auto-fill the FCFA price field
                if (fcfa > 0) {
                    const priceInput = document.getElementById('of-product-price');
                    if (priceInput) {
                        priceInput.value = fcfa;
                        this.updateEcommercePrice(fcfa);
                    }
                }
            }

            async fetchUsdRate() {
                try {
                    const res = await fetch('api.php?action=get_rate');
                    const data = await res.json();
                    if (data.status === 'success') {
                        this.usdRate = data.rate_buffered;
                    }
                } catch(e) {
                    this.usdRate = 620; // fallback
                }
            }

            orderFormNext() {
                const state = this.orderState;
                const cat = state.catalog.category;

                // Validate current step
                if (cat !== 'ecommerce') {
                    if (state.step === 1) {
                        if (state.isNewAccount === null) { alert('Veuillez choisir votre type de compte.'); return; }
                    } else if (state.step === 2) {
                        const emailEl = document.getElementById('of-email');
                        const passEl  = document.getElementById('of-password');
                        if (emailEl) state.email    = emailEl.value.trim();
                        if (passEl)  state.password = passEl.value.trim();
                        if (!state.email) { alert('Veuillez entrer une adresse e-mail.'); return; }
                        if (state.isNewAccount && !state.password) { alert('Veuillez entrer un mot de passe souhaité.'); return; }
                    } else if (state.step === 3) {
                        this.submitServiceOrder(); return;
                    }
                } else {
                    if (state.step === 1) {
                        const urlEl = document.getElementById('of-product-url');
                        if (urlEl) state.productUrl = urlEl.value.trim();
                        if (!state.productUrl) { alert('Veuillez coller un lien de produit.'); return; }
                    } else if (state.step === 2) {
                        const varEl   = document.getElementById('of-variant');
                        const priceEl = document.getElementById('of-product-price');
                        if (varEl)   state.productVariant  = varEl.value.trim();
                        if (priceEl) state.rawProductPrice = parseFloat(priceEl.value) || 0;
                        state.totalPrice = state.rawProductPrice; // keep alias
                        if (state.rawProductPrice <= 0) { alert('Veuillez entrer le prix du produit.'); return; }
                    } else if (state.step === 3) {
                        const nameEl   = document.getElementById('of-del-name');
                        const phoneEl  = document.getElementById('of-del-phone');
                        const streetEl = document.getElementById('of-del-street');
                        const cityEl   = document.getElementById('of-del-city');
                        if (nameEl)   state.deliveryName   = nameEl.value.trim();
                        if (phoneEl)  state.deliveryPhone  = phoneEl.value.trim();
                        if (streetEl) state.deliveryStreet = streetEl.value.trim();
                        if (cityEl)   state.deliveryCity   = cityEl.value.trim();
                        if (!state.deliveryCity) { alert('Veuillez entrer la ville de livraison.'); return; }
                    } else if (state.step === 4) {
                        this.submitServiceOrder(); return;
                    }
                }

                state.step++;
                this.renderOrderStep();
            }

            orderFormBack() {
                if (this.orderState.step > 1) {
                    this.orderState.step--;
                    this.renderOrderStep();
                } else {
                    window.history.back();
                }
            }

            // Profile Actions
            async uploadAvatar(event) {
                const file = event.target.files[0];
                if (!file) return;
                
                const formData = new FormData();
                formData.append('action', 'upload_avatar');
                formData.append('avatar', file);
                
                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        body: formData
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        this.currentUser.avatar = data.avatarUrl;
                        this.updateUI();
                        localStorage.setItem('flexpay_db_update', Date.now());
                        alert('Photo de profil mise à jour !');
                    } else {
                        alert(data.message || 'Erreur lors de la mise à jour.');
                    }
                } catch (e) {
                    alert('Erreur réseau.');
                }
            }
            
            // Profile Pages Navigation
            openPersonalInfo() {
                this.navigate('view-personal-info');
            }

            openSecurity() {
                this.navigate('view-security');
            }

            openSupport() {
                this.navigate('view-support');
            }

            openAbout() {
                this.navigate('view-about');
            }

            async submitPasswordChange(e) {
                e.preventDefault();
                const currentPassword = document.getElementById('sec-current-password').value;
                const newPassword = document.getElementById('sec-new-password').value;
                const confirmPassword = document.getElementById('sec-confirm-password').value;

                if (newPassword !== confirmPassword) {
                    alert('Les nouveaux mots de passe ne correspondent pas.');
                    return;
                }

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'change_password', old_password: currentPassword, new_password: newPassword })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        alert("Mot de passe mis à jour avec succès.");
                        document.getElementById('form-security-password').reset();
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur serveur.");
                }
            }

            togglePasswordVisibility(inputId, iconElement) {
                const input = document.getElementById(inputId);
                if (input.type === 'password') {
                    input.type = 'text';
                    iconElement.classList.remove('fa-eye-slash');
                    iconElement.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    iconElement.classList.remove('fa-eye');
                    iconElement.classList.add('fa-eye-slash');
                }
            }

            async submitServiceOrder() {
                const state  = this.orderState;
                const cat    = state.catalog.category;
                const plan   = state.plan;

                // Compute total: flat-margin services use plan.price + margin
                //                pct-margin services (ecommerce) use calcEcomTotal(rawProductPrice)
                let total;
                if (cat === 'ecommerce') {
                    total = this.calcEcomTotal(state.rawProductPrice, state.catalog);
                } else {
                    total = plan ? plan.price + state.margin : 0;
                }

                if (total <= 0) { alert('Montant invalide.'); return; }
                if (this.balance < total) {
                    alert('Solde insuffisant. Rechargez votre Wallet.');
                    return;
                }

                const btn = document.getElementById('order-form-next-btn');
                btn.textContent = 'Traitement en cours...';
                btn.disabled = true;

                // For ecommerce: send rawProductPrice so server calculates pct margin
                // For flat-margin: send total (plan.price + margin) — server re-validates
                const priceToSend = cat === 'ecommerce' ? state.rawProductPrice : total;

                const payload = {
                    action:           'service_order',
                    service:          state.serviceName,
                    category:         cat,
                    plan:             plan ? plan.name : '',
                    price:            priceToSend,
                    account_email:    state.email,
                    account_password: state.password,
                    is_new_account:   state.isNewAccount ? 1 : 0,
                    product_url:      state.productUrl,
                    product_variant:  state.productVariant,
                    delivery_address: cat === 'ecommerce' ? {
                        name:   state.deliveryName,
                        phone:  state.deliveryPhone,
                        street: state.deliveryStreet,
                        city:   state.deliveryCity
                    } : null,
                    order_details: {}
                };

                try {
                    const res  = await fetch('api.php', {
                        method:  'POST',
                        headers: {'Content-Type': 'application/json'},
                        body:    JSON.stringify(payload)
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.reloadData();
                        this.showOrderSuccess(state.serviceName, total);
                    } else {
                        alert(data.message || 'Erreur lors du paiement.');
                        btn.textContent = `Payer ${this.formatPrice(total)} FCFA`;
                        btn.disabled = false;
                    }
                } catch(err) {
                    alert('Erreur réseau.');
                    btn.textContent = `Payer ${this.formatPrice(total)} FCFA`;
                    btn.disabled = false;
                }
            }

            showOrderSuccess(serviceName, total) {
                const body = document.getElementById('order-form-body');
                const footer = document.getElementById('order-form-footer');
                const stepper = document.getElementById('order-form-stepper');
                stepper.innerHTML = '';
                body.innerHTML = `
                    <div class="order-success-screen">
                        <div class="success-icon-wrap"><i class="fa-solid fa-circle-check"></i></div>
                        <h2>Commande envoyée !</h2>
                        <p>Votre commande <strong>${serviceName}</strong> a été soumise avec succès.<br>Vous serez notifié une fois traitée.</p>
                        <div class="success-amount">${this.formatPrice(total)} FCFA débités</div>
                    </div>`;
                footer.innerHTML = `
                    <button class="btn btn-primary btn-block" onclick="app.navigate('view-orders')">Voir mes commandes</button>
                    <button class="btn btn-outline btn-block mt-2" onclick="app.navigate('view-home')">Retour à l'accueil</button>`;
            }

            // Legacy stubs (keep for compatibility, no longer used)
            openOrderQuick(service) { this.openOrderForm(service); }
            openOrderLink() { this.openOrderForm('Shein'); }

            // Quick subscription purchase flow
            openOrderQuick_OLD(service) {
                this.activeService = service;
                this.activePlanIdx = 0;
                
                if (service === 'Netflix') {
                    this.activePlans = [
                        { name: 'Basic', price: 2500, period: 'mois' },
                        { name: 'Standard', price: 4500, period: 'mois' },
                        { name: 'Premium', price: 6500, period: 'mois' }
                    ];
                } else if (service === 'Spotify') {
                    this.activePlans = [
                        { name: 'Personnel', price: 1500, period: 'mois' },
                        { name: 'Duo', price: 2200, period: 'mois' },
                        { name: 'Famille', price: 3000, period: 'mois' }
                    ];
                } else if (service === 'Canal+') {
                    this.activePlans = [
                        { name: 'Canal+ Access', price: 5000, period: 'mois' },
                        { name: 'Canal+ Évasion', price: 10000, period: 'mois' },
                        { name: 'Tout Canal+', price: 20000, period: 'mois' }
                    ];
                } else {
                    this.activePlans = [
                        { name: 'Abonnement Standard', price: 3000, period: 'mois' }
                    ];
                }

                document.getElementById('order-quick-title').textContent = "Commandes - " + service;
                
                const banner = document.getElementById('order-quick-brand-banner');
                if (service === 'Netflix') {
                    banner.innerHTML = '<h1 style="color: #E50914; font-size: 3rem; font-weight: 900; letter-spacing: 2px; font-family: \'Arial Black\', sans-serif; margin: 0;">NETFLIX</h1>';
                } else if (service === 'Spotify') {
                    banner.innerHTML = '<h1 style="color: #1DB954; font-size: 2.8rem; font-weight: 900; letter-spacing: 1px; display: flex; align-items: center; justify-content: center; gap: 8px; margin: 0;"><i class="fa-brands fa-spotify"></i> Spotify</h1>';
                } else {
                    banner.innerHTML = `<h1 style="color: var(--primary); font-size: 2.5rem; font-weight: 800; margin: 0;">${service}</h1>`;
                }

                this.renderPlans();
                this.updateOrderQuickSummary();
                this.navigate('view-order-quick');
            }

            renderPlans() {
                const list = document.getElementById('order-quick-plans-list');
                list.innerHTML = this.activePlans.map((plan, idx) => {
                    const isActive = this.activePlanIdx === idx;
                    return `
                        <div class="plan-card ${isActive ? 'active' : ''}" onclick="app.selectPlan(${idx})">
                            <div class="plan-info">
                                <h4>${plan.name}</h4>
                                <span>${this.formatPrice(plan.price)} FCFA /${plan.period}</span>
                            </div>
                            <div class="plan-check">
                                <i class="fa-regular ${isActive ? 'fa-solid fa-circle-check' : 'fa-circle'}"></i>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            selectPlan(idx) {
                this.activePlanIdx = idx;
                this.renderPlans();
                this.updateOrderQuickSummary();
            }

            updateOrderQuickSummary() {
                const plan = this.activePlans[this.activePlanIdx];
                document.getElementById('summary-plan-name').textContent = this.activeService + " " + plan.name;
                document.getElementById('summary-plan-price').textContent = this.formatPrice(plan.price) + " FCFA";
                document.getElementById('pay-quick-btn').textContent = "Payer " + this.formatPrice(plan.price) + " FCFA";
            }

            async submitQuickOrder() {
                const plan = this.activePlans[this.activePlanIdx];
                if (this.balance < plan.price) {
                    alert("Solde insuffisant dans votre Wallet. Veuillez le recharger.");
                    return;
                }

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            action: 'quick_order',
                            service: this.activeService,
                            plan: plan.name,
                            price: plan.price
                        })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        alert("Commande confirmée et payée avec succès !");
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.reloadData();
                        this.navigate('view-orders');
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur lors du paiement.");
                }
            }

            // Link purchase order flow
            openOrderLink() {
                document.getElementById('link-order-url').value = '';
                document.getElementById('link-estimated-cost-card').style.display = 'none';
                
                const payBtn = document.getElementById('pay-link-btn');
                payBtn.disabled = true;
                payBtn.style.opacity = '0.6';
                payBtn.style.cursor = 'not-allowed';
                
                this.estimatedCost = null;
                this.navigate('view-order-link');
            }

            calculateLinkAmount() {
                const url = document.getElementById('link-order-url').value;
                if (!url.trim()) {
                    alert("Veuillez coller un lien de commande valide.");
                    return;
                }

                const prices = [5000, 8500, 12000, 15750, 22400, 31000];
                this.estimatedCost = prices[Math.floor(Math.random() * prices.length)];
                
                document.getElementById('link-estimated-display').innerHTML = this.formatPrice(this.estimatedCost) + ' <span>FCFA</span>';
                document.getElementById('link-estimated-cost-card').style.display = 'block';

                const payBtn = document.getElementById('pay-link-btn');
                payBtn.disabled = false;
                payBtn.style.opacity = '1';
                payBtn.style.cursor = 'pointer';
            }

            async submitLinkOrder() {
                if (!this.estimatedCost) return;
                
                if (this.balance < this.estimatedCost) {
                    alert("Solde insuffisant dans votre Wallet. Veuillez le recharger.");
                    return;
                }

                const url = document.getElementById('link-order-url').value;

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            action: 'link_order',
                            url: url,
                            price: this.estimatedCost
                        })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        alert("Commande Shein soumise avec succès !");
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.reloadData();
                        this.navigate('view-orders');
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur de paiement.");
                }
            }

            toggleBalanceObscure(icon) {
                const el = document.getElementById('home-balance-display');
                if (icon.classList.contains('fa-eye')) {
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                    el.innerHTML = '•••••• <span>FCFA</span>';
                } else {
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                    el.innerHTML = this.formatPrice(this.balance) + ' <span>FCFA</span>';
                }
            }
            // --- PROFILE METHODS (Defined above) ---

            // --- NOTIFICATIONS METHODS ---
            async loadNotifications() {
                try {
                    const fd = new FormData();
                    fd.append('action', 'get_notifications');
                    const res = await fetch('api.php', { method: 'POST', body: fd });
                    const data = await res.json();
                    if (data.status === 'success') {
                        this.renderNotifications(data.notifications);
                        
                        // Update bell icon badge
                        const btns = document.querySelectorAll('.notif-btn');
                        btns.forEach(btn => {
                            if (data.unreadCount > 0) {
                                btn.innerHTML = `<i class="fa-regular fa-bell"></i><span style="position:absolute; top:0; right:0; background:var(--danger); width:10px; height:10px; border-radius:50%; border:2px solid var(--background-dark);"></span>`;
                                btn.style.position = 'relative';
                            } else {
                                btn.innerHTML = `<i class="fa-regular fa-bell"></i>`;
                            }
                        });
                    }
                } catch (e) { console.error(e); }
            }

            renderNotifications(notifs) {
                const ctn = document.getElementById('notifications-list');
                if (!ctn) return;
                if (notifs.length === 0) {
                    ctn.innerHTML = `
                        <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                            <i class="fa-regular fa-bell" style="font-size: 40px; margin-bottom: 15px; opacity: 0.5;"></i>
                            <p>Aucune notification pour le moment.</p>
                        </div>
                    `;
                    return;
                }
                
                let html = '';
                notifs.forEach(n => {
                    const opacity = n.is_read == 1 ? '0.7' : '1';
                    const fw = n.is_read == 1 ? '400' : '600';
                    const bg = n.is_read == 0 ? 'rgba(59,130,246,0.05)' : 'var(--card-bg)';
                    html += `
                        <div style="display:flex; gap:15px; padding:15px; border-bottom:1px solid var(--border-color); opacity:${opacity}; background:${bg}; border-radius:12px; margin-bottom:10px; box-shadow:0 1px 4px rgba(0,0,0,0.02);">
                            <div style="width:40px; height:40px; border-radius:50%; background:var(--background); border:1px solid var(--border-color); display:flex; align-items:center; justify-content:center; font-size:18px; color:var(--primary); flex-shrink:0;">
                                <i class="fa-solid ${n.icon}"></i>
                            </div>
                            <div>
                                <h4 style="margin:0; font-size:14px; font-weight:${fw}; margin-bottom:4px;">${n.title}</h4>
                                <p style="margin:0; font-size:13px; color:var(--text-muted); line-height:1.4;">${n.message}</p>
                                <span style="font-size:11px; color:var(--text-muted); display:block; margin-top:6px;">${n.created_at}</span>
                            </div>
                        </div>
                    `;
                });
                ctn.innerHTML = html;
            }

            async openNotifications() {
                this.navigate('view-notifications');
                await this.loadNotifications();
                
                // Mark as read
                const fd = new FormData();
                fd.append('action', 'mark_notifications_read');
                await fetch('api.php', { method: 'POST', body: fd });
                
                // Reload in background to clear badge
                this.loadNotifications();
            }
        }

        const app = new FlexPayApp();

        // Dynamically toggle headers and bottom nav bar layout visibility on resize
        window.addEventListener('resize', () => {
            const activeView = document.querySelector('.view.active');
            if (activeView) {
                app.navigate(activeView.id);
            }
        });
    // PWA Service Worker Registration
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register(''+window.BASE_PATH+'sw.js')
                .then(reg => console.log('Service Worker enregistré !', reg))
                .catch(err => console.log('Échec SW: ', err));
        });
    }