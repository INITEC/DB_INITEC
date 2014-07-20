<?php 
require_once("conexion1.php");
$id_fecha=$_POST["id_fecha"];
$sql="insert into asistencias values (
null, '".$_POST["hora"]."', '".$_POST["asistencia"]."',
'".$_POST["condicion"]."', '".$_POST["id_integrante"]."', '".$id_fecha."')";

if($res=mysql_query($sql,$conexion)){
	?>
	<html>
	<body>
	<form action="tomar_asistencia.php" method="post" name="form" >
	<input type="hidden" name="id_fecha" value="<?php echo $id_fecha;?>" >
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
	
?>