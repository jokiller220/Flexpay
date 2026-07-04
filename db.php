<?php
// db.php - Database initialization and connection helper

$env_host = getenv('DB_HOST') ?: getenv('MYSQLHOST');
$env_port = getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: '3306';
$env_user = getenv('DB_USER') ?: getenv('MYSQLUSER');
$env_pass = getenv('DB_PASS') ?: getenv('MYSQLPASSWORD');
$env_name = getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'esgis_flexpay';

if ($env_host && $env_user) {
    $configs = [
        ['host' => $env_host, 'port' => $env_port, 'user' => $env_user, 'pass' => $env_pass],
    ];
} else {
    // Probe list of common MySQL configurations
    $configs = [
        ['host' => 'mysql-esgis.alwaysdata.net', 'port' => '3306', 'user' => 'esgis', 'pass' => 'panaSSi88@'], // AlwaysData
        ['host' => '127.0.0.1', 'port' => '3306', 'user' => 'root', 'pass' => 'root'], // MAMP default
        ['host' => '127.0.0.1', 'port' => '3306', 'user' => 'root', 'pass' => ''],     // XAMPP / standard default
        ['host' => 'localhost',  'port' => '3306', 'user' => 'root', 'pass' => 'root'],
        ['host' => 'localhost',  'port' => '3306', 'user' => 'root', 'pass' => ''],
        ['host' => '127.0.0.1', 'port' => '8889', 'user' => 'root', 'pass' => 'root'], // MAMP alternate
        ['host' => 'localhost',  'port' => '8889', 'user' => 'root', 'pass' => 'root'],
        ['host' => '127.0.0.1', 'port' => '3307', 'user' => 'root', 'pass' => 'root'],
        ['host' => 'localhost',  'port' => '3307', 'user' => 'root', 'pass' => 'root'],
    ];
}

$connected = false;
$pdo       = null;
$errorMsg  = "";

foreach ($configs as $cfg) {
    try {
        $h  = $cfg['host'];
        $p  = $cfg['port'];
        $u  = $cfg['user'];
        $pw = $cfg['pass'];

        $pdo = new PDO("mysql:host=$h;port=$p;charset=utf8mb4", $u, $pw);
        $connected = true;
        break;
    } catch (PDOException $e) {
        $errorMsg .= "Failed (host={$cfg['host']}, port={$cfg['port']}, user={$cfg['user']}): " . $e->getMessage() . "\n";
    }
}

if (!$connected) {
    die("Connection to MySQL failed. Tried multiple configurations:\n" . nl2br(htmlspecialchars($errorMsg)));
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// -----------------------------------------------------------------------
// Create / use database
// -----------------------------------------------------------------------
$pdo->exec("CREATE DATABASE IF NOT EXISTS `$env_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
$pdo->exec("USE `$env_name`;");

// -----------------------------------------------------------------------
// Tables
// -----------------------------------------------------------------------
$pdo->exec("
CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(100) NOT NULL,
    `phone`      VARCHAR(30)  NOT NULL UNIQUE,
    `password`   VARCHAR(255) NOT NULL,
    `avatar`     VARCHAR(255) NULL,
    `balance`    DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
");

$pdo->exec("
CREATE TABLE IF NOT EXISTS `orders` (
    `id`               VARCHAR(50)  PRIMARY KEY,
    `user_id`          INT          NULL,
    `client`           VARCHAR(100) NOT NULL,
    `phone`            VARCHAR(30)  NOT NULL,
    `service`          VARCHAR(100) NOT NULL,
    `category`         VARCHAR(50)  NOT NULL DEFAULT 'streaming',
    `price`            DECIMAL(12,2) NOT NULL,
    `margin`           DECIMAL(12,2) NOT NULL DEFAULT 2000.00,
    `status`           VARCHAR(50)  NOT NULL DEFAULT 'En traitement',
    `date`             VARCHAR(50)  NOT NULL,
    `account_email`    VARCHAR(150) NOT NULL DEFAULT '',
    `account_password` VARCHAR(255) NOT NULL DEFAULT '',
    `is_new_account`   TINYINT(1)   NOT NULL DEFAULT 0,
    `plan`             VARCHAR(100) NOT NULL DEFAULT '',
    `product_url`      TEXT,
    `product_variant`  VARCHAR(500) NOT NULL DEFAULT '',
    `delivery_address` TEXT,
    `tracking_number`  VARCHAR(100) NOT NULL DEFAULT '',
    `order_details`    TEXT,
    `vcc_number`       VARCHAR(20)  NOT NULL DEFAULT '',
    `vcc_cvv`          VARCHAR(10)  NOT NULL DEFAULT '',
    `vcc_exp`          VARCHAR(10)  NOT NULL DEFAULT '',
    `vcc_provider`     VARCHAR(50)  NOT NULL DEFAULT '',
    `is_automatable`   TINYINT(1)   NOT NULL DEFAULT 0,
    `created_at`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
");

$pdo->exec("
CREATE TABLE IF NOT EXISTS `transactions` (
    `id`         VARCHAR(50)  PRIMARY KEY,
    `user_id`    INT          NULL,
    `title`      VARCHAR(150) NOT NULL,
    `service`    VARCHAR(50)  NOT NULL,
    `amount`     DECIMAL(12,2) NOT NULL,
    `date`       VARCHAR(50)  NOT NULL,
    `type`       VARCHAR(50)  NOT NULL,
    `status`     VARCHAR(50)  NOT NULL DEFAULT 'Confirmée',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
");

// -----------------------------------------------------------------------
// Schema migrations — add new columns to existing orders table if missing
// -----------------------------------------------------------------------
$migrations = [
    "ALTER TABLE `orders` ADD COLUMN `category`         VARCHAR(50)  NOT NULL DEFAULT 'streaming'",
    "ALTER TABLE `orders` ADD COLUMN `margin`           DECIMAL(12,2) NOT NULL DEFAULT 2000.00",
    "ALTER TABLE `orders` ADD COLUMN `account_email`    VARCHAR(150) NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `account_password` VARCHAR(255) NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `is_new_account`   TINYINT(1)   NOT NULL DEFAULT 0",
    "ALTER TABLE `orders` ADD COLUMN `plan`             VARCHAR(100) NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `product_url`      TEXT",
    "ALTER TABLE `orders` ADD COLUMN `product_variant`  VARCHAR(500) NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `delivery_address` TEXT",
    "ALTER TABLE `orders` ADD COLUMN `tracking_number`  VARCHAR(100) NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `order_details`    TEXT",
    "ALTER TABLE `orders` ADD COLUMN `vcc_number`       VARCHAR(20)  NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `vcc_cvv`          VARCHAR(10)  NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `vcc_exp`          VARCHAR(10)  NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `vcc_provider`     VARCHAR(50)  NOT NULL DEFAULT ''",
    "ALTER TABLE `orders` ADD COLUMN `is_automatable`   TINYINT(1)   NOT NULL DEFAULT 0",
    "ALTER TABLE `users` ADD COLUMN `referral_code`     VARCHAR(20) UNIQUE NULL",
    "ALTER TABLE `users` ADD COLUMN `referred_by`       INT NULL",
    "CREATE TABLE IF NOT EXISTS `notifications` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT NOT NULL,
        `title` VARCHAR(255) NOT NULL,
        `message` TEXT NOT NULL,
        `icon` VARCHAR(50) DEFAULT 'fa-bell',
        `is_read` TINYINT(1) DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;"
];

foreach ($migrations as $sql) {
    try { $pdo->exec($sql); } catch (PDOException $e) { /* column already exists — ignore */ }
}

// -----------------------------------------------------------------------
// No mock data generated
// -----------------------------------------------------------------------

return $pdo;
