<?php
session_start();
require_once ("conexion1.php");
$sql="select id_integrante,trabajo,usuario,clave,estado from integrantes 
	where usuario='".$_POST["usuario"]."' AND clave='".$_POST["clave"]."' AND estado='activo'";
$res=mysql_query($sql,$conexion);
if(mysql_num_rows($res) == 0){
	echo "<script type='text/javascript'>
			alert('El usuario o la clave son incorrectas, o estan deshabilitados porfavor vuelva a intentarlo o consulte con el administrador');
			window.location.assign('index.php');
			</script>";}
else {
	//******************************************************************************
	//Inicia la seccion
	$tempo="select id_temporada from temporadas order by id_temporada desc limit 1";
	$res_tempo=mysql_query($tempo,$conexion);
	$reg_tempo=mysql_fetch_array($res_tempo);
	$reg=mysql_fetch_array($res);
	$_SESSION["id_integrante"]=$reg["id_integrante"];
	$_SESSION["trabajo"]=$reg["trabajo"];
	$_SESSION["temporada"]=$reg_tempo["id_temporada"];
	header("Location: inicio.php");
	}
?>