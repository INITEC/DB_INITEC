<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/grupos_class.php");
	
	$tarea_actual = "HOME";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST['administrar_estados'])){	
				include_once ("AD_grupos/AD_grupos_administrar_estados.php");
			}
			elseif(isset($_POST['Crear_Grupo'])) {
				$nom_grupo = $_POST["otro_grupo"];
				$grupo->nuevo_grupo($nom_grupo);
				header("Location: AD_grupos.php");
			}
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if (isset($_GET['estado'])) {
				include_once ("AD_grupos/cambiar_estado_grupo.php");
			}elseif (isset($_GET['nom_dato'])) {
				if($_GET['nom_dato'] == 'id_persona') {
					include_once ("home/tabla_datos_integrante.php");
				}
			}elseif (isset($_GET['select_grupo'])) {
					include_once ("AD_grupos/tabla_integrantes_grupo.php");
			}elseif (isset($_GET['Agregar_integrante'])) {
					include_once ("AD_grupos/cambiar_estado_integrante.php");
			}elseif (isset($_GET['Quitar_integrante'])) {
					include_once ("AD_grupos/cambiar_estado_integrante.php");
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