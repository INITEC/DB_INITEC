<?php 
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
$id_deuda=$_GET["id"];
$sql="select * from pagos,integrantes,deudas 
	where pagos.id_deuda='".$id_deuda."' AND pagos.id_integrante=integrantes.id_integrante AND pagos.id_deuda=deudas.id_deuda
			order by pagos.pago desc";

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
			Pago
		</td>
		<td align="center" valign="top" width="100" >
			Debe
		</td>
		<td align="center" valign="top" width="100" >
			Condicion
		</td>
	</tr>
<?php 
while($reg=mysql_fetch_array($res)){
$color=color_deuda($reg["condicion"]);
?>
	<tr class="datos_asistencia" >
		<td align="center" valign="top" width="50" >
		<img src="foto_integrantes/<?php echo $reg["foto"];?>" width="50" border="0" >
		</td>
		<td align="center" valign="top" width="250" class="<?php echo $color?>" >
		<?php 
		echo $reg["integrante"];
		?>
		</td>
		<td align="center" valign="top" width="100" class="<?php echo $color?>" >
		<?php 
		echo $reg["pago"];
		?>
		</td>
		<td align="center" valign="top" width="100" class="<?php echo $color?>" >
		<?php
		echo $reg["cantidad"]-$reg["pago"];
		?>
		</td>
		<td align="center" valign="top" width="100" class="<?php echo $color?>" >
		<?php 
		if($reg["condicion"]==1){echo "No Pago";}
		if($reg["condicion"]==2){echo "Debe";}
		if($reg["condicion"]==3){echo "Pago";}
		?>
		</td>
	</tr>
<?php 
}
?>
</table>
</body>
</html>