<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AD_REUNIONES";	
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
	<title>..::<?php echo $tarea_actual; ?>::..</title>
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
			<br>
			<div id="identidad" >
<!-- *************************************************************************************************** -->
<?php 
$camb="select * from reuniones where id_fecha='".$_POST["id_fecha"]."'";
$res_camb=mysql_query($camb,$conexion);
if($reg_camb=mysql_fetch_array($res_camb)){
?>
		
		<form action="AD_reuniones_editar_cambiar.php" method="post" name="reun">
		<table align="center" width="400" >
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Dia de la semana:
				</td>
				<td valign="top" align="left" width="200" >
					<select name="dia_semana">
					<option <?php if($reg_camb["dia_semana"]=="Lunes"){echo "selected";}?> value="Lunes">Lunes</option>
					<option <?php if($reg_camb["dia_semana"]=="Martes"){echo "selected";}?> value="Martes">Martes</option>
					<option <?php if($reg_camb["dia_semana"]=="Miercoles"){echo "selected";}?> value="Miercoles">Miercoles</option>
					<option <?php if($reg_camb["dia_semana"]=="Jueves"){echo "selected";}?> value="Jueves">Jueves</option>
					<option <?php if($reg_camb["dia_semana"]=="Viernes"){echo "selected";}?> value="Viernes">Viernes</option>
					<option <?php if($reg_camb["dia_semana"]=="Sabado"){echo "selected";}?> value="Sabado">Sabado</option>
					<option <?php if($reg_camb["dia_semana"]=="Domingo"){echo "selected";}?> value="Domingo">Domingo</option>
					</select>
					<div id="div_dia_semana" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Fecha:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="fecha" value="<?php echo $reg_camb["fecha"];?>" >
					<div id="div_fecha" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de inicio:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_inicio" value="<?php echo $reg_camb["hora_inicio"];?>" >
					<div id="div_hora_inicio" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de finalizacion:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_fin" value="<?php echo $reg_camb["hora_final"];?>" >
					<div id="div_hora_fin" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Lugar:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="lugar" value="<?php echo $reg_camb["lugar"];?>" >
					<div id="div_lugar" ></div>
				</td>
			</tr>
				
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Asunto:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="asunto" value="<?php echo $reg_camb["asunto"];?>" >
					<div id="div_asunto" ></div>
				</td>
			</tr>
				<input type="hidden" name="tarea" value="<?php echo $_POST["tarea"]; ?>" >
				<input type="hidden" name="id_fecha" value="<?php echo $_POST["id_fecha"]; ?>" >
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
					<input type="button" title="Cambiar" value="Cambiar" onClick="validar_datos()" >
				</td>
			</tr>
		</table>
		</form>
<?php 
}
?>
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