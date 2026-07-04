<?php
// api.php - Backend JSON API endpoint
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

session_start();

// Load DB
$pdo = (isset($pdo) && $pdo instanceof PDO) ? $pdo : require __DIR__ . '/db.php';

// Helper for inputs (supports both JSON post and raw POST form data)
$inputRaw = file_get_contents('php://input');
$data = json_decode($inputRaw, true);
if (!$data) {
    $data = $_POST;
}

$action = isset($data['action']) ? $data['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

if (!$action) {
    echo json_encode(['status' => 'error', 'message' => 'Aucune action spécifiée.']);
    exit;
}

// -----------------------------------------------------------------------
// Security Check: Protect Admin Actions
// -----------------------------------------------------------------------
if (strpos($action, 'admin_') === 0) {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode(['status' => 'error', 'message' => 'Accès refusé. Administrateur non connecté.']);
        exit;
    }
}

// Date Helpers
if (!function_exists('getFormattedDateTime')) {
    function getFormattedDateTime() {
        $months = ["Jan", "Fév", "Mar", "Avr", "Mai", "Jun", "Jul", "Aoû", "Sep", "Oct", "Nov", "Déc"];
        $monthName = $months[date('n') - 1];
        return date('d') . ' ' . $monthName . ' ' . date('Y') . ' • ' . date('H:i');
    }
}

if (!function_exists('getFormattedDateShort')) {
    function getFormattedDateShort() {
        $months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        $monthName = $months[date('n') - 1];
        return date('j') . ' ' . $monthName . ' ' . date('Y');
    }
}

if (!function_exists('getFormattedDateCode')) {
    function getFormattedDateCode() {
        return date('ymd');
    }
}

if (!function_exists('simulateVCCGeneration')) {
    function simulateVCCGeneration() {
        return [
            'number' => '4' . rand(100,999) . ' ' . rand(1000,9999) . ' ' . rand(1000,9999) . ' ' . rand(1000,9999),
            'cvv' => str_pad(rand(100, 999), 3, '0', STR_PAD_LEFT),
            'exp' => str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '/' . (date('y') + rand(1, 4)),
            'provider' => 'Stripe Issuing (Mock)'
        ];
    }
}

// -----------------------------------------------------------------------
// Server-side service catalog (prevents price tampering from client)
//
// margin_type: 'flat'  → fixed FCFA added to plan cost
//              'pct'   → percentage of product price (e-commerce)
// -----------------------------------------------------------------------
$SERVICE_CATALOG = [
    // --- STREAMING ---
    // ── STREAMING : +1 500 FCFA flat ────────────────────────────────────
    'Netflix' => [
        'category'    => 'streaming',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Basic'    => 2500,
            'Standard' => 4500,
            'Premium'  => 6500,
        ],
    ],
    'Spotify' => [
        'category'    => 'streaming',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Personnel' => 1500,
            'Duo'       => 2200,
            'Famille'   => 3000,
        ],
    ],
    'Disney+' => [
        'category'    => 'streaming',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Standard' => 3000,
            'Premium'  => 6000,
        ],
    ],
    'Apple TV' => [
        'category'    => 'streaming',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Mensuel' => 3500,
        ],
    ],
    'Apple Music' => [
        'category'    => 'streaming',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Individuel' => 2000,
            'Famille'    => 4000,
        ],
    ],
    'Deezer' => [
        'category'    => 'streaming',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Premium' => 2000,
            'Famille' => 3500,
        ],
    ],
    // ── E-COMMERCE : pourcentage du prix produit ─────────────────────────
    'Shein' => [
        'category'    => 'ecommerce',
        'margin_type' => 'pct',
        'margin_pct'  => 0.10,   // +10 %
        'plans'       => [],
    ],
    'AliExpress' => [
        'category'    => 'ecommerce',
        'margin_type' => 'pct',
        'margin_pct'  => 0.10,   // +10 %
        'delay'       => '15-45 jours',
        'plans'       => [],
    ],
    'Amazon' => [
        'category'    => 'ecommerce',
        'margin_type' => 'pct',
        'margin_pct'  => 0.12,   // +12 % (réexpédition depuis France)
        'plans'       => [],
    ],
    'Amazon Prime' => [
        'category'    => 'streaming',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Mensuel' => 3500,
            'Annuel'  => 30000,
        ],
    ],
    // ── GAMING : +2 000 FCFA flat ────────────────────────────────────────
    'PlayStation' => [
        'category'    => 'gaming',
        'margin_type' => 'flat',
        'margin'      => 2000,
        'plans'       => [
            'PS Plus Essential (1 mois)'  => 5000,
            'PS Plus Extra (1 mois)'      => 8000,
            'PS Plus Premium (1 mois)'    => 10000,
            'Carte cadeau 10€'            => 7500,
            'Carte cadeau 20€'            => 14500,
            'Carte cadeau 50€'            => 36000,
        ],
    ],
    'Xbox' => [
        'category'    => 'gaming',
        'margin_type' => 'flat',
        'margin'      => 2000,
        'plans'       => [
            'Game Pass Core (1 mois)'     => 5000,
            'Game Pass Ultimate (1 mois)' => 8500,
            'Carte cadeau 15€'            => 11000,
            'Carte cadeau 25€'            => 18000,
        ],
    ],
    'Steam' => [
        'category'    => 'gaming',
        'margin_type' => 'flat',
        'margin'      => 2000,
        'plans'       => [
            'Carte cadeau 10€'  => 7500,
            'Carte cadeau 20€'  => 14500,
            'Carte cadeau 50€'  => 36000,
            'Carte cadeau 100€' => 72000,
        ],
    ],
    // ── LOGICIELS / SAAS : +1 500 FCFA flat ─────────────────────────────
    'NordVPN' => [
        'category'    => 'other',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            '1 mois' => 5000,
            '6 mois' => 25000,
            '1 an'   => 40000,
        ],
    ],
    'ExpressVPN' => [
        'category'    => 'other',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            '1 mois' => 6500,
            '6 mois' => 35000,
            '1 an'   => 60000,
        ],
    ],
    'Canva Pro' => [
        'category'    => 'other',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            '1 mois' => 7000,
            '1 an'   => 60000,
        ],
    ],
    'ChatGPT Plus' => [
        'category'    => 'other',
        'margin_type' => 'flat',
        'margin'      => 1500,
        'plans'       => [
            'Mensuel' => 12000,
        ],
    ],
];

// ----------------------------------------------------
// ACTIONS
// ----------------------------------------------------

switch ($action) {

    case 'register':
        $name     = trim($data['name']     ?? '');
        $phone    = trim($data['phone']    ?? '');
        $password = trim($data['password'] ?? '');
        $referral = trim($data['referral_code'] ?? '');

        if (!$name || !$phone || !$password) {
            echo json_encode(['status' => 'error', 'message' => 'Veuillez remplir tous les champs.']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        if ($stmt->fetch()) {
            echo json_encode(['status' => 'error', 'message' => 'Un compte avec ce numéro existe déjà.']);
            exit;
        }

        $referrerId = null;
        $bonus = 0;
        if ($referral) {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE referral_code = ?");
            $stmt->execute([$referral]);
            $referrer = $stmt->fetch();
            if ($referrer) {
                $referrerId = $referrer['id'];
                $bonus = 500; // 500 FCFA bonus for both
            }
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $myReferralCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
        $initialBalance = 0.00 + $bonus; // Initial balance at zero + referral bonus if any
        
        $stmt   = $pdo->prepare("INSERT INTO users (name, phone, password, balance, referral_code, referred_by) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $phone, $hashed, $initialBalance, $myReferralCode, $referrerId]);

        $userId = $pdo->lastInsertId();
        
        // Welcome notification
        $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, "Bienvenue sur FlexPay !", "Votre compte a été créé avec succès.", 'fa-circle-check']);

        if ($referrerId) {
            // Give bonus to referrer
            $stmt = $pdo->prepare("UPDATE users SET balance = balance + 500 WHERE id = ?");
            $stmt->execute([$referrerId]);
            
            // Log transactions
            $txDate = getFormattedDateTime();
            $stmt = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, 'Parrainage', 500, ?, 'bonus', 'Confirmée')");
            $stmt->execute(['TX-PAR-' . rand(100000, 999999), $userId, "Bonus d'inscription (Parrainage)", $txDate]);
            $stmt->execute(['TX-PAR-' . rand(100000, 999999), $referrerId, "Bonus parrainage ($name)", $txDate]);

            // Notifications parrainage
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, "Bonus d'inscription", "Félicitations ! Vous avez reçu 500 FCFA de bonus d'inscription grâce au parrainage.", 'fa-gift']);
            $stmt->execute([$referrerId, "Bonus parrainage", "Félicitations ! Vous avez reçu 500 FCFA de bonus pour avoir parrainé $name.", 'fa-gift']);
        }

        $_SESSION['user_id'] = $userId;

        echo json_encode([
            'status' => 'success',
            'user'   => [
                'id' => $userId, 
                'name' => $name, 
                'phone' => $phone, 
                'balance' => $initialBalance, 
                'avatar' => null,
                'referral_code' => $myReferralCode
            ]
        ]);
        break;

    case 'login':
        $phone    = trim($data['phone']    ?? '');
        $password = trim($data['password'] ?? '');

        if (!$phone || !$password) {
            echo json_encode(['status' => 'error', 'message' => 'Veuillez remplir tous les champs.']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || (!password_verify($password, $user['password']) && $password !== $user['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Numéro de téléphone ou mot de passe incorrect.']);
            exit;
        }

        $_SESSION['user_id'] = $user['id'];

        echo json_encode([
            'status' => 'success',
            'user'   => [
                'id'      => $user['id'],
                'name'    => $user['name'],
                'phone'   => $user['phone'],
                'balance' => (float)$user['balance'],
                'avatar'  => $user['avatar']
            ]
        ]);
        break;

    case 'logout':
        unset($_SESSION['user_id']);
        session_destroy();
        echo json_encode(['status' => 'success']);
        break;

    case 'get_data':
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo json_encode(['status' => 'auth_required']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT id, name, phone, balance, avatar, referral_code FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            unset($_SESSION['user_id']);
            echo json_encode(['status' => 'auth_required']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT id, title, service, amount, date, type, status FROM transactions WHERE user_id = ? ORDER BY created_at DESC LIMIT 20");
        $stmt->execute([$userId]);
        $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return enriched order fields for client tracking
        $stmt = $pdo->prepare("
            SELECT id, client, phone, service, category, price, status, date, plan, tracking_number, delivery_address, product_url, is_new_account
            FROM orders 
            WHERE user_id = ? OR phone = ? 
            ORDER BY created_at DESC
        ");
        $stmt->execute([$userId, $user['phone']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status'       => 'success',
            'user'         => [
                'id'      => $user['id'],
                'name'    => $user['name'],
                'phone'   => $user['phone'],
                'balance' => (float)$user['balance'],
                'avatar'  => $user['avatar'],
                'referral_code' => $user['referral_code']
            ],
            'transactions' => $transactions,
            'orders'       => $orders
        ]);
        break;

    case 'recharge':
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }

        $method       = trim($data['method'] ?? '');
        $amount       = (float)($data['amount'] ?? 0);
        $rechargePhone = trim($data['phone'] ?? '');
        $transactionId = trim($data['transaction_id'] ?? 'TX-' . rand(100000, 999999));

        if (!$method || $amount <= 0 || !$rechargePhone) {
            echo json_encode(['status' => 'error', 'message' => 'Données de recharge invalides.']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
        $stmt->execute([$amount, $userId]);

        $stmt = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, ?, ?, ?, 'recharge', 'Confirmée')");
        $stmt->execute([$transactionId, $userId, "Recharge Wallet ($method)", $method, $amount, getFormattedDateTime()]);

        // Insert notification
        $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, "Wallet rechargé", "Votre recharge de " . number_format($amount, 0, '', ' ') . " FCFA via $method a été confirmée avec succès.", 'fa-wallet']);

        echo json_encode(['status' => 'success']);
        break;

    case 'p2p_transfer':
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }

        $receiverPhone = trim($data['receiver_phone'] ?? '');
        $amount        = (float)($data['amount'] ?? 0);

        if (!$receiverPhone || $amount <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Données de transfert invalides.']);
            exit;
        }

        // Check if receiver exists
        $stmt = $pdo->prepare("SELECT id, name FROM users WHERE phone = ?");
        $stmt->execute([$receiverPhone]);
        $receiver = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$receiver) {
            echo json_encode(['status' => 'error', 'message' => 'Utilisateur introuvable.']);
            exit;
        }

        if ($receiver['id'] == $userId) {
            echo json_encode(['status' => 'error', 'message' => 'Vous ne pouvez pas vous envoyer de l\'argent à vous-même.']);
            exit;
        }

        // Check sender balance
        $stmt = $pdo->prepare("SELECT name, phone, balance FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $sender = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$sender || $sender['balance'] < $amount) {
            echo json_encode(['status' => 'error', 'message' => 'Solde insuffisant.']);
            exit;
        }

        // Transaction (ACID)
        try {
            $pdo->beginTransaction();

            // Deduct sender
            $stmt = $pdo->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
            $stmt->execute([$amount, $userId]);

            // Credit receiver
            $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
            $stmt->execute([$amount, $receiver['id']]);

            $txIdSender = 'TX-P2P-' . rand(100000, 999999);
            $txIdReceiver = 'TX-P2P-' . rand(100000, 999999);

            $date = getFormattedDateTime();

            // Sender tx
            $stmt = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, 'P2P', ?, ?, 'p2p_sent', 'Confirmée')");
            $stmt->execute([$txIdSender, $userId, "Envoi vers " . $receiver['name'], -$amount, $date]);

            // Receiver tx
            $stmt = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, 'P2P', ?, ?, 'p2p_received', 'Confirmée')");
            $stmt->execute([$txIdReceiver, $receiver['id'], "Reçu de " . $sender['name'], $amount, $date]);
            
            $pdo->commit();

            // Sender notification
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $userId,
                "Transfert P2P envoyé",
                "Vous avez envoyé " . number_format($amount, 0, '', ' ') . " FCFA au numéro $receiverPhone (" . $receiver['name'] . ").",
                'fa-paper-plane'
            ]);

            // Receiver notification
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $receiver['id'],
                "Transfert P2P reçu",
                "Vous avez reçu " . number_format($amount, 0, '', ' ') . " FCFA de la part de " . $sender['name'] . " (" . $sender['phone'] . ").",
                'fa-wallet'
            ]);

            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors du transfert.']);
        }
        break;

    // -----------------------------------------------------------------------
    // Universal service order (replaces quick_order and link_order)
    // -----------------------------------------------------------------------
    case 'service_order':
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }

        $serviceName   = trim($data['service']          ?? '');
        $plan          = trim($data['plan']             ?? '');
        $priceClient   = (float)($data['price']         ?? 0);
        $accountEmail  = trim($data['account_email']    ?? '');
        $accountPass   = trim($data['account_password'] ?? '');
        $isNewAccount  = (int)($data['is_new_account']  ?? 0);
        $productUrl    = trim($data['product_url']      ?? '');
        $productVariant = trim($data['product_variant'] ?? '');
        $deliveryAddress = is_array($data['delivery_address'] ?? null)
            ? json_encode($data['delivery_address'], JSON_UNESCAPED_UNICODE)
            : trim($data['delivery_address'] ?? '');
        $orderDetails  = is_array($data['order_details'] ?? null)
            ? json_encode($data['order_details'], JSON_UNESCAPED_UNICODE)
            : trim($data['order_details'] ?? '');

        // Validate service exists in catalog
        global $SERVICE_CATALOG;
        if (!isset($SERVICE_CATALOG[$serviceName])) {
            echo json_encode(['status' => 'error', 'message' => 'Service inconnu.']);
            exit;
        }

        $catalog     = $SERVICE_CATALOG[$serviceName];
        $category    = $catalog['category'];
        $marginType  = $catalog['margin_type'] ?? 'flat';

        // ── Calculate validated price & margin ──────────────────────────────
        if ($category !== 'ecommerce') {
            // Flat-margin service: validate plan against catalog
            if (!isset($catalog['plans'][$plan])) {
                echo json_encode(['status' => 'error', 'message' => 'Forfait invalide pour ce service.']);
                exit;
            }
            $flatMargin  = (int)($catalog['margin'] ?? 1500);
            $planCost    = (int)$catalog['plans'][$plan];
            $priceClient = $planCost + $flatMargin;   // always use server price
            $margin      = $flatMargin;

        } else {
            // Percentage-margin service: $priceClient is the RAW PRODUCT PRICE entered by user
            $productPrice = (float)($data['price'] ?? 0);
            if ($productPrice <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Prix produit invalide.']);
                exit;
            }
            $marginPct   = (float)($catalog['margin_pct'] ?? 0.10);
            $margin      = (int)round($productPrice * $marginPct);
            $priceClient = $productPrice + $margin;   // total client pays
        }

        if ($priceClient <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Montant invalide.']);
            exit;
        }

        // Check balance
        $stmt = $pdo->prepare("SELECT balance, name, phone FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $user['balance'] < $priceClient) {
            echo json_encode(['status' => 'error', 'message' => 'Solde insuffisant dans votre Wallet.']);
            exit;
        }

        // Deduct balance
        $stmt = $pdo->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
        $stmt->execute([$priceClient, $userId]);

        // Transaction label
        $txTitle = $serviceName . ($plan ? " $plan" : '');
        if ($category === 'ecommerce') {
            $txTitle = "Commande $serviceName";
        }

        $isAutomatable = in_array($category, ['streaming', 'gaming', 'other']) ? 1 : 0;
        $orderStatus = $isAutomatable ? 'Validée' : 'En traitement';
        $txStatus = $isAutomatable ? 'Confirmée' : 'En attente';

        // Insert transaction
        $txId = 'TX-' . rand(100000, 999999);
        $stmt = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, ?, ?, ?, 'payment', ?)");
        $stmt->execute([$txId, $userId, $txTitle, $serviceName, -$priceClient, getFormattedDateTime(), $txStatus]);

        // Generate VCC
        $vcc = simulateVCCGeneration();

        // Insert order with all details
        $orderId    = 'CMD-' . getFormattedDateCode() . '-' . rand(100, 999);
        $orderLabel = $serviceName . ($plan ? " $plan" : '');

        $stmt = $pdo->prepare("
            INSERT INTO orders 
                (id, user_id, client, phone, service, category, price, margin, status, date,
                 account_email, account_password, is_new_account, plan, product_url, product_variant,
                 delivery_address, order_details, vcc_number, vcc_cvv, vcc_exp, vcc_provider, is_automatable)
            VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                 ?, ?, ?, ?, ?, ?,
                 ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $orderId, $userId, $user['name'], $user['phone'],
            $orderLabel, $category, $priceClient, $margin,
            $orderStatus, getFormattedDateShort(),
            $accountEmail, $accountPass, $isNewAccount, $plan,
            $productUrl, $productVariant,
            $deliveryAddress, $orderDetails,
            $vcc['number'], $vcc['cvv'], $vcc['exp'], $vcc['provider'], $isAutomatable
        ]);

        // Insert notification
        if ($isAutomatable) {
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, "Abonnement activé", "Votre commande pour $orderLabel a été traitée et validée automatiquement.", 'fa-bolt']);
        } else {
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, "Commande enregistrée", "Votre commande pour $orderLabel ($orderId) a été enregistrée et est en cours de traitement.", 'fa-box']);
        }

        echo json_encode(['status' => 'success', 'order_id' => $orderId]);
        break;

    // Legacy compatibility
    case 'quick_order':
    case 'link_order':
        echo json_encode(['status' => 'error', 'message' => 'Veuillez utiliser service_order.']);
        break;

    // -----------------------------------------------------------------------
    // Admin: Get Users
    // -----------------------------------------------------------------------
    case 'admin_get_users':
        $stmt = $pdo->query("SELECT id, name, phone, balance, created_at, referral_code FROM users ORDER BY created_at DESC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'users' => $users]);
        break;

    // -----------------------------------------------------------------------
    // Admin: Get Transactions
    // -----------------------------------------------------------------------
    case 'admin_get_transactions':
        $stmt = $pdo->query("
            SELECT t.*, u.name as user_name 
            FROM transactions t 
            LEFT JOIN users u ON t.user_id = u.id 
            ORDER BY t.created_at DESC
        ");
        $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'transactions' => $transactions]);
        break;

    // -----------------------------------------------------------------------
    // Admin: Update Wallet
    // -----------------------------------------------------------------------
    case 'admin_update_wallet':
        $userId = $data['user_id'] ?? '';
        $amount = floatval($data['amount'] ?? 0);
        $reason = $data['reason'] ?? 'Recharge manuelle (Admin)';

        if (!$userId || $amount <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Paramètres invalides.']);
            exit;
        }

        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
            $stmt->execute([$amount, $userId]);

            $txId = 'TX-' . rand(100000, 999999);
            $stmt = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, ?, ?, ?, 'deposit', 'Confirmée')");
            $stmt->execute([$txId, $userId, $reason, 'Admin', $amount, getFormattedDateTime()]);

            $notifMsg = "Votre compte a été rechargé de " . number_format($amount, 0, ',', ' ') . " FCFA.";
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, 'Recharge Wallet', $notifMsg, 'fa-wallet']);

            $pdo->commit();
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la recharge.']);
        }
        break;

    // -----------------------------------------------------------------------
    // Admin: Update Order Status Manually
    // -----------------------------------------------------------------------
    case 'admin_update_order_status':
        $orderId = trim($data['order_id'] ?? '');
        $status = trim($data['status'] ?? '');
        $email = trim($data['account_email'] ?? '');
        $password = trim($data['account_password'] ?? '');

        if (!$orderId || !$status) {
            echo json_encode(['status' => 'error', 'message' => 'Paramètres manquants.']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE orders SET status = ?, account_email = ?, account_password = ? WHERE id = ?");
        $stmt->execute([$status, $email, $password, $orderId]);

        $stmt = $pdo->prepare("SELECT user_id, service FROM orders WHERE id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order && $order['user_id']) {
            $msg = "Votre commande {$order['service']} est maintenant: {$status}.";
            if ($status === 'Livré' || $status === 'Livrée' || $status === 'Terminée') {
                $msg = "Votre commande {$order['service']} a été livrée ! Vos accès sont disponibles dans les détails de la commande.";
            }
            $notifStmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $notifStmt->execute([$order['user_id'], 'Mise à jour Commande', $msg, 'fa-box-open']);
        }

        echo json_encode(['status' => 'success']);
        break;

    // -----------------------------------------------------------------------
    // Admin: update tracking number
    // -----------------------------------------------------------------------
    case 'admin_update_tracking':
        $orderId        = trim($data['order_id']        ?? '');
        $trackingNumber = trim($data['tracking_number'] ?? '');

        if (!$orderId) {
            echo json_encode(['status' => 'error', 'message' => 'ID commande manquant.']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE orders SET tracking_number = ? WHERE id = ?");
        $stmt->execute([$trackingNumber, $orderId]);

        // Send user notification
        $stmt = $pdo->prepare("SELECT user_id, service FROM orders WHERE id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($order && $order['user_id']) {
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $order['user_id'],
                "Numéro de suivi mis à jour",
                "Le numéro de suivi de votre commande " . $order['service'] . " a été mis à jour : " . $trackingNumber . ".",
                'fa-truck'
            ]);
        }

        echo json_encode(['status' => 'success']);
        break;

    // -----------------------------------------------------------------------
    // Admin: get all data (enriched)
    // -----------------------------------------------------------------------
    case 'admin_get_data':
        $stmt = $pdo->query("SELECT COUNT(*) FROM orders");
        $totalOrders = $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) FROM orders WHERE status IN ('En traitement', 'Reçue')");
        $processingOrders = $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) FROM orders WHERE status IN ('Validée', 'Terminée')");
        $validatedOrders = $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT SUM(price) FROM orders");
        $totalReceived = $stmt->fetchColumn() ?: 0.00;

        $stmt = $pdo->query("SELECT SUM(margin) FROM orders WHERE status IN ('Validée','Terminée')");
        $totalMargin = $stmt->fetchColumn() ?: 0.00;

        // Fetch all orders with full details
        $stmt = $pdo->query("
            SELECT 
                id, client, phone, service, category, price, margin, status, date,
                account_email, account_password, is_new_account, plan,
                product_url, product_variant, delivery_address, tracking_number, order_details,
                vcc_number, vcc_cvv, vcc_exp, vcc_provider, is_automatable,
                created_at
            FROM orders 
            ORDER BY created_at DESC
        ");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Alerts for pending orders
        $alerts = [];
        foreach ($orders as $o) {
            if (in_array($o['status'], ['En traitement', 'Reçue'])) {
                $alerts[] = [
                    'title'      => 'Nouvelle commande',
                    'subtitle'   => $o['client'] . ' — ' . $o['service'],
                    'time'       => $o['date'],
                    'icon'       => 'fa-solid fa-box',
                    'colorClass' => 'bg-warning',
                ];
            }
        }

        echo json_encode([
            'status' => 'success',
            'stats'  => [
                'total_orders'      => $totalOrders,
                'processing_orders' => $processingOrders,
                'validated_orders'  => $validatedOrders,
                'total_received'    => (float)$totalReceived,
                'total_margin'      => (float)$totalMargin,
            ],
            'orders' => $orders,
            'alerts' => array_slice($alerts, 0, 5),
        ]);
        break;

    case 'admin_validate_order':
        $orderId = trim($data['order_id'] ?? '');
        if (!$orderId) {
            echo json_encode(['status' => 'error', 'message' => 'ID de commande invalide.']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT user_id, service FROM orders WHERE id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            echo json_encode(['status' => 'error', 'message' => 'Commande introuvable.']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE orders SET status = 'Validée' WHERE id = ?");
        $stmt->execute([$orderId]);

        if ($order['user_id']) {
            $txId        = 'TX-' . rand(100000, 999999);
            $serviceName = explode(' ', $order['service'])[0];
            $stmt        = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, ?, 0.00, ?, 'info', 'Confirmée')");
            $stmt->execute([$txId, $order['user_id'], "Confirmation: " . $order['service'], $serviceName, getFormattedDateTime()]);

            // Send notification
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([$order['user_id'], "Commande validée", "Votre commande pour " . $order['service'] . " a été validée avec succès.", 'fa-circle-check']);
        }

        echo json_encode(['status' => 'success']);
        break;

    // -----------------------------------------------------------------------
    // Admin: Refuse order + Auto Refund
    // -----------------------------------------------------------------------
    case 'admin_refuse_order':
        $orderId = trim($data['order_id'] ?? '');
        $reason  = trim($data['reason'] ?? 'Commande refusée');
        if (!$orderId) {
            echo json_encode(['status' => 'error', 'message' => 'ID de commande invalide.']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT user_id, service, price, status FROM orders WHERE id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            echo json_encode(['status' => 'error', 'message' => 'Commande introuvable.']);
            exit;
        }

        // Only refund if the order was paid (not already refused/refunded)
        if (in_array($order['status'], ['Refusée', 'Remboursée', 'Annulée'])) {
            echo json_encode(['status' => 'error', 'message' => 'Commande déjà refusée ou remboursée.']);
            exit;
        }

        // Update order status
        $stmt = $pdo->prepare("UPDATE orders SET status = 'Refusée' WHERE id = ?");
        $stmt->execute([$orderId]);

        // Auto-refund if order was linked to a user
        if ($order['user_id'] && $order['price'] > 0) {
            $refundAmount = (float) $order['price'];

            // Credit wallet
            $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
            $stmt->execute([$refundAmount, $order['user_id']]);

            // Create refund transaction
            $txId        = 'TX-REF-' . rand(100000, 999999);
            $serviceName = explode(' ', $order['service'])[0];
            $stmt = $pdo->prepare("INSERT INTO transactions (id, user_id, title, service, amount, date, type, status) VALUES (?, ?, ?, ?, ?, ?, 'remboursement', 'Confirmée')");
            $stmt->execute([
                $txId,
                $order['user_id'],
                'Remboursement : ' . $order['service'],
                $serviceName,
                $refundAmount,
                getFormattedDateTime()
            ]);
        }

        // Send user notification
        if ($order['user_id']) {
            $refundAmount = (float) $order['price'];
            $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message, icon) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $order['user_id'],
                "Commande refusée",
                "Votre commande pour " . $order['service'] . " a été refusée. Raison : " . $reason . "." . ($refundAmount > 0 ? " Un montant de " . number_format($refundAmount, 0, '', ' ') . " FCFA a été recrédité sur votre wallet." : ""),
                'fa-circle-xmark'
            ]);
        }

        echo json_encode(['status' => 'success', 'refunded' => ($order['user_id'] && $order['price'] > 0), 'amount' => (float)$order['price']]);
        break;

    // -----------------------------------------------------------------------
    // Smart Scraper (Link Preview)
    // -----------------------------------------------------------------------
    case 'link_preview':
        $url = trim($data['url'] ?? '');
        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            echo json_encode(['status' => 'error', 'message' => 'Lien invalide.']);
            exit;
        }

        $title = '';
        $image = '';
        $price = 0;

        // --- INTELLIGENT ROUTING BASED ON DOMAIN ---
        if (strpos(strtolower($url), 'shein') !== false) {
            // It's a Shein link, try to extract goods_id
            $goods_id = null;
            if (preg_match('/-p-(\d+)/', $url, $matches)) {
                $goods_id = $matches[1];
            } elseif (preg_match('/goods_id=(\d+)/', $url, $matches)) {
                $goods_id = $matches[1];
            }

            if ($goods_id) {
                $apiUrl = "https://shein-scraper-api.p.rapidapi.com/shein/product/details?goods_id={$goods_id}&currency=usd&country=us&language=en";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "x-rapidapi-host: shein-scraper-api.p.rapidapi.com",
                    "x-rapidapi-key: 51ee46602bmsh0f8da79431bcb8bp1cea97jsn6ca59358039d"
                ]);
                $apiResponse = curl_exec($ch);
                curl_close($ch);

                if ($apiResponse) {
                    $json = json_decode($apiResponse, true);
                    if (isset($json['info'])) {
                        $title = $json['info']['goods_name'] ?? '';
                        $image = $json['info']['goods_img'] ?? '';
                        if (isset($json['info']['retailPrice']['amount'])) {
                            $price = (float) $json['info']['retailPrice']['amount'];
                        }
                    }
                }
            }
        } elseif (strpos(strtolower($url), 'amazon') !== false || strpos(strtolower($url), 'amzn') !== false) {
            // It's an Amazon link, try to extract ASIN (10 uppercase letters/numbers)
            $asin = null;
            if (preg_match('/(?:dp|gp\/product|ASIN|\/p)\/([a-zA-Z0-9]{10})/i', $url, $matches)) {
                $asin = $matches[1];
            }

            if ($asin) {
                $apiUrl = "https://amazon-e-commerce-scraper.p.rapidapi.com/products/{$asin}?api_key=b3524885fbea51094a54ce3577ed2e58";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "x-rapidapi-host: amazon-e-commerce-scraper.p.rapidapi.com",
                    "x-rapidapi-key: 51ee46602bmsh0f8da79431bcb8bp1cea97jsn6ca59358039d"
                ]);
                $apiResponse = curl_exec($ch);
                curl_close($ch);

                if ($apiResponse) {
                    $json = json_decode($apiResponse, true);
                    // Sappy Amazon Scraper generally returns { "title": "...", "price": 12.99, "image": "...", "images": [...] } or similar
                    if (isset($json['title'])) $title = $json['title'];
                    elseif (isset($json['name'])) $title = $json['name'];
                    elseif (isset($json['product']['title'])) $title = $json['product']['title'];

                    if (isset($json['image'])) $image = $json['image'];
                    elseif (isset($json['images'][0])) $image = $json['images'][0];
                    elseif (isset($json['main_image'])) $image = $json['main_image'];

                    if (isset($json['price'])) {
                        $p = $json['price'];
                        if (is_array($p) && isset($p['current_price'])) {
                            $price = (float) $p['current_price'];
                        } elseif (is_numeric($p)) {
                            $price = (float) $p;
                        } else {
                            $price = (float) preg_replace('/[^0-9.]/', '', $p);
                        }
                    } elseif (isset($json['current_price'])) {
                        $price = (float) $json['current_price'];
                    }
                }
            }
        } elseif (strpos(strtolower($url), 'aliexpress') !== false || strpos(strtolower($url), 'ali') !== false) {
            // It's an AliExpress link, try to extract itemId
            $itemId = null;
            if (preg_match('/item\/(\d+)\.html/i', $url, $matches)) {
                $itemId = $matches[1];
            } elseif (preg_match('/(\d+)\.html/i', $url, $matches)) {
                $itemId = $matches[1];
            } elseif (preg_match('/id=(\d+)/i', $url, $matches)) {
                $itemId = $matches[1];
            }

            if ($itemId) {
                $apiUrl = "https://alibaba-datahub.p.rapidapi.com/item_sku?itemId={$itemId}";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "x-rapidapi-host: alibaba-datahub.p.rapidapi.com",
                    "x-rapidapi-key: 51ee46602bmsh0f8da79431bcb8bp1cea97jsn6ca59358039d"
                ]);
                $apiResponse = curl_exec($ch);
                curl_close($ch);

                if ($apiResponse) {
                    $json = json_decode($apiResponse, true);
                    if (isset($json['result']['item'])) {
                        $item = $json['result']['item'];
                        if (isset($item['title'])) $title = $item['title'];
                        if (isset($item['images'][0])) $image = $item['images'][0];
                        if (isset($item['sku']['def']['price'])) {
                            $price = (float) $item['sku']['def']['price'];
                        } elseif (isset($item['sku']['base']['price'])) {
                            $price = (float) $item['sku']['base']['price'];
                        }
                    }
                }
            }
        }

        // --- FALLBACK TO BASIC SCRAPING ---
        if (!$title && !$price) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36');
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            $html = curl_exec($ch);
            curl_close($ch);

            if ($html) {
                libxml_use_internal_errors(true);
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                $xpath = new DOMXPath($doc);

                $nodes = $xpath->query('//meta[@property="og:title"]/@content');
                if ($nodes->length > 0) $title = $nodes->item(0)->nodeValue;
                if (!$title) {
                    $nodes = $xpath->query('//title');
                    if ($nodes->length > 0) $title = $nodes->item(0)->nodeValue;
                }

                $nodes = $xpath->query('//meta[@property="og:image"]/@content');
                if ($nodes->length > 0) $image = $nodes->item(0)->nodeValue;

                $nodes = $xpath->query('//meta[@property="product:price:amount"]/@content');
                if ($nodes->length > 0) $price = (float) $nodes->item(0)->nodeValue;
            }
        }

        echo json_encode([
            'status' => 'success',
            'title'  => $title ?: 'Produit E-commerce',
            'image'  => $image,
            'price'  => $price
        ]);
        break;

    // -----------------------------------------------------------------------
    // Get live USD→XOF exchange rate (cached 1h in DB settings table)
    // -----------------------------------------------------------------------
    case 'get_rate':
        // Ensure settings table exists
        $pdo->exec("CREATE TABLE IF NOT EXISTS `settings` (
            `key` VARCHAR(50) PRIMARY KEY,
            `value` TEXT NOT NULL,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB");

        // Check cache
        $stmt = $pdo->prepare("SELECT value, updated_at FROM settings WHERE `key` = 'usd_xof_rate'");
        $stmt->execute();
        $cached = $stmt->fetch(PDO::FETCH_ASSOC);

        $rate = null;
        $source = 'cache';

        if ($cached) {
            $age = time() - strtotime($cached['updated_at']);
            if ($age < 3600) { // 1 hour cache
                $rate = (float) $cached['value'];
            }
        }

        if (!$rate) {
            // Fetch fresh rate
            $ctx = stream_context_create(['http' => ['timeout' => 5]]);
            $json = @file_get_contents('https://open.er-api.com/v6/latest/USD', false, $ctx);
            if ($json) {
                $rateData = json_decode($json, true);
                if (isset($rateData['rates']['XOF'])) {
                    $rate = (float) $rateData['rates']['XOF'];
                    // Store in cache
                    $stmt = $pdo->prepare("REPLACE INTO settings (`key`, value) VALUES ('usd_xof_rate', ?)");
                    $stmt->execute([$rate]);
                    $source = 'live';
                }
            }
            // Fallback if API fails
            if (!$rate) {
                $rate = 600; // approximate fallback 1 USD ≈ 600 XOF
                $source = 'fallback';
            }
        }

        // Apply 3% buffer
        $rateWithBuffer = round($rate * 1.03, 2);

        echo json_encode([
            'status' => 'success',
            'rate_raw' => $rate,
            'rate_buffered' => $rateWithBuffer,
            'source' => $source,
            'currency' => 'XOF',
        ]);
        break;

    case 'upload_avatar':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }
        if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'upload du fichier.']);
            exit;
        }
        $file = $_FILES['avatar'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (!in_array($ext, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Format de fichier non autorisé.']);
            exit;
        }
        if ($file['size'] > 5 * 1024 * 1024) {
            echo json_encode(['status' => 'error', 'message' => 'Fichier trop lourd (max 5 Mo).']);
            exit;
        }
        
        $filename = 'user_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;
        $destPath = __DIR__ . '/assets/avatars/' . $filename;
        if (move_uploaded_file($file['tmp_name'], $destPath)) {
            $avatarUrl = 'assets/avatars/' . $filename;
            $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
            $stmt->execute([$avatarUrl, $_SESSION['user_id']]);
            
            $_SESSION['user_data']['avatar'] = $avatarUrl;
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Photo de profil mise à jour.',
                'avatarUrl' => $avatarUrl
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la sauvegarde du fichier.']);
        }
        break;

    case 'update_profile':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }
        $name = isset($data['name']) ? trim($data['name']) : '';
        if (!$name) {
            echo json_encode(['status' => 'error', 'message' => 'Le nom est requis.']);
            exit;
        }
        $stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
        $stmt->execute([$name, $_SESSION['user_id']]);
        
        $_SESSION['user_data']['name'] = $name;
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Profil mis à jour.',
            'name' => $name
        ]);
        break;

    case 'change_password':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }
        $currentPass = isset($data['current_password']) ? $data['current_password'] : '';
        $newPass = isset($data['new_password']) ? $data['new_password'] : '';
        
        if (strlen($newPass) < 6) {
            echo json_encode(['status' => 'error', 'message' => 'Le nouveau mot de passe doit contenir au moins 6 caractères.']);
            exit;
        }
        
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        if (!password_verify($currentPass, $user['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Mot de passe actuel incorrect.']);
            exit;
        }
        
        $hash = password_hash($newPass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hash, $_SESSION['user_id']]);
        
        echo json_encode(['status' => 'success', 'message' => 'Mot de passe modifié avec succès.']);
        break;

    case 'get_notifications':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }
        $stmt = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 30");
        $stmt->execute([$_SESSION['user_id']]);
        $notifs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return count of unread as well
        $unreadStmt = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
        $unreadStmt->execute([$_SESSION['user_id']]);
        $unreadCount = $unreadStmt->fetchColumn();

        echo json_encode([
            'status' => 'success',
            'notifications' => $notifs,
            'unreadCount' => $unreadCount
        ]);
        break;

    case 'mark_notifications_read':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Non authentifié.']);
            exit;
        }
        $stmt = $pdo->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ? AND is_read = 0");
        $stmt->execute([$_SESSION['user_id']]);
        echo json_encode(['status' => 'success']);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Action non supportée.']);
        break;
}
