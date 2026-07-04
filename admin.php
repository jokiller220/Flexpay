<?php
// admin.php - Desktop Admin Dashboard
session_start();

$ADMIN_PASS = 'flexpayadmin2026'; // Default password

if (isset($_GET['logout'])) {
    unset($_SESSION['admin_logged_in']);
    header('Location: admin.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_pass'])) {
    if ($_POST['admin_pass'] === $ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Mot de passe incorrect.";
    }
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background: #0B1021; color: white; font-family: 'Inter', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #131A33; padding: 40px; border-radius: 16px; text-align: center; width: 320px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        input { width: 100%; padding: 12px; margin-top: 15px; border-radius: 8px; border: 1px solid #2B3553; background: #0B1021; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; margin-top: 20px; border-radius: 8px; border: none; background: #5C32F8; color: white; font-weight: bold; cursor: pointer; }
        .err { color: #EF4444; margin-top: 10px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin FlexPay</h2>
        <form method="POST">
            <input type="password" name="admin_pass" placeholder="Mot de passe admin" required>
            <button type="submit">Se connecter</button>
            <?php if($error): ?><div class="err"><?php echo $error; ?></div><?php endif; ?>
        </form>
    </div>
</body>
</html>
<?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexPay - Dashboard Administrateur</title>
    <link rel="icon" type="image/png" href="assets/images/iconeflexpay.png">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/admin.css">
    <!-- ChartJS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Override body tags specifically for admin mode */
        body {
            background-color: #0B1021 !important;
            color: #FFFFFF !important;
            display: flex !important;
            height: 100vh !important;
            overflow: hidden !important;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            height: 100vh;
        }
        .main-content {
            height: 100vh;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .logo-icon-svg {
            filter: drop-shadow(0 4px 8px rgba(106, 13, 173, 0.4));
        }
        .btn-action {
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-action.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }
    </style>
</head>
<body class="admin-body">

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar">
        <div class="sidebar-header" style="display:flex; align-items:center; gap:12px;">
            <img src="logoflexpay.png" alt="FlexPay Logo" style="height: 40px; transform: scale(2.5); transform-origin: left center; margin-left: 10px;">

        </div>

        <nav class="sidebar-nav">
            <a href="#" class="nav-item active" onclick="admin.navigate('view-dashboard')" id="nav-view-dashboard">
                <i class="fa-solid fa-chart-pie"></i>
                Dashboard
            </a>
            <a href="#" class="nav-item" onclick="admin.navigate('view-orders')" id="nav-view-orders">
                <i class="fa-solid fa-clipboard-list"></i>
                Commandes
            </a>
            <a href="#" class="nav-item" onclick="admin.navigate('view-transactions')" id="nav-view-transactions">
                <i class="fa-solid fa-money-bill-transfer"></i>
                Transactions
            </a>
            <a href="#" class="nav-item" onclick="admin.navigate('view-users')" id="nav-view-users">
                <i class="fa-solid fa-users"></i>
                Clients & Wallets
            </a>
            <a href="#" class="nav-item mt-auto" onclick="alert('Paramètres')">
                <i class="fa-solid fa-gear"></i>
                Paramètres
            </a>
            <a href="#" class="nav-item" onclick="alert('Support Client')">
                <i class="fa-regular fa-circle-question"></i>
                Support
            </a>
            <a href="index.php" class="nav-item text-danger">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Interface Client
            </a>
        </nav>
    </aside>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="page-title">
                <h2>Dashboard</h2>
            </div>
            
            <div class="topbar-actions">
                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                
                <button class="icon-btn notif-btn">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge" id="admin-badge-count">0</span>
                </button>
                
                <div class="admin-profile" onclick="alert('Profil Admin')">
                    <div class="avatar"><i class="fa-solid fa-user-tie"></i></div>
                    <div class="info">
                        <span class="name">Admin</span>
                        <span class="role">Développeur</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-muted"></i>
                </div>
            </div>
        </header>

        <div id="admin-views-container" style="flex:1; overflow-y:auto; padding: 24px;">
            <!-- ================= VIEW: DASHBOARD ================= -->
            <div id="view-dashboard" class="admin-view active">
                <!-- Dashboard Content Grid -->
                <div class="dashboard-grid">
            
            <!-- Left Column (Stats & Table & Revenue Chart) -->
            <div class="left-col" style="flex:3;">
                
                <!-- Stats Row -->
                <div class="stats-row">
                    <div class="stat-card bg-purple">
                        <div class="stat-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                        <div class="stat-info">
                            <span>Commandes aujourd'hui</span>
                            <h3 id="stat-total-orders">0</h3>
                            <span class="trend positive">+23% vs hier</span>
                        </div>
                    </div>
                    <div class="stat-card bg-orange">
                        <div class="stat-icon"><i class="fa-solid fa-clock"></i></div>
                        <div class="stat-info">
                            <span>En traitement</span>
                            <h3 id="stat-processing-orders">0</h3>
                            <span class="trend neutral">En cours</span>
                        </div>
                    </div>
                    <div class="stat-card bg-green">
                        <div class="stat-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="stat-info">
                            <span>Validées</span>
                            <h3 id="stat-validated-orders">0</h3>
                            <span class="trend positive">+18% ce mois</span>
                        </div>
                    </div>
                    <div class="stat-card bg-blue position-relative">
                        <button class="close-btn" onclick="this.parentElement.style.display='none'"><i class="fa-solid fa-xmark"></i></button>
                        <div class="stat-info">
                            <span>Solde total reçu</span>
                            <h3 id="stat-total-received">0 <span class="currency">FCFA</span></h3>
                            <span class="trend positive">+12% ce mois</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Commandes récentes</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Commande</th>
                                    <th>Client</th>
                                    <th>Service</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Suivi (Colis)</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="admin-orders-table-body">
                                <!-- Loaded dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Revenues Chart -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Aperçu des revenus</h3>
                        <select class="dropdown-select" onchange="alert('Filtrer le graphique')">
                            <option>7 derniers jours</option>
                            <option>30 derniers jours</option>
                        </select>
                    </div>
                    <div class="chart-container" style="height: 220px; position: relative;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Column (Alerts List) -->
            <div class="right-col" style="flex:1; margin-left: 24px;">
                <div class="card alerts-card" style="height:100%; display:flex; flex-direction:column;">
                    <div class="card-header">
                        <h3>Alertes</h3>
                    </div>
                    <div class="alerts-list" id="admin-alerts-list">
                        <!-- Loaded dynamically -->
                    </div>
                    <button class="btn-block-outline mt-auto" onclick="alert('Toutes les alertes')">Voir toutes les alertes</button>
                </div>
            </div>
            
                </div>
            </div>

            <!-- ================= VIEW: ORDERS ================= -->
            <div id="view-orders" class="admin-view" style="display:none;">
                <div class="card">
                    <div class="card-header">
                        <h3>Toutes les Commandes</h3>
                        <button class="btn-action" onclick="admin.loadAdminData()" style="background:#5C32F8; color:white; border:none; padding:8px 16px; border-radius:6px; font-weight:bold;">Actualiser</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Service</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Identifiants / Action</th>
                                </tr>
                            </thead>
                            <tbody id="admin-all-orders-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================= VIEW: USERS ================= -->
            <div id="view-users" class="admin-view" style="display:none;">
                <div class="card">
                    <div class="card-header">
                        <h3>Clients & Wallets</h3>
                        <button class="btn-action" onclick="admin.loadUsersData()" style="background:#5C32F8; color:white; border:none; padding:8px 16px; border-radius:6px; font-weight:bold;">Actualiser</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Solde Wallet</th>
                                    <th>Inscription</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="admin-users-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================= VIEW: TRANSACTIONS ================= -->
            <div id="view-transactions" class="admin-view" style="display:none;">
                <div class="card">
                    <div class="card-header">
                        <h3>Historique des Transactions</h3>
                        <button class="btn-action" onclick="admin.loadTransactionsData()" style="background:#5C32F8; color:white; border:none; padding:8px 16px; border-radius:6px; font-weight:bold;">Actualiser</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Tx</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Service</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody id="admin-transactions-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

    <!-- Admin dashboard logic scripts -->
    <script>
        class AdminDashboard {
            constructor() {
                this.chart = null;
                this.allOrders = [];
                this.init();
            }

            init() {
                this.loadAdminData();
                this.initChart();
                
                // Poll for updates every 15 seconds to show real-time changes
                setInterval(() => this.loadAdminData(), 15000);

                // Listen to storage sync events
                window.addEventListener('storage', (e) => {
                    if (e.key === 'flexpay_db_update') {
                        this.loadAdminData();
                    }
                });
            }

            navigate(viewId) {
                // Hide all views
                document.querySelectorAll('.admin-view').forEach(el => el.style.display = 'none');
                // Remove active class from nav
                document.querySelectorAll('.sidebar-nav .nav-item').forEach(el => el.classList.remove('active'));
                
                // Show requested view
                const viewEl = document.getElementById(viewId);
                if (viewEl) viewEl.style.display = 'block';
                
                // Set nav active
                const navEl = document.getElementById('nav-' + viewId);
                if (navEl) navEl.classList.add('active');

                // Load view specific data
                if (viewId === 'view-users') this.loadUsersData();
                if (viewId === 'view-transactions') this.loadTransactionsData();
            }

            async loadAdminData() {
                try {
                    const res = await fetch('api.php?action=admin_get_data');
                    const data = await res.json();

                    if (data.status === 'success') {
                        this.updateStats(data.stats);
                        this.updateOrdersTable(data.orders);
                        this.updateAlerts(data.alerts);
                        this.updateChartData(data.stats.total_received);
                    }
                } catch (err) {
                    console.error("Erreur de récupération des données de l'administrateur: ", err);
                }
            }

            updateStats(stats) {
                document.getElementById('stat-total-orders').textContent = stats.total_orders;
                document.getElementById('stat-processing-orders').textContent = stats.processing_orders;
                document.getElementById('stat-validated-orders').textContent = stats.validated_orders;
                document.getElementById('stat-total-received').innerHTML = this.formatPrice(stats.total_received) + ' <span class="currency">FCFA</span>';
                
                // Badge alert count
                document.getElementById('admin-badge-count').textContent = stats.processing_orders;
            }

            updateOrdersTable(orders) {
                const tbodyDashboard = document.getElementById('admin-orders-table-body');
                const tbodyAll = document.getElementById('admin-all-orders-table-body');
                
                if (orders.length === 0) {
                    const emptyRow = '<tr><td colspan="7" style="text-align:center;">Aucune commande</td></tr>';
                    if (tbodyDashboard) tbodyDashboard.innerHTML = emptyRow;
                    if (tbodyAll) tbodyAll.innerHTML = emptyRow;
                    return;
                }

                const rows = orders.map(order => {
                    const isFinished = order.status.toLowerCase() === 'validée' || order.status.toLowerCase() === 'terminée';
                    
                    let statusClass = 'status-warning';
                    if (isFinished) {
                        statusClass = 'status-success';
                    } else if (order.status.toLowerCase() === 'reçue') {
                        statusClass = 'status-info';
                    }

                    const actionButton = `<div style="display:flex; flex-direction:column; gap:4px;">
                        <button class="btn-action" onclick="admin.promptUpdateOrder('${order.id}', '${order.status}', '${order.account_email || ''}', '${order.account_password || ''}')" style="background:#5C32F8; color:#fff; border:none; padding: 6px 12px; border-radius:6px; font-size:0.8rem; font-weight:600;"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
                    </div>`;

                    let trackingInfo = '-';
                    if (order.category === 'ecommerce') {
                        if (order.tracking_number) {
                            trackingInfo = `<strong>${order.tracking_number}</strong> <i class="fa-solid fa-pen" style="cursor:pointer; font-size:12px; margin-left:4px;" onclick="admin.promptTracking('${order.id}', '${order.tracking_number}')"></i>`;
                        } else {
                            trackingInfo = `<button class="btn-action" onclick="admin.promptTracking('${order.id}', '')" style="background:transparent; border:1px solid #FF9900; color:#FF9900; padding:2px 8px; border-radius:4px; font-size:0.75rem;">Ajouter suivi</button>`;
                        }
                    }

                    let vccInfo = '';
                    if (order.is_automatable == 1) {
                        vccInfo = `<div style="margin-top:4px; font-size:0.75rem; color:#10B981; font-weight:bold;"><i class="fa-solid fa-bolt"></i> Auto-souscrit</div>`;
                    } else if (order.vcc_number) {
                        vccInfo = `<div style="margin-top:6px; background:#1A2238; padding:6px; border-radius:6px; font-size:0.75rem; border:1px solid #2D334A;">
                            <div style="color:#9CA3AF; margin-bottom:2px;">Carte Virtuelle Générée :</div>
                            <div style="color:#fff; font-family:monospace; font-size:0.85rem; letter-spacing:1px;">${order.vcc_number}</div>
                            <div style="color:#9CA3AF; display:flex; gap:10px; margin-top:2px;">
                                <span>Exp: <strong style="color:#fff;">${order.vcc_exp}</strong></span>
                                <span>CVV: <strong style="color:#fff;">${order.vcc_cvv}</strong></span>
                            </div>
                        </div>`;
                    }

                    return `
                        <tr>
                            <td>#${order.id}</td>
                            <td>
                                <strong>${order.client}</strong><br>
                                <span style="font-size:0.75rem; color:#9CA3AF;">${order.account_email || ''}</span>
                            </td>
                            <td>
                                ${order.service} ${order.plan ? `<br><span style="font-size:0.75rem; color:#9CA3AF;">${order.plan}</span>` : ''}
                                ${vccInfo}
                            </td>
                            <td>${this.formatPrice(parseFloat(order.price))} FCFA<br><span style="font-size:0.75rem; color:#10B981;">+${this.formatPrice(parseFloat(order.margin))} marge</span></td>
                            <td><span class="badge-status ${statusClass}">${order.status}</span></td>
                            <td>${trackingInfo}</td>
                            <td>${order.date}</td>
                            <td>${actionButton}</td>
                        </tr>
                    `;
                });
                
                // Dashboard shows only 5 recent orders
                if (tbodyDashboard) tbodyDashboard.innerHTML = rows.slice(0, 5).join('');
                // All Orders shows everything
                if (tbodyAll) tbodyAll.innerHTML = rows.join('');
            }

            updateAlerts(alerts) {
                const list = document.getElementById('admin-alerts-list');
                if (alerts.length === 0) {
                    list.innerHTML = '<div class="alert-item"><div class="alert-info"><span>Aucune alerte</span></div></div>';
                    return;
                }

                list.innerHTML = alerts.map(alert => {
                    return `
                        <div class="alert-item" style="display:flex; align-items:flex-start; gap:12px; margin-bottom:16px;">
                            <div class="alert-icon ${alert.colorClass}" style="width:32px; height:32px; border-radius:8px; display:flex; justify-content:center; align-items:center; color:#fff;">
                                <i class="${alert.icon}"></i>
                            </div>
                            <div class="alert-info" style="display:flex; flex-direction:column; gap:2px;">
                                <h4 style="font-size:0.9rem; font-weight:600; margin:0;">${alert.title}</h4>
                                <span style="font-size:0.8rem; color:#9CA3AF;">${alert.subtitle}</span>
                                <span class="time" style="font-size:0.7rem; color:#9CA3AF; margin-top:4px;">${alert.time}</span>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            async validateOrder(orderId) {
                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'admin_validate_order', order_id: orderId })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        // Sync storage
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.loadAdminData();
                    } else {
                        alert(data.message);
                    }
                } catch (err) {
                    alert("Erreur de validation de commande.");
                }
            }

            async refuseOrder(orderId) {
                if (!confirm('Refuser cette commande ? Le client sera remboursé automatiquement sur son wallet.')) return;
                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'admin_refuse_order', order_id: orderId })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        const msg = data.refunded 
                            ? `✅ Commande refusée. ${data.amount ? data.amount.toLocaleString() + ' FCFA' : ''} remboursé(s) sur le wallet du client.`
                            : '✅ Commande refusée.';
                        alert(msg);
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.loadAdminData();
                    } else {
                        alert(data.message || 'Erreur lors du refus.');
                    }
                } catch (err) {
                    alert('Erreur réseau lors du refus de commande.');
                }
            }

            async promptTracking(orderId, currentTracking) {
                const tracking = prompt("Numéro de suivi pour " + orderId + " :", currentTracking);
                if (tracking !== null) {
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify({ action: 'admin_update_tracking', order_id: orderId, tracking_number: tracking })
                        });
                        const data = await res.json();
                        if (data.status === 'success') {
                            localStorage.setItem('flexpay_db_update', Date.now());
                            await this.loadAdminData();
                        } else {
                            alert(data.message);
                        }
                    } catch(err) {
                        alert("Erreur réseau.");
                    }
                }
            }

            formatPrice(price) {
                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }

            initChart() {
                const ctx = document.getElementById('revenueChart').getContext('2d');
                
                this.chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                        datasets: [{
                            label: 'Revenus (FCFA)',
                            data: [150000, 230000, 180000, 320000, 280000, 410000, 390000],
                            borderColor: '#8A2BE2',
                            backgroundColor: 'rgba(138, 43, 226, 0.1)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#FFFFFF',
                            pointBorderColor: '#8A2BE2',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                ticks: {
                                    color: '#9CA3AF',
                                    callback: function(value) { return (value / 1000) + 'k'; }
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: '#9CA3AF' }
                            }
                        }
                    }
                });
            }

            updateChartData(totalReceived) {
                if (!this.chart) return;
                const baseRevenues = [150000, 230000, 180000, 320000, 280000, 410000, 390000];
                baseRevenues[6] = 200000 + totalReceived;
                this.chart.data.datasets[0].data = baseRevenues;
                this.chart.update();
            }

            async promptUpdateOrder(orderId, currentStatus, currentEmail, currentPassword) {
                const newStatus = prompt("Nouveau statut (En traitement, Validée, Livrée, Terminée, Annulée, Refusée):", currentStatus);
                if (!newStatus) return;
                
                let newEmail = currentEmail;
                let newPassword = currentPassword;
                
                if (newStatus === 'Livrée' || newStatus === 'Terminée' || newStatus === 'Validée') {
                    const ansEmail = prompt("Email du compte (Laissez vide si inchangé):", currentEmail || "");
                    if (ansEmail !== null) newEmail = ansEmail;
                    
                    const ansPass = prompt("Mot de passe du compte (Laissez vide si inchangé):", currentPassword || "");
                    if (ansPass !== null) newPassword = ansPass;
                }

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            action: 'admin_update_order_status', 
                            order_id: orderId, 
                            status: newStatus,
                            account_email: newEmail,
                            account_password: newPassword
                        })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        localStorage.setItem('flexpay_db_update', Date.now());
                        await this.loadAdminData();
                    } else {
                        alert(data.message);
                    }
                } catch(err) {
                    alert("Erreur réseau.");
                }
            }

            async loadUsersData() {
                try {
                    const res = await fetch('api.php?action=admin_get_users');
                    const data = await res.json();
                    if (data.status === 'success') {
                        const tbody = document.getElementById('admin-users-table-body');
                        if (data.users.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">Aucun client</td></tr>';
                            return;
                        }
                        tbody.innerHTML = data.users.map(u => `
                            <tr>
                                <td>${u.id}</td>
                                <td><strong>${u.name}</strong></td>
                                <td>${u.phone}</td>
                                <td><strong style="color:#10B981;">${this.formatPrice(parseFloat(u.balance))} FCFA</strong></td>
                                <td>${u.created_at}</td>
                                <td>
                                    <button class="btn-action" onclick="admin.promptUpdateWallet(${u.id}, '${u.name}')" style="background:#10B981; color:white; border:none; padding:6px 12px; border-radius:6px; font-weight:bold;">Créditer Wallet</button>
                                </td>
                            </tr>
                        `).join('');
                    }
                } catch (err) {}
            }

            async promptUpdateWallet(userId, userName) {
                const amount = prompt(`Entrez le montant (FCFA) à ajouter au compte de ${userName} :`, "0");
                if (!amount || isNaN(amount) || parseFloat(amount) <= 0) return;

                const reason = prompt("Motif de la recharge :", "Recharge manuelle (Admin)");
                if (reason === null) return;

                if (!confirm(`Confirmez-vous l'ajout de ${amount} FCFA au compte de ${userName} ?`)) return;

                try {
                    const res = await fetch('api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'admin_update_wallet', user_id: userId, amount: amount, reason: reason })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        alert("Wallet crédité avec succès !");
                        this.loadUsersData(); // Reload table
                    } else {
                        alert(data.message);
                    }
                } catch(err) {
                    alert("Erreur réseau.");
                }
            }

            async loadTransactionsData() {
                try {
                    const res = await fetch('api.php?action=admin_get_transactions');
                    const data = await res.json();
                    if (data.status === 'success') {
                        const tbody = document.getElementById('admin-transactions-table-body');
                        if (data.transactions.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">Aucune transaction</td></tr>';
                            return;
                        }
                        tbody.innerHTML = data.transactions.map(t => {
                            let color = t.type === 'deposit' ? '#10B981' : '#EF4444';
                            let sign = t.type === 'deposit' ? '+' : '-';
                            return `
                                <tr>
                                    <td>${t.id}</td>
                                    <td>${t.date}</td>
                                    <td><strong>${t.user_name || 'Inconnu'}</strong></td>
                                    <td>${t.service}</td>
                                    <td><strong style="color:${color};">${sign}${this.formatPrice(parseFloat(t.amount))} FCFA</strong></td>
                                    <td><span class="badge-status ${t.status === 'Confirmée' ? 'status-success' : 'status-warning'}">${t.status}</span></td>
                                </tr>
                            `;
                        }).join('');
                    }
                } catch (err) {}
            }
        }

        // Initialize admin instance globally
        const admin = new AdminDashboard();
    </script>
</body>
</html>
