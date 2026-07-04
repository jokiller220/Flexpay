<?php
$key = '51ee46602bmsh0f8da79431bcb8bp1cea97jsn6ca59358039d';

echo "Testing Shein...\n";
$goods_id = '16477544';
$apiUrl = "https://shein-scraper-api.p.rapidapi.com/shein/product/details?goods_id={$goods_id}&currency=usd&country=us&language=en";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-rapidapi-host: shein-scraper-api.p.rapidapi.com",
    "x-rapidapi-key: $key"
]);
$res = curl_exec($ch);
if(curl_error($ch)) echo "Curl Error: " . curl_error($ch) . "\n";
curl_close($ch);
echo "Shein Response: " . substr($res, 0, 500) . "\n\n";

echo "Testing Amazon...\n";
$asin = 'B09G9D8KRQ';
$apiUrl = "https://amazon-e-commerce-scraper.p.rapidapi.com/products/{$asin}?api_key=b3524885fbea51094a54ce3577ed2e58";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-rapidapi-host: amazon-e-commerce-scraper.p.rapidapi.com",
    "x-rapidapi-key: $key"
]);
$res = curl_exec($ch);
curl_close($ch);
echo "Amazon Response: " . substr($res, 0, 1000) . "\n\n";

echo "Testing AliExpress...\n";
$itemId = '1005001234567890';
$apiUrl = "https://alibaba-datahub.p.rapidapi.com/item_sku?itemId={$itemId}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-rapidapi-host: alibaba-datahub.p.rapidapi.com",
    "x-rapidapi-key: $key"
]);
$res = curl_exec($ch);
curl_close($ch);
echo "AliExpress Response: " . substr($res, 0, 500) . "\n\n";
