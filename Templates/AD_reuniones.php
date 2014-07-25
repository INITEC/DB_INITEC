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
		<form action="AD_reuniones_crear.php" method="post" name="reun">
		<table align="center" width="400" >
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Dia de la semana:
				</td>
				<td valign="top" align="left" width="200" >
					<select name="dia_semana">
					<option value="0">Selecione un dia</option>
					<option value="Lunes">Lunes</option>
					<option value="Martes">Martes</option>
					<option value="Miercoles">Miercoles</option>
					<option value="Jueves">Jueves</option>
					<option value="Viernes">Viernes</option>
					<option value="Sabado">Sabado</option>
					<option value="Domingo">Domingo</option>
					</select>
					<div id="div_dia_semana" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Fecha:
				</td>
				<td valign="top" align="left" width="200" >
					<?php 
					date_default_timezone_set('America/Los_Angeles');
					$dia=date(d);
					$mes=date(n);
					$ano=date(Y);
					?>
					<input type="text" name="fecha" value="<?php echo "$ano-$mes-$dia";?>" >
					<div id="div_fecha" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de inicio:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_inicio" value="00:00:00" >
					<div id="div_hora_inicio" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de finalizacion:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_fin" value="00:00:00" >
					<div id="div_hora_fin" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Lugar:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="lugar" value="OFICINA INITEC - RESIDENCIA UNI" >
					<div id="div_lugar" ></div>
				</td>
			</tr>
				
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Asunto:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="asunto" value="REUNION DE INFORMACION Y COORDINACION" >
					<div id="div_asunto" ></div>
				</td>
			</tr>
				<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
					<input type="submit" title="Crear" value="..::Crear::.." >
				</td>
			</tr>
		</table>
		</form>
<!-- *************************************************************************************************** -->			
		<hr>			
<?php 
$sql="select * from reuniones order by id_fecha desc";
$res=mysql_query($sql,$conexion);
?>
		<table align="center" width="650" >				
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
				Dia
				</td>
				<td align="center" valign="top" width="150" >
				Fecha
				</td>
				<td align="center" valign="top" width="150" >
				Hora inicio
				</td>
				<td align="center" valign="top" width="150" >
				Hora final
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
			</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
			<tr class="registros_tabla" >
				<td align="center" valign="top" width="150" >
					<?php echo $reg["dia_semana"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["hora_inicio"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["hora_final"]; ?>
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg["id_fecha"]; ?>','ver_mas_<?php echo $reg["id_fecha"]; ?>','observador_asistencias_mostrar.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
					onclick="document.getElementById('ver_mas_<?php echo $reg["id_fecha"]; ?>').innerHTML=''">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Editar" src="../Imagenes/editar.png" width="20px"
					onClick="document.form_<?php echo $reg["id_fecha"];?>.submit()">
					<!-- ************************************************************ -->
					<form action="AD_reuniones_editar.php" method="post" name="form_<?php echo $reg["id_fecha"];?>" >
					<input type="hidden" name="id_fecha" value="<?php echo $reg["id_fecha"];?>" >
					<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
					</form>
					<!-- ************************************************************ -->
				</td>
			</tr>
			<tr>
				<td width="450" colspan="6" >
				<div id="ver_mas_<?php echo $reg["id_fecha"]; ?>" >
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