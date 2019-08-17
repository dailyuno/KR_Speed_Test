<?php
header('Content-type: image/png');
$im = imagecreatetruecolor(400, 350);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$font = './fonts/calibri.ttf';
$fontb = './fonts/calibrib.ttf';

imagefill($im, 0, 0, $white);
imagettftext($im, 20, 0, 70, 50, $black, $fontb, 'What We Ate Yesterday');

$items = [
    [
        'name' => 'Meat',
        'per' => 43,
        'color' => imagecolorallocate($im, 33,  150, 243)
    ],
    [
        'name' => 'Ice Cream',
        'per' => 29,
        'color' => imagecolorallocate($im, 244, 67, 54)
    ],
    [
        'name' => 'Vegetables',
        'per' => 14,
        'color' => imagecolorallocate($im, 139, 195, 74)
    ],
    [
        'name' => 'Bread',
        'per' => 14,
        'color' => imagecolorallocate($im, 103, 58, 183)
    ]
];
$lastAngle = -90;
$x = 150;
$y = 200;
$pw = 200;
$ph = 200;
$lastY = 100;

foreach ($items as $item) {
    $angle = ($item['per'] / 100) * 360;

    imagefilledarc($im, $x, $y, $pw, $ph, $lastAngle, $lastAngle + $angle, $item['color'], IMG_ARC_PIE);

    $labelX = $x + cos(deg2rad($lastAngle * 2 + $angle) / 2) * $pw * 0.35 - 6;
    $labelY = $y + sin(deg2rad($lastAngle * 2 + $angle) / 2) * $ph * 0.35 + 4;
    imagettftext($im, 12, 0, $labelX, $labelY, $black, $fontb, $item['per'] . '%');
    imagefilledrectangle($im, 280, $lastY + 30, 290, $lastY + 40, $item['color']);
    imagettftext($im, 12, 0, 300, $lastY += 40, $black, $fontb, $item['name']);

    $lastAngle += $angle;
}

imagepng($im);
imagedestroy($im);