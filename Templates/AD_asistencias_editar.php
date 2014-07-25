<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AD_ASISTENCIAS";	
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
<script type="text/javascript" languaje="javascript" src="AD_asistencias/Marcar.js"></script>
<script type="text/javascript" languaje="javascript" src="AD_asistencias/mueveReloj.js"></script>
</head>
<body  onload="mueveReloj()">
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
require_once ("conexion1.php");
$sql="select * from reuniones where id_fecha='".$_POST["id_fecha"]."'";
$res=mysql_query($sql,$conexion);
$reg=mysql_fetch_array($res)
?>
	<table align="center" width="700" >
	<tr>
		<td align="center" valign="top" width="700" colspan="7" style="color:#FFFFFF">
			<h3>Toma de Asistencia (<?php echo $reg["dia_semana"];?> - <?php echo $reg["fecha"];?>)</h3>
		</td>
	</tr>
	<tr>
			<td align="center" valign="top" width="50" style="color:#FFFFFF" >
				&nbsp;
			</td>
			<td align="right" valign="top" width="250" style="color:#FFFFFF" >
				<h4>Inicio:</h4>
			</td>
			<td align="left" valign="top" width="100" style="color:#FFFFFF" >
				<form name="inicio" >
				<input type="text" name="hora_inicio" readonly="readonly" size="10" style="background-color : Black; color : White; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_reloj.reloj.blur()" value="<?php echo $reg["hora_inicio"];?>" >
				</form>
			</td>
			<td align="right" valign="top" width="100" style="color:#FFFFFF" >
				<h4>Hora Actual:</h4>
			</td>
			<td align="left" valign="top" width="100" style="color:#FFFFFF" >
				<form name="form_reloj">
				<input type="text" name="reloj" size="10" style="background-color : Black; color : White; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_reloj.reloj.blur()"> 
				</form>
			</td>
			<td align="center" valign="top" width="80" style="color:#FFFFFF" >
				&nbsp;
			</td>
			<td align="center" valign="top" width="80" style="color:#FFFFFF" >
				&nbsp;
			</td>
			<td align="center" valign="top" width="80" style="color:#FFFFFF" >
				&nbsp;
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
	<td align="center" valign="top" width="80" >
	&nbsp;
	</td>
	<td align="center" valign="top" width="80" >
	&nbsp;
	</td>
	</tr>
	<?php 
	$sql2="select * from integrantes where estado='activo' order by integrante asc";
	$res2=mysql_query($sql2,$conexion);
	
	while($reg2=mysql_fetch_array($res2)){
	?>
		<tr class="datos_extra" >
			<td align="center" valign="top" width="50" >
				<img src="../foto_integrantes/<?php echo $reg2["foto"];?>" width="50" heigth="50" border="0" >
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
				<td align="center" valign="top" width="100" >
					&nbsp;
				</td>
			<?php 
			} else {
			?>
				<form action="AD_asistencias_editar_enviar.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<input type="text" name="hora" value="<?php echo $reg["hora_inicio"];?>" >
				</td>
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<select name="asistencia">
						<option value="Asistio">Asistio</option>
						<option value="No Asistio">No Asistio</option>
					</select>
				</td>
				<td align="center" valign="top" width="100" class="datos_extra_2" >
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
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<input type="submit" value="Enviar" title="Enviar"/>
				</td>
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<input type="button" value="Marcar" title="Marcar" onClick="Marcar(document.form_<?php echo $reg2["id_integrante"]?>)" />
				</td>
			<?php 
			}
			?>
			<!-- *************************************************************************************** -->		
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
