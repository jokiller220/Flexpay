<?php
// index.php - Fully Responsive PWA Client SPA
session_start();

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, interactive-widget=resizes-content">
    <title>FlexPay</title>
    <link rel="manifest" href="<?php echo $basePath; ?>manifest.json">
    <link rel="icon" type="image/png" href="<?php echo $basePath; ?>assets/images/newicone_v3.png">
    <link rel="apple-touch-icon" href="<?php echo $basePath; ?>assets/images/newicone_v3.png">
    <meta name="theme-color" content="#0B1021">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <style id="startup-bg">
        html, body {
            background-color: #0A0A1A !important;
        }
    </style>
    <!-- Google Fonts: Inter -->
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/mobile.css?v=<?php echo @filemtime(__DIR__ . '/assets/css/mobile.css'); ?>">
    <!-- Preload main logo for instant rendering -->
    <link rel="preload" as="image" href="<?php echo $basePath; ?>assets/images/logosolo.png">
</head>
<body>
    <div id="app-container">
        
        <!-- ==================== DESKTOP TOP HEADER NAVIGATION ==================== -->
        <?php include 'components/desktop-header.php'; ?>
        

        <!-- ==================== ONBOARDING VIEWS ==================== -->
        
        <!-- 1. Splash Screen -->
        <?php include 'views/splash.php'; ?>
        
        <!-- 2. Login Screen -->
        <?php include 'views/login.php'; ?>

        <!-- 3. Register Screen -->
        <?php include 'views/register.php'; ?>

        <!-- 4. OTP Screen -->
        <?php include 'views/otp.php'; ?>

        <!-- ==================== CLIENT MAIN APP TABS ==================== -->

        <!-- 5. Home Tab -->
        <?php include 'views/home.php'; ?>

        <!-- 6. Orders Tracking Tab -->
        <?php include 'views/orders.php'; ?>

        <!-- 7. Wallet Tab -->
        <?php include 'views/wallet.php'; ?>

        <!-- 8. Profile Tab -->
        <?php include 'views/profile.php'; ?>

        <!-- 9. All Services Tab -->
        <?php include 'views/services.php'; ?>

        <!-- 10. Notifications Tab -->
        <?php include 'views/notifications.php'; ?>

        <!-- ==================== SUB-VIEWS (ORDER FLOWS) ==================== -->

        <!-- Universal Multi-Step Order Form -->
        <?php include 'views/order-form.php'; ?>

        <!-- ==================== RECHARGE FULL PAGE VIEW ==================== -->
        <?php include 'views/recharge.php'; ?>

        <!-- ==================== P2P VIEW ==================== -->
        <?php include 'views/p2p.php'; ?>
        
        <!-- ==================== PROFILE SUB-PAGES ==================== -->
        <?php include 'views/personal-info.php'; ?>
        <?php include 'views/security.php'; ?>
        <?php include 'views/support.php'; ?>
        <?php include 'views/about.php'; ?>

        <!-- ==================== DESKTOP TOP NAV ==================== -->
        <?php include 'components/bottom-nav.php'; ?>
        

    </div>

    <!-- Main JS Application Logic -->
    
    <script>window.BASE_PATH = "<?php echo $basePath; ?>";</script>
    <script src="<?php echo $basePath; ?>assets/js/app.js?v=<?php echo filemtime(__DIR__ . '/assets/js/app.js'); ?>"></script>
    
</body>
</html>
