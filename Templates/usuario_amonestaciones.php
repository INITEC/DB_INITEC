<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AMONESTACIONES";	
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
	<table align="center" width="450px" >
		<tr class="encabezado_tabla" >
			<td align="center" valign="top" width="150" >
				Fecha Emision
			</td>
			<td align="center" valign="top" width="150" >
				Fecha Falta
			</td>
			<td align="center" valign="top" width="100" >
				Tipo
			</td>
			<td valign="top" align="center" width="25" >
				&nbsp;
			</td>
			<td valign="top" align="center" width="25" >
				&nbsp;
			</td> 
		</tr>
<?php 
require_once ("conexion1.php");
$sql= "select * from amonestaciones where receptor=".$_SESSION["id_integrante"]." 
			order by id_amonestacion desc";
$res=mysql_query($sql,$conexion);
while ($asist=mysql_fetch_array($res)){
?>
		<tr class="registros_tabla" >
			<td align="center" valign="top" width="150" >
				<?php echo $asist["fecha_emision"]; ?>
			</td>
			<td align="center" valign="top" width="150" >
				<?php echo $asist["fecha_falta"]; ?>
			</td>
			<td align="center" valign="top" width="100" >
				<?php echo $asist["tipo"]; ?>
			</td>
			<td valign="top" align="center" width="25" >
				<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
				onclick="from('<?php echo $asist["id_amonestacion"]; ?>','ver_mas_<?php echo $asist["id_amonestacion"]; ?>','usuario_amonestaciones_notificacion.php')">
			</td>
			<td valign="top" align="center" width="25" >
				<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
				onclick="document.getElementById('ver_mas_<?php echo $asist["id_amonestacion"]; ?>').innerHTML=''">
			</td>
		</tr>
		<tr>
			<td width="600" colspan="6" >
			<div id="ver_mas_<?php echo $asist["id_amonestacion"]; ?>" >
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