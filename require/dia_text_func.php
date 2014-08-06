<?php 
function dia_text($fecha) //formato: 0000-00-00
{ 	$fecha= empty($fecha)?date('Y-m-d'):$fecha;
	$dias = array('Lunes','Martes','Mi&eacutercoles','Jueves','Viernes','S&aacutebado','Domingo');
	$dd   = explode('-',$fecha);
	$ts   = mktime(0,0,0,$dd[1],$dd[2],$dd[0]);
	return $dias[date('w',$ts)-1];
}
?>