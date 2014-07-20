<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD ASISTENCIAS"){
	$tarea_actual="AD ASISTENCIAS EDITAR";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::<?php echo $tarea_actual;?>::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">
<div id="contenedor">
	<div id="cabecera_ob" >
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="foto_integrantes/<?php echo $usuario["foto"];?>" height="70px" align="right">
		<a href="salir.php"><img src="ima/salir.png"  title="Salir" height="70px" align="right"></a>
	</div>
	<div id="cuerpo_tr" >
		<div id="menu_tr" >
<?php
$menu = retornar_menu($_SESSION["trabajo"]);
$res_menu=mysql_query($menu,$conexion);
		while ($reg_menu=mysql_fetch_array($res_menu)){
?>		
			<div class="boton_menu_tr" >
			<img id="<?php echo $reg_menu["tarea"]; ?>" src="ima/tareas/<?php echo $reg_menu["grafico"]; ?>"  width="190px" height="30px"
			onMouseMove="botones('<?php echo $reg_menu["tarea"]; ?>','200','40')" onMouseOut="botones('<?php echo $reg_menu["tarea"]; ?>','190','30')"
			<?php if($tarea_actual != $reg_menu["tarea"]){ ?>onclick="window.location='<?php echo $reg_menu["direccion"]; ?>'" <?php } ?>>
			</div>
<?php 
			}
?>		
		</div>
		<div id="presentacion_tr" >
			<div id="titulo_tr" >
			<h1><?php echo $tarea_actual; ?></h1>
			</div>
			<div id="identidad" >
<!-- *************************************************************************************************** -->
<?php 
$sql="select * from reuniones where id_fecha='".$_POST["id_fecha"]."'";
$res=mysql_query($sql,$conexion);
$reg=mysql_fetch_array($res)
?>
	<table align="center" width="700" >
	<tr>
	<td align="center" valign="top" width="700" colspan="6" style="color:#FFFFFF">
	<h3>Toma de Asistencia (<?php echo $reg["dia_semana"];?> - <?php echo $reg["fecha"];?>)</h3>
	<h4>Inicio <?php echo $reg["hora_inicio"];?></h4>
	</td>
	</tr>

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
	<td align="center" valign="top" width="100" >
	&nbsp;
	</td>
	</tr>
	<?php 
	$sql2="select * from integrantes order by integrante asc";
	$res2=mysql_query($sql2,$conexion);
	
	while($reg2=mysql_fetch_array($res2)){
	?>
		<tr class="datos_extra" >
		<td align="center" valign="top" width="50" >
		<img src="foto_integrantes/<?php echo $reg2["foto"];?>" width="50" heigth="50" border="0" >
		</td>
		<td align="center" valign="top" width="250" >
		<?php 
		echo $reg2["integrante"];
		?>
		</td>
		<!-- ********************************************************************* -->
		<?php 
		$sql3="select * from asistencias where id_integrante='".$reg2["id_integrante"]."' AND 
				id_fecha='".$_POST["id_fecha"]."' ";
		$res3=mysql_query($sql3,$conexion);
		if($reg3=mysql_fetch_array($res3)){
		?>
		<form action="AD_asistencias_editar_cambiar.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
		<td align="center" valign="top" width="100" >
		<input type="text" name="hora" value="<?php echo $reg3["hora"];?>" >
		</td>
		<td align="center" valign="top" width="100" >
		<select name="asistencia">
		<option <?php if($reg3["asistencia"]=="Asistio"){echo "selected";}?> value="Asistio">Asistio</option>
		<option <?php if($reg3["asistencia"]=="No Asistio"){echo "selected";}?> value="No Asistio">No Asistio</option>
		</select>
		</td>
		<td align="center" valign="top" width="100" >
		<select name="condicion">
		<option <?php if($reg3["condicion"]=="Puntual"){echo "selected";}?> value="Puntual">Puntual</option>
		<option <?php if($reg3["condicion"]=="Retrasado justificado"){echo "selected";}?> value="Retrasado justificado">Retrasado justificado</option>
		<option <?php if($reg3["condicion"]=="Tarde justificado"){echo "selected";}?> value="Tarde justificado">Tarde justificado</option>
		<option <?php if($reg3["condicion"]=="Justificado"){echo "selected";}?> value="Justificado">Justificado</option>
		<option <?php if($reg3["condicion"]=="Retrasado"){echo "selected";}?> value="Retrasado">Retrasado</option>
		<option <?php if($reg3["condicion"]=="Tarde"){echo "selected";}?> value="Tarde">Tarde</option>
		<option <?php if($reg3["condicion"]=="Injustificado"){echo "selected";}?> value="Injustificado">Injustificado</option>
		<option <?php if($reg3["condicion"]=="Apoyo"){echo "selected";}?> value="Apoyo">Apoyo</option>
		</select>
		</td>
		<td align="center" valign="top" width="100" >
		<input type="submit" value="Cambiar" title="Cambiar"/>
		</td>
		<?php 
		} else {
		?>
		<form action="AD_asistencias_editar_enviar.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
		<td align="center" valign="top" width="100" >
		<input type="text" name="hora" value="<?php echo $reg["hora_inicio"];?>" >
		</td>
		<td align="center" valign="top" width="100" >
		<select name="asistencia">
		<option value="Asistio">Asistio</option>
		<option value="No Asistio">No Asistio</option>
		</select>
		</td>
		<td align="center" valign="top" width="100" >
		<select name="condicion">
		<option value="Puntual">Puntual</option>
		<option value="Retrasado justificado">Retrasado justificado</option>
		<option value="Tarde justificado">Tarde justificado</option>
		<option value="Justificado">Justificado</option>
		<option value="Retrasado">Retrasado</option>
		<option value="Tarde">Tarde</option>
		<option value="Injustificado">Injustificado</option>
		<option value="Apoyo">Apoyo</option>
		</select>
		</td>
		</td>
		<td align="center" valign="top" width="100" >
		<input type="submit" value="Enviar" title="Enviar"/>
		</td>
		<?php 
		}
		?>
		
		</tr>
		<input type="hidden" name="id_integrante" value="<?php echo $reg2["id_integrante"];?>" >
		<input type="hidden" name="id_fecha" value="<?php echo $_POST["id_fecha"];?>" >
		<input type="hidden" name="tarea" value="<?php echo $_POST["tarea"];?>" >
		</form>
		<!-- ********************************************************************* -->
	<?php 
	}
	?>
	<form action="AD_asistencias.php" method="post" name="terminar" >
	<tr>
	<td align="center" valign="top" width="700" colspan="6">
	<input type="submit" value="Terminar" title="Terminar de tomar asistencia"/>
	</td>
	</tr>
	</form>
	</table>
<!-- *************************************************************************************************** -->			
			</div>
		</div>	
	</div>
</div>
	<div id="pie" >
	Pagina programada por JIBF
	</div>
</body>
</html>
<?php
} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

