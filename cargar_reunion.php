<?php 
require_once("conexion1.php");
$sql="insert into reuniones values (
null, '".$_POST["dia_semana"]."', '".$_POST["dia"]."',
'".$_POST["mes"]."', '".$_POST["ano"]."', '".$_POST["hora_inicio"]."', 
'".$_POST["hora_fin"]."', '".$_POST["lugar"]."', '".$_POST["asunto"]."')";


if($res=mysql_query($sql,$conexion)){
echo "<script type='text/javascript' language='javascript' >
		alert('La reunion fue creada exitosamente');</script>";
$sql="select * from reuniones where dia='".$_POST["dia"]."' AND  mes='".$_POST["mes"]."' AND ano='".$_POST["ano"]."'";
$res=mysql_query($sql,$conexion);
	if($reg=mysql_fetch_array($res)){
	?>
	<html>
	<body>
	<form action="tomar_asistencia.php" method="post" name="form" >
	<input type="hidden" name="id_fecha" value="<?php echo $reg["id_fecha"];?>" >
	</form>
	</body>
	</html>
	<?php 
	}	
echo "<script type='text/javascript' language='javascript' >
document.form.submit();
</script>";
}
else {
	echo "<script type=''>
		alert('La reunion no se pudo crear, vuelva a intentarlo');
		history.back();
</script>";}	
	
?>