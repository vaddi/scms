<?php
###########################################################################################################################
# Captcha V.2.0 (C) 2003-2008 PA-S.de
# Weitergabe ohne ausdrückliche Genehmigung ist untersagt!
###########################################################################################################################
// ~~~~~~~~~~~~~~~~~
// ~ Einstellungen ~
// ~~~~~~~~~~~~~~~~~
//
// Fontverzeichnis (ohne / am Ende)
$fontdir = 'fonts';
// Breite
$breite = 155;
// Hoehe
$hohe = 40;
// Schriftgroesse
$size = 25;
// Fontdateien (mit Buchstaben)
$fonts_array[0] = array('refrig2.ttf', 'Xenowort.ttf');
// Fontdateien (mit Zahlen)
$fonts_array[1] = array('Xenowort.ttf');

// ENDE Einstellungen
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
session_start();
$pas = imagecreatetruecolor($breite, $hohe);
$bg = ImageColorAllocate($pas, 255, 255, 255);
ImageFilledRectangle($pas, 0, 0, $breite, $hohe, $bg);
$rand = str_replace('0', '9', strtoupper(substr(md5(uniqid (rand())), 0, 6)));
$_SESSION['P91Captcha_code'] = sha1($rand);
$heuri = rand(0, 1);
if ($heuri == 0) {
    for($i = 0; $i <= ($size * 1.2); $i++) {
        $x = rand(0, $breite);
        $y = rand(0, $hohe);
        $x2 = ceil(rand(0, $breite) / 2);
        $y2 = rand(0, $hohe);
        imagearc($pas, $x, $y, $x2, $y2, 0, rand(200, 360), imagecolorallocate($pas, rand(170, 255), rand(170, 255), rand(170, 255)));
    }
} else {
    for($i = 0; $i <= 21; $i++) {
        $x = rand(0, $breite);
        $y = rand(0, $hohe);
        $x2 = $x + rand(10, 20);
        $y2 = $y + rand(10, 20);
        imagefilledrectangle($pas, $x, $y, $x2, $y2, imagecolorallocate($pas, rand(180, 255), rand(180, 255), rand(180, 255)));
    }
}
imagettftext($pas, $size, 0, 5, 25 + rand(-2, 13), imagecolorallocate($pas, rand(0, 140), rand(0, 140), rand(0, 140)), fontpas($rand[0]), $rand[0]);
imagettftext($pas, $size, 0, 30, 25 + rand(-2, 13), imagecolorallocate($pas, rand(0, 140), rand(0, 140), rand(0, 140)), fontpas($rand[1]), $rand[1]);
imagettftext($pas, $size, 0, 55, 25 + rand(-2, 13), imagecolorallocate($pas, rand(0, 140), rand(0, 140), rand(0, 140)), fontpas($rand[2]), $rand[2]);
imagettftext($pas, $size, 0, 80, 25 + rand(-2, 13), imagecolorallocate($pas, rand(0, 140), rand(0, 140), rand(0, 140)), fontpas($rand[3]), $rand[3]);
imagettftext($pas, $size, 0, 105, 25 + rand(-2, 13), imagecolorallocate($pas, rand(0, 140), rand(0, 140), rand(0, 140)), fontpas($rand[4]), $rand[4]);
imagettftext($pas, $size, 0, 130, 25 + rand(-2, 13), imagecolorallocate($pas, rand(0, 140), rand(0, 140), rand(0, 140)), fontpas($rand[5]), $rand[5]);
header("Content-type: image/jpeg");
imagejpeg($pas);
imagedestroy($pas);
// Funktion
function fontpas($string)
{
	// Richtigen Font auswählen *g*
    global $fonts_array;
    global $fontdir;
    if (is_numeric($string)) {
        $range = count($fonts_array[1]);
        return $fontdir . '/' . $fonts_array[1][rand(0, ($range-1))];
    } else {
        $range = count($fonts_array[0]);
        return $fontdir . '/' . $fonts_array[0][rand(0, ($range-1))];
    }
}

?>
