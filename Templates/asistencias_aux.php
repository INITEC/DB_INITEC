<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
//$id_temporada = $_SESSION["id_temporada"];
$id_temporada = 7;

if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/grupos_class.php");
	
	$tarea_actual = "ASISTENCIAS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST['cambiar_clave'])){	
				include_once ("home/home_cambiar_clave.php");
			}elseif(isset($_POST['editar_datos'])) {
				include_once ("home/home_editar.php");
			}
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if (isset($_GET['estado'])) {
				include_once ("AD_grupos/cambiar_estado_grupo.php");
			}elseif (isset($_GET['id_persona'])) {
				include_once ("asistencias/tabla_asistencias_integrante.php");
			}
		}
		else {
			include_once ("../Include/no_dato_POST.php");
		}		
			
	}
	else {
			include_once ("../Include/no_tarea.php");
			}	
}
else {
		include_once ("../Include/no_acceso.php");
		}
?>