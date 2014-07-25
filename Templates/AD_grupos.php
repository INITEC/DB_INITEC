<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/grupos_class.php");
		
	$tarea_actual = "AD_GRUPOS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_integrante);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$trabajos = new trabajos_int();
		$tareas = new tareas_int();
		$grupo = new grupos();
/* ..................................................................................................................... */
?>
<html>
	<head>
	<title>..::<?php echo $tarea_actual; ?>::..</title>
	<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
	<script type="text/javascript" languaje="javascript" src="../JavaScript/from_2_ajax.js"></script>
	<script type="text/javascript" languaje="javascript" src="../JavaScript/callDivs_1_ajax.js"></script>
	<script type="text/javascript" languaje="javascript" src="../JavaScript/EnvForm_ajax.js"></script>
	<script type="text/javascript" languaje="javascript" src="AD_grupos/AD_grupos.js"></script>
	
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
			<div>
				<div id="practica">
				</div>
				<div>
					<table align="center">
						<tr id="tabla1_encabezado">
							<td>
								Grupo
							</td>
							<td>
								<form action="AD_grupos_aux.php" method="POST" name="administrar_grupos">
									<input type="submit" name="administrar_estados" value="Administrar Estados">
								</form>
							</td>
						</tr>
						<tr id="tabla1_informacion">
							<form action="javascript:void(0);" id="form_grupo">
								<input type="hidden" name="select_grupo" value="1">
							<td>
								<select name="id_grupo" id="id_grupo" onchange="eval_select('id_grupo','otro_grupo','id_button')">
									<?php 
									if($grupo->numero_grupos() == 0) {
									?>
									<option value="">Vacio</option>
									<?php
									}  												
									$grupo->ver_grupos();
											while($op_grupo = $grupo->retornar_SELECT()) {
									?>
									<option value="<?php echo $op_grupo['id_grupo'];?>"><?php echo $op_grupo['nom_grupo']?></option>
									<?php }?>
									<option value="otro">Otro</option>
								</select>
							</td>
							</form>
						</tr>
						<tr>
							<form action="AD_grupos_aux.php" method="POST" name="otro_id_grupo">
							<td>
								<input type="hidden" name="otro_grupo" id="otro_grupo">
							</td>
							<td>
								<input type="hidden" id="id_button" name="Crear_Grupo" value="Crear Grupo">
							</td>
							</form>
						</tr>
					</table>
				</div>
				<div id="tabla_integrantes_grupo">
					
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
