<?php 
function mes_text ($fecha) //formato: 0000-00-00
{ 	$fecha= empty($fecha)?date('Y-m-d'):$fecha;
	$mes = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Nomviembre','Diciembre');
	$dd   = explode('-',$fecha);
	$ts   = mktime(0,0,0,$dd[1],$dd[2],$dd[0]);
	return $mes[date('n',$ts)-1];
}

?>