<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
$id_temporada = $_SESSION["id_temporada"];
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
			if (isset($_POST['cambiar_clave'])){	
				include_once ("home/home_cambiar_clave.php");
			}elseif(isset($_POST['editar_datos'])) {
				include_once ("home/home_editar.php");
			}elseif(isset($_POST['boton-ver-presentacion-integrante'])) {
				include_once ("home/tabla.integrante.presentacion.php");
			}elseif(isset($_POST['cambiar_clave_cambiar'])){
                include_once ("home/home_cambiar_clave_cambiar.php");
            }elseif(isset($_POST["boton-ver-datos-integrante"])){
                include_once ("home/tabla_datos_integrante.php");
            }elseif(isset($_POST["boton-ver-cuadro-editar-integrante"])){
                include_once ("home/tabla_datos_integrante_editar.php");
            }elseif(isset($_POST["boton-guardar-datos-integrante"])){
                include_once ("home/guardar_datos_integrante.php");
            } else {
                echo "Algo salio mal";
            } 
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if (isset($_GET['estado'])) {
				include_once ("AD_grupos/cambiar_estado_grupo.php");
			}elseif (isset($_GET['id_amonestacion'])) {
					include_once ("../Templates/amonestaciones/carta_amonestacion.php");
			}elseif (isset($_GET['id_asistencia'])) {
					include_once ("asistencias/carta_inasistencia.php");
			} else {
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