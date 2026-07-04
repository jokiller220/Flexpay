<?php
$im = imagecreatefrompng('c:/MAMP/htdocs/solva/flexpay/assets/images/photoaccuielle.png');
$rgb = imagecolorat($im, 0, 0);
$colors = imagecolorsforindex($im, $rgb);
printf('#%02x%02x%02x', $colors['red'], $colors['green'], $colors['blue']);
?>
