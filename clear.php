<?php
require 'db.php';
$pdo->exec('UPDATE users SET balance = 0');
$pdo->exec('DELETE FROM transactions');
$pdo->exec('DELETE FROM orders');
echo 'Database cleared!';
