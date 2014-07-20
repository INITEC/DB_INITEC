<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
$id_integrante=$_GET["id"];
$sql="select * from integrantes where id_integrante='".$id_integrante."'";
$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
<html>
<head>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
</head>
<body >
	<table width="550px" align="center">
		<tr >
			<td width="350" class="informacion_extra" >
			Integrante
			</td>
			<td width="50" class="informacion_extra" >
			Abreviatura
			</td>
			<td width="150" class="datos_extra" rowspan="6" >
			<img src="foto_integrantes/<?php echo $reg["foto"]; ?>" width="150px">
			</td>
		</tr>
		<tr>
			<td width="350" class="datos_extra" >
			<?php 
				echo chao_tilde($reg["integrante"]);
			?>
			</td>
			<td width="50" class="datos_extra" >
			<?php 
				echo $reg["abreviatura"];
			?>
			</td>
		</tr>
		<tr>
			<td width="100" class="informacion_extra" >
			Celular
			</td>
			<td width="300" class="informacion_extra" >
			Cargo
			</td>
		</tr>
		<tr>
			<td width="100" class="datos_extra" >
			<?php 
				echo $reg["celular"];
			?>
			</td>
			<td width="300" class="datos_extra" >
			<?php 
				echo chao_tilde($reg["cargo"]);
			?>
			</td>
		</tr>
		<tr>
			<td width="400" class="informacion_extra" colspan="2" >
			Gmail
			</td>
		</tr>
		<tr>
			<td width="400" class="datos_extra" colspan="2" >
			<?php 
				echo $reg["gmail"];
			?>
			</td>
		</tr>
		<tr>
			<td width="400" class="informacion_extra" colspan="2">
			E-mail
			</td>
			<td width="150" class="informacion_extra" >
			Usuario
			</td>
		</tr>
		<tr>
			<td width="400" class="datos_extra" colspan="2">
			<?php 
				echo $reg["e_mail"];
			?>
			</td>
			<td width="150" class="datos_extra" >
			<?php 
				echo chao_tilde($reg["usuario"]);
			?>
			</td>
		</tr>
		<tr>
			<td width="300" class="informacion_extra" >
			Direccion
			</td>
			<td width="100" class="informacion_extra" >
			Especialidad
			</td>
			<td width="150" class="informacion_extra" >
			Facultad
			</td>
		</tr>
		<tr>
			<td width="300" class="datos_extra">
			<?php 
				echo chao_tilde($reg["direccion"]);
			?>
			</td>
			<td width="100" class="datos_extra" >
			<?php 
				echo $reg["especialidad"];
			?>
			</td>
			<td width="150" class="datos_extra" >
			<?php 
				echo $reg["facultad"];
			?>
			</td>
		</tr>
		<tr>
			<td width="550" class="informacion_extra" colspan="3">
				Estado de Amonestaciones				
			</td>
		</tr>
		<tr>
			<td width="550" class="datos_extra" colspan="3" align="center">
			<?php 
			$amon="select count(*) as cuantos from amonestaciones where receptor='".$id_integrante."' AND tipo='leve' AND id_temporada='".$_SESSION["temporada"]."' ";
			$res_amon=mysql_query($amon,$conexion);
			$reg_amon=mysql_fetch_array($res_amon);
			$amon_leves=$reg_amon["cuantos"];
			$amon="select count(*) as cuantos from amonestaciones where receptor='".$id_integrante."' AND tipo='grave' AND id_temporada='".$_SESSION["temporada"]."' ";
			$res_amon=mysql_query($amon,$conexion);
			$reg_amon=mysql_fetch_array($res_amon);
			$amon_graves=$reg_amon["cuantos"];
			$amon_total=$amon_leves + ($amon_graves * 2);
			if($amon_total > 6){$amon_total = 6;}
			?>
			<br>
			<img src="ima/barra_<?php echo $amon_total;?>.png" width="500" >
			<br>
			<br>
			Usted tiene <?php echo $amon_leves;?> falta(s) leve(s) y <?php echo $amon_graves;?> falta(s) grave(s)	
			</td>
		</tr>
		<tr>
			<td width="550" class="datos_extra" colspan="3" align="center">
			<?php 
			$faltas="select count(*) as cuantos from asistencias,reuniones where  asistencias.id_fecha=reuniones.id_fecha AND asistencias.id_integrante='".$id_integrante."' AND reuniones.id_temporada='".$_SESSION["temporada"]."' AND asistencias.asistencia='No Asistio' ";
			$res_faltas=mysql_query($faltas,$conexion);
			$reg_faltas=mysql_fetch_array($res_faltas);
			$faltas_total=$reg_faltas["cuantos"];
			if($faltas_total > 6){$faltas_total = 6;}
			?>
			<br>
			<img src="ima/barra_<?php echo $faltas_total;?>.png" width="500" >
			<br>
			<br>
			Usted tiene <?php echo $faltas_total;?> inasistencia(s)	
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