<?php 
session_start();
require_once ("conexion1.php");
if($_SESSION["id_integrante"]){
	$id_fecha=$_POST["id_fecha"];
	$sql="insert into asistencias values (
	null,null, '".$_POST["asistencia"]."',
	'".$_POST["condicion"]."', '".$_SESSION["id_integrante"]."', '".$id_fecha."')";
	
	$just="insert into justificaciones values (
	null, '".$_SESSION["id_integrante"]."','".$id_fecha."',
	'".$_POST["condicion"]."','".$_POST["asistencia"]."','".$_POST["motivo"]."',now(),now())";
	
	if($res=mysql_query($sql,$conexion) and $res_just=mysql_query($just,$conexion)){
		echo "<script type='text/javascript' language='javascript' >
		alert ('Su justificacion fue enviada con exito');
		window.location='inicio.php';
		</script>";
	}else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Su justificacion no pudo ser procesada, vuelva a intentarlo');
		history.back();
</script>";
}


}else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>