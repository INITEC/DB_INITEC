<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "ASISTENCIAS";	
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
	<table align="center" width="650px" >
		<tr class="encabezado_tabla" >
			<td align="center" valign="top" width="100" >
				Dia
			</td>
			<td align="center" valign="top" width="50" >
				Fecha
			</td>
			<td align="center" valign="top" width="100" >
				Hora inicio
			</td>
			<td align="center" valign="top" width="100" >
				Hora asistencia
			</td>
			<td align="center" valign="top" width="150" >
				Asistencia
			</td>
			<td align="center" valign="top" width="150" >
				Condicion
			</td>
		</tr>
<?php $sql= "select * from reuniones,asistencias where asistencias.id_fecha=reuniones.id_fecha 
		AND asistencias.id_integrante=".$_SESSION["id_integrante"]." 
			order by reuniones.id_fecha desc";
$res=mysql_query($sql,$conexion);
while ($asist=mysql_fetch_array($res)){
?>
		<tr class="registros_tabla" >
			<td align="center" valign="top" width="100" >
				<?php echo $asist["dia_semana"]; ?>
			</td>
			<td align="center" valign="top" width="50" >
				<?php echo $asist["fecha"]; ?>
			</td>
			<td align="center" valign="top" width="100" >
				<?php echo $asist["hora_inicio"]; ?>
			</td>
			<td align="center" valign="top" width="100" >
				<?php echo $asist["hora"]; ?>
			</td>
			<td align="center" valign="top" width="150" >
				<?php echo $asist["asistencia"]; ?>
			</td>
			<td align="center" valign="top" width="150" >
				<?php echo $asist["condicion"]; ?>
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