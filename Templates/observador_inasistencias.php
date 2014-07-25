<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "OBS_INASISTENCIAS";	
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
				<table width="900px" align="center" >
					<tr>
						<td valign="top" align="center" width="700" colspan="6" >
							<h1 style="color:#CDE8F3" >Integrantes del INITEC</h1>
						</td>
					</tr>
					<tr class="encabezado_tabla" >
						<td valign="top" align="center" width="80" >
							Foto
						</td>
						<td valign="top" align="center" width="250" >
							Integrante
						</td>
						<td valign="top" align="center" width="400" >
							Estado
						</td>
					</tr>
		<?php 
		while ($reg=mysql_fetch_array($res)){
				$faltas="select count(*) as cuantos from asistencias,reuniones where  asistencias.id_fecha=reuniones.id_fecha 
				AND asistencias.id_integrante='".$reg["id_integrante"]."' AND reuniones.id_temporada='".$_SESSION["temporada"]."' 
				AND asistencias.asistencia='No Asistio' ";
				$res_faltas=mysql_query($faltas,$conexion);
				$reg_faltas=mysql_fetch_array($res_faltas);
				$faltas_total=$reg_faltas["cuantos"];
				if($faltas_total > 6){$faltas_total = 6;}
				$id_integrante = $reg["id_integrante"];
			?>
					<tr class="registros_tabla" >
						<td valign="top" align="center" width="50" >
							<img src="../foto_integrantes/<?php echo $reg["foto"];?>" width="80" height="60" border="0" >
						</td>
						<td valign="top" align="center" width="250" >
							<?php 
							echo $reg["integrante"];
							?>
						</td>
						<td valign="top" align="center" width="400" >
							
								<div>
									<?php 
									$amon="select count(*) as cuantos from amonestaciones where receptor='".$id_integrante."' AND tipo='leve' AND id_temporada='".$_SESSION["temporada"]."' ";
									$res_amon=mysql_query($amon,$conexion);
									$reg_amon=mysql_fetch_array($res_amon);
									$amon_leves=$reg_amon["cuantos"];
									$amon="select count(*) as cuantos from amonestaciones where receptor='".$id_integrante."' AND tipo='grave' AND id_temporada='".$_SESSION["temporada"]."' ";
									$res_amon=mysql_query($amon,$conexion);
									$reg_amon=mysql_fetch_array($res_amon);
									$amon_graves=$reg_amon["cuantos"];
									$amon_total=$amon_leves + ($amon_graves * 2);
									if($amon_total > 6){$amon_total = 6;}
									?>
									<img src="../Imagenes/barra_<?php echo $amon_total;?>.png" width="400" height="15">
									<br>
									Usted tiene <?php echo $amon_leves;?> falta(s) leve(s) y <?php echo $amon_graves;?> falta(s) grave(s)	
									
								</div>
								<div>
	
									<?php 
									$faltas="select count(*) as cuantos from asistencias,reuniones where  asistencias.id_fecha=reuniones.id_fecha AND asistencias.id_integrante='".$id_integrante."' AND reuniones.id_temporada='".$_SESSION["temporada"]."' AND asistencias.asistencia='No Asistio' ";
									$res_faltas=mysql_query($faltas,$conexion);
									$reg_faltas=mysql_fetch_array($res_faltas);
									$faltas_total=$reg_faltas["cuantos"];
									if($faltas_total > 8){$faltas_total = 8;}
									?>
									<img src="../Imagenes/barra_<?php echo $faltas_total;?>.png" width="400" height="15" >
									<br>
									Usted tiene <?php echo $faltas_total;?> inasistencia(s)	
						
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
