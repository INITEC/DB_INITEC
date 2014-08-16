<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AD_OBLIGACIONES";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
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
	<body>
		<div id="contenedor_tr">
			<div id="cabecera_tr">
				<?php include_once("../Include/cabecera_tarea.php");?>
			</div>
			<div id="cuerpo_tr">
				<div id="menu_izquierda_tr">
					<?php include_once("../Include/menu_obligaciones.php");?>
				</div>
				<div id="presentacion_tr">
					<div>
						<div id="titulo_tr">
							<h1><?php echo $tarea_actual; ?></h1>						
						</div>
						<br>
					</div>
					<div>
						<div>
							<div id="subtitulo1">
								ASIGNAR TAREA
							</div>
							<div>
								<form action="AD_obligaciones_aux.php" method="POST" name="form_alterar_obligacion" >
									<table>
										<tr id="tabla1_encabezado">
											<td>
												Trabajo
											</td>
											<td>
												Tarea
											</td>
											<td>
											</td>
											<td>
											</td>
										</tr>
										<tr id="tabla1_informacion">
											<td>
												<select name="id_trabajo">
													<?php  												
													$trabajos->ver_trabajos();
															while($op_trabajo = $trabajos->retornar_SELECT()) {
													?>
													<option value="<?php echo $op_trabajo['id_trabajo'];?>"><?php echo $op_trabajo['nom_trabajo']?></option>
													<?php }?>
												</select>
											</td>
											<td>
												<select name="id_tarea">
													<?php  
													$tareas->ver_tareas();
															while($op_tarea = $tareas->retornar_SELECT()) {
													?>
													<option value="<?php echo $op_tarea['id_tarea'];?>"><?php echo $op_tarea['nom_tarea'];?></option>
													<?php }?>
												</select>
											</td>
											<td>
												<input type="submit" name="Asignar_tarea" value="Asignar">
											</td>
											<td>
												<input type="submit" name="Quitar_tarea" value="Quitar">
											</td>
										</tr>
									</table>
								</form>
							</div>
						</div>
						<div>
							<div id="subtitulo1">
								ASIGNAR TRABAJO
							</div>
							<div>
								<form action="AD_obligaciones_aux.php" method="POST" name="form_asignar_trabajo">
									<table>
										<tr id="tabla1_encabezado">
											<td>
												Integrante
											</td>
											<td>
												Trabajo
											</td>
											<td>
											</td>
										</tr>
										<tr id="tabla1_informacion">
											<td>
												<select name="id_integrante">
													<?php
                                                    $integrante_aux = new integrantes();
													$integrante->ver_datos_integrantes();
															while($op_integrante = $integrante->retornar_SELECT()) {
													?>
													<option value="<?php echo $op_integrante['id_persona'];?>"><?php echo $integrante_aux->ver_nombre_completo($op_integrante['id_persona']);?></option>
													<?php }?>
												</select>
											</td>
											<td>
												<select name="id_trabajo">
													<?php  												
													$trabajos->ver_trabajos();
															while($op_trabajo = $trabajos->retornar_SELECT()) {
													?>
													<option value="<?php echo $op_trabajo['id_trabajo'];?>"><?php echo $op_trabajo['nom_trabajo']?></option>
													<?php }?>
												</select>
											</td>
											<td>
												<input type="submit" name="Asignar_trabajo" value="Asignar">
											</td>
										</tr>
									</table>
								</form>
							</div>
						</div>
						<div>
							<div id="subtitulo1">
								ADMINISTRAR TRABAJOS
							</div>
							<div>
								<form action="AD_obligaciones_aux.php" method="POST" name="form_crear_trabajo">
									<table>
										<tr id="tabla1_encabezado">
											<td>
												Nombre del trabajo
											</td>
											<td>
												
											</td>
										</tr>
										<tr id="tabla1_informacion">
											<td>
												<input type="text" name="nom_trabajo">
											</td>
											<td>
												<input type="submit" name="Crear_trabajo" value="Crear">
											</td>
										</tr>
									</table>
								</form>
							</div>
							<div>
								<form action="AD_obligaciones_aux.php" method="POST" name="form_cambiar_nom_trabajo" >
									<table>
										<tr id="tabla1_encabezado">
											<td>
												Trabajo
											</td>
											<td>
												Nuevo Nombre
											</td>
											<td>
											</td>
										</tr>
										<tr id="tabla1_informacion">
											<td>
												<select name="id_trabajo">
													<?php  												
													$trabajos->ver_trabajos();
															while($op_trabajo = $trabajos->retornar_SELECT()) {
													?>
													<option value="<?php echo $op_trabajo['id_trabajo'];?>"><?php echo $op_trabajo['nom_trabajo']?></option>
													<?php }?>
												</select>
											</td>
											<td>
												<input type="text" name="nom_trabajo">
											</td>
											<td>
												<input type="submit" name="Cambiar_nom_trabajo" value="Cambiar">
											</td>
										</tr>
									</table>
								</form>
							</div>
						</div>
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