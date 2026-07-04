<?php
$logos = [
    'netflix.svg' => 'https://cdn.simpleicons.org/netflix/E50914',
    'spotify.svg' => 'https://cdn.simpleicons.org/spotify/1ED760',
    'amazon.svg' => 'https://cdn.simpleicons.org/amazon/FF9900',
    'aliexpress.svg' => 'https://cdn.simpleicons.org/aliexpress/FF4747',
    'disneyplus.svg' => 'https://cdn.simpleicons.org/disneyplus/113CCF',
    'applemusic.svg' => 'https://cdn.simpleicons.org/applemusic/FA243C',
    'shein.svg' => 'https://cdn.simpleicons.org/shein/000000'
];

@mkdir(__DIR__ . '/assets/logos', 0777, true);

foreach($logos as $file => $url) {
    echo "Downloading $file...\n";
    $content = @file_get_contents($url);
    if ($content) {
        file_put_contents(__DIR__ . '/assets/logos/' . $file, $content);
    } else {
        echo "Failed to download $file\n";
    }
}
echo "Done!\n";
