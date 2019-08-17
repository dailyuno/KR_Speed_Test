<?php

session_start();
header('Content-type: image/png');
$im = imagecreatetruecolor(250, 100);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 10, 50, 128);
$text = substr(md5(rand()), 0, 6);
imagefill($im, 0, 0, $white);
imagettftext($im, 36, 0, 55, 65, $black, './fonts/calibrib.ttf', $text);

for ($i = 0; $i < 30; $i++) {
    $x1 = mt_rand(0, 245);
    $y1 = mt_rand(0, 95);
    $x2 = mt_rand(($x1 + 5), 250);
    $y2 = mt_rand(($y1 + 5), 100);
    imageline($im, $x1, $y1, $x2, $y2, $black);
}
$_SESSION['code'] = $text;
imagepng($im);
imagedestroy($im);