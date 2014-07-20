<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$tarea_actual="JUSTIFICACIONES";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::JUSTIFICACIONES::..</title>
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
$sql="select * from reuniones order by id_fecha desc limit 1";
$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){

	$just="select count(*) as cuantos from justificaciones where id_integrante='".$_SESSION["id_integrante"]."' AND
			id_fecha='".$reg["id_fecha"]."' ";
	$res_just=mysql_query($just,$conexion);
	$reg_just=mysql_fetch_array($res_just);
	$just2="select count(*) as cuantos from asistencias where id_integrante='".$_SESSION["id_integrante"]."' AND
			id_fecha='".$reg["id_fecha"]."' ";
	$res_just2=mysql_query($just2,$conexion);
	$reg_just2=mysql_fetch_array($res_just2);
	$numero_justificaciones=$reg_just["cuantos"]+$reg_just2["cuantos"];
	if($numero_justificaciones == 0){
?>
		<form action="usuario_justificaciones_enviar.php" method="post" >
		<table width="600px" align="center">
			<tr class="informacion_extra" >
				<td width="200px" align="center" valign="top" >
					Asistencia
				</td>
				<td width="200px" align="center" valign="top" >
					Condicion
				</td>
				<td width="200px" align="center" valign="top" >
					Fecha
				</td>
			</tr>
			<tr class="datos_extra" >
				<td width="200px" align="center" valign="top" >
					<select name="asistencia">
						<option value="Asistio">Asistire</option>
						<option value="No Asistio">No Asistire</option>
					</select>
				</td>
				<td width="200px" align="center" valign="top" >
					<select name="condicion">
						<option value="Retrasado justificado">Retrasado</option>
						<option value="Tarde justificado">Tarde</option>
						<option value="Justificado">Justificado</option>
						<option value="Apoyo">Apoyo</option>	
					</select>
				</td>
				<td width="200px" align="center" valign="top" >
					<?php echo $reg["fecha"]; ?>
				</td>
			</tr>
			<tr class="informacion_extra" >
				<td width="600px" align="left" valign="top" colspan="3">
					Motivo
				</td>
			</tr>
			<tr class="datos_extra" >
				<td width="600px" align="center" valign="top" colspan="3">
					<textarea name="motivo" cols="40" rows="2"> </textarea>
				</td>
			</tr>
			<tr>
				<td width="600px" align="center" valign="top" colspan="3">
					<input type="hidden" name="id_fecha" value="<?php echo $reg["id_fecha"]; ?>" />
					<input type="submit" value="enviar" title="Enviar" />  
				</td>
			</tr>		
		</table>
		</form>
<?php 
	}else {
	?>
	<h2 style="color:#FFFFFF">Usted ya justifico la ultima reunion o esta ya paso</h2>
	<?php
	}
}
$obs="select * from justificaciones,reuniones where justificaciones.id_integrante='".$_SESSION["id_integrante"]."' AND
		reuniones.id_fecha=justificaciones.id_fecha order by reuniones.id_fecha desc";
$res_obs=mysql_query($obs,$conexion);
?>
		<table align="center" width="400px" >
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
					Fecha Reunion
				</td>
				<td align="center" valign="top" width="100" >
					Fecha justif.
				</td>
				<td align="center" valign="top" width="100" >
					hora justif.
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td> 
			</tr>

<?php 
while($reg_obs=mysql_fetch_array($res_obs)){
?>
			<tr class="registros_tabla" >
				<td align="center" valign="top" width="150" >
					<?php echo $reg_obs["fecha"]; ?>
				</td>
				<td align="center" valign="top" width="100" >
					<?php echo $reg_obs["fecha_justificacion"]; ?>
				</td>
				<td align="center" valign="top" width="100" >
					<?php echo $reg_obs["hora_justificacion"]; ?>
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ver mas" src="ima/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg_obs["id_justificacion"]; ?>','ver_mas_<?php echo $reg_obs["id_justificacion"]; ?>','usuario_justificaciones_motivo.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="ima/desplazar_arriba.png" width="25px"
					onclick="document.getElementById('ver_mas_<?php echo $reg_obs["id_justificacion"]; ?>').innerHTML=''">
				</td>
			</tr>
			<tr>
				<td width="350" colspan="5" >
				<div id="ver_mas_<?php echo $reg_obs["id_justificacion"]; ?>" >
				</div>	
				</td>
			</tr>
<?php 
}
?>
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

