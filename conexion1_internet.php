<?php
$conexion=mysql_connect("sql307.redwebmaster.com.ar","redwe_12350066","jibf123");
$base_datos=mysql_select_db("redwe_12350066_initec");

function escribir ($entrada) {
	$traduce = array ('á'=>'&aacute', 'Á'=>'&Aacute', 'é'=>'&eacute', 'É'=>'&Eacute', 'í'=>'&iacute', 'Í'=>'&Iacute',
	'ó'=>'&oacute', 'Ó'=>'&Oacute', 'ú'=>'&uacute', 'Ú'=>'&Uacute', 'ñ'=>'&ntilde', 'Ñ'=>'&Ntilde' );
	$sale=strtr($entrada,$traduce);
	return; }

function escribir_integrante ($entrada) {
	$traduce = array ('á'=>'&Aacute', 'Á'=>'&Aacute', 'é'=>'&Eacute', 'É'=>'&Eacute', 'í'=>'&Iacute', 'Í'=>'&Iacute',
	'ó'=>'&Oacute', 'Ó'=>'&Oacute', 'ú'=>'&Uacute', 'Ú'=>'&Uacute', 'ñ'=>'&Ntilde', 'Ñ'=>'&Ntilde',
	'a'=>'A', 'b'=>'B', 'c'=>'C', 'd'=>'D', 'e'=>'E', 'f'=>'F', 'g'=>'G', 'h'=>'H', 'i'=>'I', 'j'=>'J', 'k'=>'K',
	'l'=>'L', 'm'=>'M', 'n'=>'N', 'o'=>'O', 'p'=>'P', 'q'=>'Q', 'r'=>'R', 's'=>'S', 't'=>'T', 'u'=>'U', 'v'=>'V',
	'w'=>'W', 'x'=>'X', 'y'=>'Y', 'z'=>'Z'	 );
	$sale=strtr($entrada,$traduce);
	return $sale; }
	
?>

