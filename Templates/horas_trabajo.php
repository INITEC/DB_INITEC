<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/grupos_class.php");
	
	$tarea_actual = "HORAS_TRABAJO";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_integrante);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$grupo = new grupos();
/* ..................................................................................................................... */
?>
<html>
	<head>
	<title>..::<?php echo $tarea_actual; ?>::..</title>
	<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
	<script type="text/javascript" languaje="javascript" src="../JavaScript/EnvForm_ajax.js"></script>
	<script type="text/javascript" languaje="javascript" src="horas_trabajo/horas_trabajo.js"></script>
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
			<div id="subtitulo1">
				<form id="validacion_horas" action="horas_trabajo_aux.php" method="POST">
					<input type="submit" name="Validar_horas_trab" value="VALIDAR HORAS DE TRABAJO">
				</form>
			</div>
			<div>
				<table align="center">
					<tr id="Tabla1_encabezado">
						<td>
							INGRESE EL NUMERO DE HORAS
						</td>
						<td>
							ELIJA SU GRUPO
						</td>
						<td>
							COMENTARIO (140 caract.)
						</td>
						<td>
						</td>
					</tr>
					<tr id="tabla1_informacion">
						<form action="horas_trabajo_aux.php" method="POST" id="form_registro" >
						<td>
							<input type="text" name="n_horas" value="0">
						</td>
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
								</select>
						</td>
						<td>
							<textarea name="comentario" cols="40"></textarea>
						</td>
						<td>
							<input type="submit" name="Registrar_horas_trab" value="Registrar">
						</td>
						</form>
					</tr>
				</table>
			</div>
			<form id="vacio" action="javascript:void(0);">
				<input type="hidden" name="ver_lista_horas_int" value="1">
			</form>
			<div id="lista_horas_integrante">
				
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
