<?php
session_start();
header("Content-type: image/png");

$image = imagecreate(400, 100);

$back = imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));


$charsAuthorized = "abcdefghijklmnopqrstuvwxyz0123456789";
$charsAuthorized = str_shuffle($charsAuthorized);
$lengthCaptcha = rand(6, 8);
$captcha = substr($charsAuthorized, 0, $lengthCaptcha);
$_SESSION["captcha"] = $captcha;


$listOfFonts = glob("fonts/*.ttf");

$x = rand(30, 40);

for ($i = 0; $i < $lengthCaptcha; $i++) {

    $colors[] = imagecolorallocate($image, rand(150, 250), rand(150, 250), rand(150, 250));

    imagettftext($image, rand(20, 40), rand(-45, 45), $x, rand(35, 45), $colors[$i], $listOfFonts[array_rand($listOfFonts)], $captcha[$i]);

    $x += rand(40, 50);
}

$nbGeo = rand(4, 10);
for ($i = 0; $i <= $nbGeo; $i++) {

    $draw = rand(1, 3);
    switch ($draw) {
        case 1:
            imagerectangle($image, rand(0, 400), rand(0, 200), rand(0, 400), rand(0, 200), $colors[array_rand($colors)]);
            break;

        case 2:
            imageellipse($image, rand(0, 400), rand(0, 200), rand(0, 400), rand(0, 200), $colors[array_rand($colors)]);
            break;

        default:
            imageline($image, rand(0, 400), rand(0, 200), rand(0, 400), rand(0, 200), $colors[array_rand($colors)]);
            break;
    }

}

imagepng($image);