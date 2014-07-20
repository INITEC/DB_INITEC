<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD PAGOS"){
	$com="select * from pagos,deudas where deudas.id_deuda='".$_POST["id_deuda"]."' AND deudas.id_deuda=pagos.id_deuda
			AND pagos.id_integrante='".$_POST["id_integrante"]."' ";
	$res_com=mysql_query($com,$conexion);
	$reg_com=mysql_fetch_array($res_com);
	$condicion=2;
	$pago=$reg_com["pago"]+$_POST["pago"];
	if($pago>=$reg_com["cantidad"]){$condicion=3;}
	if($pago<=0){$condicion=1;}
	
	$sql="update pagos set
	pago='".$pago."', condicion='".$condicion."' where id_deuda='".$_POST["id_deuda"]."' AND id_integrante='".$_POST["id_integrante"]."' ";
	
	if($res=mysql_query($sql,$conexion)){	
	echo "<script type='text/javascript' language='javascript' >
	window.location='AD_pagos.php';
	</script>";
	}
	else {
		echo "<script type=''>
			alert('Los datos de la deuda no se pudieron cambiar, vuelva a intentarlo');
			history.back();
	</script>";}


} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

