<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/grupos_class.php");
	
	$tarea_actual = "AD_GRUPOS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$grupo = new grupos();

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST['boton-ver-personas'])){	
				include_once ("AD_integrantes/tabla_personas.php");
			} elseif(isset($_POST["boton-cambiar-estado-persona"])){
                include_once ("AD_integrantes/cambiar_condicion_persona.php");
            } elseif(isset($_POST["boton-ver-cuadro-grupos"])){
                //include_once ("AD_grupos/cuadro_grupos.php");
            } elseif(isset($_POST["boton-cambiar-estado-grupo"])){
                //include_once ("AD_grupos/cambiar_estado_grupo.php");
            } elseif(isset($_POST["boton-cambiar-datos-grupo"])){
                //include_once ("AD_grupos/cuadro_editar_datos_grupo.php");
            } elseif(isset($_POST["boton-guardar-cambios-grupo"])){
                include_once ("AD_grupos/guardar_cambios_grupo.php");
                //echo "boton-guardar-cambios-grupo";
            } else {
                echo "Algo salio mal";
		    }
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if (isset($_GET['estado'])) {
				//include_once ("AD_grupos/cambiar_estado_grupo.php");
			}elseif (isset($_GET['Quitar_integrante'])) {
				//include_once ("AD_grupos/cambiar_estado_integrante.php");
			}else {
                echo "Algo salio mal";
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