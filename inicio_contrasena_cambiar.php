<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$ver="select id_integrante,clave from integrantes where id_integrante='".$_SESSION["id_integrante"]."' AND
			clave='".$_POST["clave_antigua"]."' ";
	$res_ver=mysql_query($ver,$conexion);
	if($reg_ver=mysql_fetch_array($res_ver)){
		$cam="update integrantes set clave='".$_POST["clave1"]."' where id_integrante='".$_SESSION["id_integrante"]."' ";
		if($res_cam=mysql_query($cam,$conexion)){
			echo "<script type=''>
			alert('La contraseña fue cambiada exitosamente');
			window.location='inicio.php';
			</script>";
		} else {
			echo "<script type=''>
			alert('La contraseña no fue cambiada exitosamente, intentelo de nuevo');
			history.back();
			</script>";
		}
		
	} else {
		echo "<script type=''>
			alert('La contraseña antigua no conincide en la base de datos, intentelo de nuevo');
			history.back();
			</script>";
		}

} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

