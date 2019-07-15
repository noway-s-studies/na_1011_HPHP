<?php
    // mire jo a GD: grafikonok, captcha, olyan infok kiirasara amit ne tudjanak "lelopni" (msn, email cim, arfolyam, tozsde)
    // start the session to store the variable
    session_start();
    $chars = 'abcdefghkmnprstuvwxyzABCDEFGHJKLMNPQRSTUV2345689';
    $length = 6;
    $code = '';
    for($i = 0; $i < $length; $i++){
        $pos = mt_rand(0, strlen($chars)-1);
        $code .= substr($chars, $pos, 1);
    }
    $_SESSION['captcha'] = $code;
    $width = 100;
    $height = 60;
    $r = mt_rand(160, 255);
    $g = mt_rand(160, 255);
    $b = mt_rand(160, 255);
    $image = imagecreate($width, $height);
    $background = imagecolorallocate($image, $r, $g, $b);
    $textcolor = imagecolorallocate($image, $r-128, $g-128, $b-128);
    imagefill($image, 0, 0, $background);
    // image, fontmeret, angle, x, y, color, font, szoveg
    imagettftext($image, 18, mt_rand(0, 25), 10, 55, $textcolor, "ttf/arial.ttf", $code);
    for($i=0;$i<8;$i++)
        imageline($image, 0, mt_rand(5, $height-5), $width, mt_rand(5, $height-5), $background);
    // prevent caching
    header('Expires: Tue, 08 Oct 1991 00:00:00 GMT');
    header('Cache-Control: no-cache, must-revalidate');
    // output the image
    header("Content-Type: image/gif");
    imagegif($image);
    imagedestroy($image);
?>