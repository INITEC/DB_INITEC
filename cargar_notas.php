<?php 
require_once("conexion1.php");
$id_examen=$_POST["id_examen"];
$sql="insert into notas values (
null, '".$_POST["nota"]."', '".$_POST["condicion"]."',
'".$_POST["id_integrante"]."', '".$id_examen."')";

if($res=mysql_query($sql,$conexion)){
	?>
	<html>
	<body>
	<form action="tomar_notas.php" method="post" name="form" >
	<input type="hidden" name="id_examen" value="<?php echo $id_examen;?>" >
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
		alert('La nota no fue guardada, vuelva a intentarlo');
		history.back();
</script>";}	
?>