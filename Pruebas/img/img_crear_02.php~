<?php 

$filename= "foto2.jpg"; 
list($w, $h, $type, $attr) = getimagesize($filename); 
$src_im = imagecreatefromjpeg($filename); 

$src_x = '0';   // comienza x 
$src_y = '0';   // comienza y 
$src_w = $w; // ancho 
$src_h = 3*$w/4; // alto 
$dst_x = '0';   // termina x 
$dst_y = '0';   // termina y 

$dst_im = imagecreatetruecolor($src_w, $src_h); 
$white = imagecolorallocate($dst_im, 255, 255, 255); 
imagefill($dst_im, 0, 0, $white); 

imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h); 

header("Content-type: image/png"); 
imagepng($dst_im); 
imagedestroy($dst_im); 
?> 