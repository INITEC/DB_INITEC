<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AD_JUSTIFICACIONES";	
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
$obs="select * from justificaciones,reuniones,integrantes where
		reuniones.id_fecha=justificaciones.id_fecha AND integrantes.id_integrante=justificaciones.id_integrante 
		order by justificaciones.id_justificacion desc";
$res_obs=mysql_query($obs,$conexion);
?>
		<table align="center" width="650px" >
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="250" >
					Integrante
				</td>
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
				<td align="center" valign="top" width="250" >
					<?php echo $reg_obs["integrante"]; ?>
				</td>
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
