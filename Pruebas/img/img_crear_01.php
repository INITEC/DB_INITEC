<?php
// Crear una imagen en blanco y añadir algún texto
$im = imagecreatetruecolor(120, 40); // ancho=120 ; alto=40 crea una imagen de fondo negro
$color_texto = imagecolorallocate($im, 255, 255, 255);  // devuelve un indicador de color
$texto = 'un simple texto';
//dibuja la cadena $texto en las coordenadas dadas
imagestring($im, 3, 0, 5,  $texto, $color_texto); // (recurso-imagen , tamano-fuente, coordenada-x, coordenada-y, ... )

// Establecer la cabecera de tipo de contenido - en este caso image/jpeg
header('Content-Type: image/jpeg');

// Imprimir la imagen
imagejpeg($im);

// Liberar memoria
imagedestroy($im);
?>