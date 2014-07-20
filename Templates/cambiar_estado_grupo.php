<?php
session_start();
echo "entro";

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
		$grupo = new grupos();
		if( !empty($_GET)) {	
			if($_GET['estado'] == 0) {
				$id_grupo = $_GET["id"];
				if($grupo->desactivar_grupo($id_grupo)){
					?>
					<div id="dato_correcto">
						EL GRUPO A SIDO DESACTIVADO
					</div>
					<?php
				}else {
					?>
					<div id="dato_incorrecto">
						NO SE HA PODIDO DESACTIVAR AL GRUPO
					</div>
					<?php
				}
			}elseif($_GET['estado']== 1) {
				$id_grupo = $_GET["id"];
				if($grupo->activar_grupo($id_grupo)){
					?>
					<div id="dato_correcto">
						EL GRUPO A SIDO ACTIVADO
					</div>
					<?php
				}else {
					?>
					<div id="dato_incorrecto">
						NO SE HA PODIDO ACTIVAR AL GRUPO
					</div>
					<?php
				}
			}
		}else {
			echo "No se han recibido los datos";
		}	

	}
	else {
			echo "La tarea no le corresponde";
			}	
}
else {
		echo "Uste no tiene permisos, inicie sesion.";
		}
?>