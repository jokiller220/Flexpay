<?php
require 'db.php';
$cols = $pdo->query('DESCRIBE users')->fetchAll(PDO::FETCH_ASSOC);
print_r($cols);
