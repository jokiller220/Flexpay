<?php
$data = ['action' => 'register', 'name' => 'John Doe', 'phone' => '07111222', 'password' => '1234', 'referral_code' => ''];
$ch = curl_init('http://127.0.0.1/solva/flexpay/api.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
echo curl_exec($ch);
