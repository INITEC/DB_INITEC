<?php 
require_once ("conexion1.php");
$id_fecha=$_GET["id"];
$sql="select * from integrantes,asistencias 
	where asistencias.id_fecha='".$id_fecha."' AND integrantes.id_integrante=asistencias.id_integrante
			order by integrantes.integrante asc";
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
			Hora
		</td>
		<td align="center" valign="top" width="100" >
			Asistencia
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
		echo $reg["hora"];
		?>
		</td>
		<td align="center" valign="top" width="100" >
		<?php 
		echo $reg["asistencia"];
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