<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD_DEUDAS"){
	$sql="update deudas set
	nombre_deuda='".$_POST["nombre_deuda"]."', fecha_final='".$_POST["fecha_final"]."', 
	cantidad='".$_POST["cantidad"]."',cobrador='".$_POST["cobrador"]."'  where id_deuda='".$_POST["id_deuda"]."' ";
	
	if($res=mysql_query($sql,$conexion)){	
	echo "<script type='text/javascript' language='javascript' >
	window.location='AD_deudas.php';
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

