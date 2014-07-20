<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "OBS_INTEGRANTES";	
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
			<div >
<!-- **************************************************************************************** -->
		<?php 
		$sql="select * from integrantes where estado='activo' order by integrante asc";
		$res=mysql_query($sql,$conexion);
		?>
				<table width="700px" align="center" >
					<tr>
						<td valign="top" align="center" width="710" colspan="6" >
							<h1 style="color:#CDE8F3" >Integrantes del INITEC</h1>
						</td>
					</tr>
					<tr class="encabezado_tabla" >
						<td valign="top" align="center" width="200" >
							Integrante
						</td>
						<td valign="top" align="center" width="100" >
							Celular
						</td>
						<td valign="top" align="center" width="300" >
							Gmail
						</td>
						<td valign="top" align="center" width="60" >
							Foto
						</td>
						<td valign="top" align="center" width="25" >
							&nbsp;
						</td>
						<td valign="top" align="center" width="25" >
							&nbsp;
						</td> 
					</tr>
		<?php 
		while ($reg=mysql_fetch_array($res)){
		?>
					<tr class="registros_tabla" >
						<td valign="top" align="center" width="200" >
							<?php 
							echo escribir_integrante($reg["integrante"]);
							?>
						</td>
						<td valign="top" align="center" width="100" >
							<?php 
							echo $reg["celular"];
							?>
						</td>
						<td valign="top" align="center" width="300" >
							<?php 
							echo $reg["gmail"];
							?>
						</td>
						<td valign="top" align="center" width="50" >
							<img src="../foto_integrantes/<?php echo $reg["foto"];?>" width="60" height="48" border="0" >
						</td>
						<td valign="top" align="center" width="25" >
							<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
							onclick="from('<?php echo $reg["id_integrante"]; ?>','ver_mas_<?php echo $reg["id_integrante"]; ?>','observador_integrantes_mostrar.php')">
						</td>
						<td valign="top" align="center" width="25" >
							<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
							onclick="document.getElementById('ver_mas_<?php echo $reg["id_integrante"]; ?>').innerHTML=''">
						</td> 
					</tr>
					<tr>
						<td width="700" colspan="6" >
						<div id="ver_mas_<?php echo $reg["id_integrante"]; ?>" >
						</div>	
						</td>
					</tr>
		<?php 
		}
		?>
				</table>
<!-- **************************************************************************************** -->
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