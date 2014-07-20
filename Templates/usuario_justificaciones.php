<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "JUSTIFICACIONES";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_integrante);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$trabajos = new trabajos_int();
		$tareas = new tareas_int();
/* ..................................................................................................................... */
?>
<html>
<head>
<title>..::HOME::..</title>
<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">
<div id="contenedor_tr">
			<div id="cabecera_tr">
				<?php include_once("../Include/cabecera_tarea.php");?>
			</div>
			<div id="cuerpo_tr">
				<div id="menu_izquierda_tr">
					<?php include_once("../Include/menu_obligaciones.php");?>
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
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg_obs["id_justificacion"]; ?>','ver_mas_<?php echo $reg_obs["id_justificacion"]; ?>','usuario_justificaciones_motivo.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
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
		<div id="pie_pagina_tr">
			<?php include_once("../Include/pie_pagina.php");?>
		</div>
	</body>
</html>

<?php 
/* ................................................................................................................. */
			}
	else {
			include_once ("../Include/no_tarea.php");
			}	
		}
else {
		include_once ("../Include/no_acceso.php");
		}

?>


