<?php
$context = stream_context_create([
    'http' => [
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36\r\n"
    ]
]);

$logos = [
    'netflix.svg' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Netflix_2015_N_logo.svg',
    'spotify.svg' => 'https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg',
    'canalplus.svg' => 'https://upload.wikimedia.org/wikipedia/commons/2/25/Canal%2B_logo.svg',
    'amazon.svg' => 'https://upload.wikimedia.org/wikipedia/commons/4/4a/Amazon_icon.svg',
    'disneyplus.svg' => 'https://upload.wikimedia.org/wikipedia/commons/3/3e/Disney%2B_logo.svg',
    'applemusic.svg' => 'https://upload.wikimedia.org/wikipedia/commons/d/d4/Apple_Music_logo.svg',
    'shein.png' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/17/Shein_logo.svg/512px-Shein_logo.svg.png',
    'aliexpress.svg' => 'https://upload.wikimedia.org/wikipedia/commons/a/ae/AliExpress_logo.svg'
];

@mkdir(__DIR__ . '/assets/logos', 0777, true);

foreach($logos as $file => $url) {
    echo "Downloading $file...\n";
    $content = file_get_contents($url, false, $context);
    if ($content) {
        file_put_contents(__DIR__ . '/assets/logos/' . $file, $content);
    } else {
        echo "Failed to download $file\n";
    }
}
echo "Done!\n";
