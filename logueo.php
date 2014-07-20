<?php
session_start();
require_once ("conexion1.php");
$sql="select id_integrante,trabajo,usuario,clave from integrantes 
	where usuario='".$_POST["usuario"]."' AND clave='".$_POST["clave"]."' ";
$res=mysql_query($sql,$conexion);
if(mysql_num_rows($res) == 0){
	echo "<script type='text/javascript'>
			alert('El usuario o la clave son incorrectas, porfavor vuelva a intentarlo');
			window.location.assign('index.php');
			</script>";}
else {
	//******************************************************************************
	//Inicia la seccion
	$reg=mysql_fetch_array($res);
	$_SESSION["id_integrante"]=$reg["id_integrante"];
	$_SESSION["trabajo"]=$reg["trabajo"];
	header("Location: inicio.php");
	}
?>
