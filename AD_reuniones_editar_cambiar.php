<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD REUNIONES"){
	$sql="update reuniones set
	dia_semana='".$_POST["dia_semana"]."', hora_inicio='".$_POST["hora_inicio"]."', 
	hora_final='".$_POST["hora_fin"]."', lugar='".$_POST["lugar"]."', asunto='".$_POST["asunto"]."',fecha='".$_POST["fecha"]."'
	where id_fecha='".$_POST["id_fecha"]."' ";
	
	if($res=mysql_query($sql,$conexion)){	
	echo "<script type='text/javascript' language='javascript' >
	window.location='AD_reuniones.php';
	</script>";
	}
	else {
		echo "<script type=''>
			alert('La reunion no pudo ser cambiar, vuelva a intentarlo');
			history.back();
	</script>";}


} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

