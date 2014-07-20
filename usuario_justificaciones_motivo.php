<?php 
require_once ("conexion1.php");
$id_justificacion=$_GET["id"];
$sql="select * from justificaciones where id_justificacion='".$id_justificacion."'";
$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
	<html>
		<head>
		<link href="css/estilos.css" type="text/css" rel="stylesheet" >
		</head>
		<body>
			<table width="300px" align="center" >
				<tr class="informacion_extra" >
					<td width="150px" align="center" valign="top">
						Asistencia
					</td>
					<td width="150px" align="center" valign="top">
						Condicion
					</td>
				</tr>
				<tr class="datos_extra" >
					<td width="150px" align="center" valign="top">
						<?php echo $reg["asistencia_justificacion"];?>
					</td>
					<td width="150px" align="center" valign="top">
						<?php echo $reg["condicion_justificacion"];?>
					</td>
				</tr>
				<tr class="informacion_extra" >
					<td width="300px" align="center" valign="top" colspan="2">
						Motivo
					</td>
				</tr>
				<tr class="datos_extra" >
					<td width="300px" align="center" valign="top" colspan="2">
						<?php echo $reg["motivo"];?>
					</td>
				</tr>
			</table>
		</body>
	</html>
<?php 
} else {
	echo "Lamentablemente no se pudo acceder a los datos";
}
?>