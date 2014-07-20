<?php 
require_once("conexion1.php");
$sql="insert into examenes values (
null, '".$_POST["examen"]."', '".$_POST["fecha"]."',
'".$_POST["n_maxima"]."', '".$_POST["n_aprobatoria"]."')";

if($res=mysql_query($sql,$conexion)){
echo "<script type='text/javascript' language='javascript' >
		alert('El examen fue creado exitosamente');</script>";
$sql="select * from examenes where fecha='".$_POST["fecha"]."'";
$res=mysql_query($sql,$conexion);
	if($reg=mysql_fetch_array($res)){
	?>
	<html>
	<body>
	<form action="tomar_notas.php" method="post" name="form" >
	<input type="hidden" name="id_examen" value="<?php echo $reg["id_examen"];?>" >
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
	echo "<script type='text/javascript' language='javascript'>
		alert('El examen no se pudo crear, vuelva a intentarlo');
		history.back();
</script>";}	
	
?>