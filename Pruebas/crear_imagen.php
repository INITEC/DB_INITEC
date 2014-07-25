<?php
Header ("Content-type: image/png");
$cadena = $_GET['texto'];
/*
$im     = imagecreatefrompng("barra_0.png");
$naranja = imagecolorallocate($im, 220, 210, 60);
$px     = (imagesx($im) - 7.5 * strlen($cadena)) / 2;
imagestring($im, 3, $px, 25, $cadena, $naranja);
imagepng($im);
imagedestroy($im);*/
$im = ImageCreate(120, 40); 
$white = ImageColorAllocate($im, 255, 255, 255); 
$blue = ImageColorAllocate($im, 30, 255, 255); 
ImageFill($im, 0, 0, $blue); 
// obtenemos las dimensiones de las fuentes 
$font_height = ImageFontHeight(3); 
$font_width = ImageFontWidth(3); 
// obtenemos las dimensiones de la imagen 
$image_height = ImageSY($im); 
$image_width = ImageSX($im); 
// obtenemos el tamaño del string 
$length = $font_width * strlen($channel); 
// calculaamos las coordenadas del texto del boton que este centrado 
$image_center_x = ($image_width/2)-($length/2); 
$image_center_y = ($image_height/2)-($font_height/2); 
// escribo el texto del string que le pasamos 
ImageString($im, 3, $image_center_x, $image_center_y, $cadena, $white); 
ImagePng($im); 
?>