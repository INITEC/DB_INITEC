<?php 
require_once("conexion1.php");
$sql="delete from integrantes where 
id_integrante=".$_GET["id_integrante"]."";

$res=mysql_query($sql,$conexion);
echo "<script>
		alert('El integrante fue eliminado correctamente');
		window.location='integrantes.php'
</script>";
?>