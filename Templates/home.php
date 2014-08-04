<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "HOME";	
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
<script type="text/javascript" languaje="javascript" src="../JavaScript/from_2_ajax.js"></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/callDivs_1_ajax.js"></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/callDivs_dato_ajax.js"></script>

<script type='text/javascript' languaje='javascript'>
window.onload = function(){
	callDivs_dato ('cuadro', 'home_aux.php', '<?php echo $id_persona; ?>', 'id_persona');
}
</script>

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
			<div >
<!-- *************************************************************************************************** -->
				<div>
					<table width="700px" align="center">
						<tr>
							<td width="350px" align="left" >
								<input type="button" title="Cambiar Clave de usuario" value="..::Cambiar Clave::.." onClick="window.location='home_contrasena.php'">
							</td>
							<td width="350px" align="right" >
								<input type="button" title="Editar Datos" value="..::Editar Datos::.." onClick="window.location='home_editar.php'">
							</td>
						</tr>
					</table> 
				</div>
				<!-- Este div usa AJAX para mostrar informacion -->
				<div id="cuadro">
				</div>

				
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
	} else {
        include_once ("../Include/no_tarea.php");
    }	
} else {
    include_once ("../Include/no_acceso.php");
}

?>