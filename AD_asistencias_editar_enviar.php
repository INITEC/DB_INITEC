<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD ASISTENCIAS"){
	if($_POST["asistencia"]="No Asistio"){
		$sql="insert into asistencias values (
		null, null, '".$_POST["asistencia"]."',
		'".$_POST["condicion"]."', '".$_POST["id_integrante"]."', '".$_POST["id_fecha"]."')";
	}else{
		$sql="insert into asistencias values (
		null, '".$_POST["hora"]."', '".$_POST["asistencia"]."',
		'".$_POST["condicion"]."', '".$_POST["id_integrante"]."', '".$_POST["id_fecha"]."')";
	}
	if($res=mysql_query($sql,$conexion)){
		?>
		<html>
		<body>
		<form action="AD_asistencias_editar.php" method="post" name="form" >
		<input type="hidden" name="id_fecha" value="<?php echo $_POST["id_fecha"];?>" >
		<input type="hidden" name="tarea" value="<?php echo $_POST["tarea"];?>" >
		</form>
		</body>
		</html>
		<?php 
	
	echo "<script type='text/javascript' language='javascript' >
	document.form.submit();
	</script>";
	}
	else {
		echo "<script type=''>
			alert('La asistencia no fue guardada, vuelva a intentarlo');
			history.back();
	</script>";}


} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

