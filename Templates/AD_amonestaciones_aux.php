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
	
	$tarea_actual = "AD_AMONESTACIONES";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST["boton-ver-cuadro-amonestacion"])){	
				include_once ("AD_amonestaciones/cuadro_amonestacion.php");
			} elseif(isset($_POST['boton-ver-lista-busqueda-nombre'])){
                include_once ("AD_amonestaciones/lista_busqueda_integrantes.php");
            } elseif(isset($_POST['boton-guardar-amonestaciones'])){
                include_once ("AD_amonestaciones/guardar.amonestaciones.php");
            } else {
                echo "Algo ha salido mal";
                //header("Location: AD_asistencias.php");
            }
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if (isset($_GET['++'])) {
				//include_once ("");
			}elseif (isset($_GET['+++'])) {
				//include_once ("");
			} else {
                echo "Algo ha salido mal";
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