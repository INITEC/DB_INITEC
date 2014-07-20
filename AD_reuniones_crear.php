<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD REUNIONES"){
	$sql="insert into reuniones values (
	null, '".$_POST["dia_semana"]."', '".$_POST["hora_inicio"]."', 
	'".$_POST["hora_fin"]."', '".$_POST["lugar"]."', '".$_POST["asunto"]."','".$_POST["fecha"]."' )";
	
	if($res=mysql_query($sql,$conexion)){
		?>
		<html>
		<body>
		<form action="AD_reuniones.php" method="post" name="form" >
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
			alert('La reunion no pudo ser creada, vuelva a intentarlo');
			history.back();
	</script>";}


} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

