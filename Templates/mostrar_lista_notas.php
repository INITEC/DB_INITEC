<?php 
require_once ("conexion1.php");
$id_examen=$_GET["id"];
$sql="select * from integrantes,notas
	where notas.id_examen='".$id_examen."' AND integrantes.id_integrante=notas.id_integrante
			order by notas.nota desc";
$res=mysql_query($sql,$conexion);
?>
<html>
<head>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
</head>
<body >
<table align="center" width="600px" >
	<tr class="informacion_extra" >
		<td align="center" valign="top" width="50" >
			Foto
		</td>
		<td align="center" valign="top" width="250" >
			Nombre
		</td>
		<td align="center" valign="top" width="100" >
			Nota
		</td>
		<td align="center" valign="top" width="100" >
			Condicion
		</td>
	</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
	<tr class="datos_extra" >
		<td align="center" valign="top" width="50" >
		<img src="foto_integrantes/<?php echo $reg["foto"];?>" width="50" border="0" >
		</td>
		<td align="center" valign="top" width="250" >
		<?php 
		echo $reg["integrante"];
		?>
		</td>
		<td align="center" valign="top" width="100" >
		<?php 
		echo $reg["nota"];
		?>
		</td>
		<td align="center" valign="top" width="100" >
		<?php 
		echo $reg["condicion"];
		?>
		</td>
	</tr>
<?php 
}
?>
</table>
</body>
</html>
