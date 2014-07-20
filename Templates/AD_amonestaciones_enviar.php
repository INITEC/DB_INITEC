<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] && $_POST["tarea"]=="AD_AMONESTACIONES"){
	$ver="insert into amonestaciones values (null, '".$_POST["id_integrante"]."', '".$_SESSION["id_integrante"]."',
		'".$_POST["fecha_emision"]."', '".$_POST["fecha_falta"]."', '".$_POST["tipo"]."', '".$_POST["motivo"]."', '".$_POST["articulo"]."',
				'".$_POST["capitulo"]."', '".$_SESSION["temporada"]."' )";
	if ($res_ver=mysql_query($ver,$conexion)){
			echo "<script>
			alert('La amonestacion fue enviada exitosamente');
			window.location='AD_amonestaciones.php';
			</script>";	
	} else {
		echo "<script type=''>
			alert('La amonestacion no fue guardada, intentelo de nuevo');
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

