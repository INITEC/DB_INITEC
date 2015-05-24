<?php
require_once ("../require/dia_text_func.php");
require_once ("../require/mes_text_func.php");

function fecha_text ($fecha){
    $mes_text = mes_text($fecha);
    $dia_text = dia_text($fecha);
    $fecha= empty($fecha)?date('Y-m-d'):$fecha;
	$date = explode('-',$fecha);
    $year = $date[0];
    $dia = $date[2];
    return $dia_text." ".$dia." de ".$mes_text." del ".$year; 
}
?>