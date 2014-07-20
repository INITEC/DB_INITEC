<?php
// Crear una imagen en blanco y añadir algún texto
$im = imagecreatetruecolor(120, 20);
$color_texto = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 1, 5, 5,  'Una Sencilla Cadena De Texto', $color_texto);

// Establecer la cabecera de tipo de contenido - en este caso image/jpeg
header('Content-Type: image/jpeg');

// Saltarse el parámetro filename usando NULL, después establecer la calidad al 75%
imagejpeg($im, NULL, 75);

// Liberar memoria
imagedestroy($im);
?>