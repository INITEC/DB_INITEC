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
	require_once ("../require/horas_trabajo_class.php");
	
	$tarea_actual = "HORAS_TRABAJO";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$grupo = new grupos();
		

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST['Registrar_horas_trab'])){	
                
			} elseif(isset($_POST['Validar_horas_trab'])) {
				include_once ("horas_trabajo/cuadro_validacion_horas_trabajo.php");
			} elseif(isset($_POST['boton-cuadro-ingreso-horas'])) {
				include_once ("horas_trabajo/cuadro_ingreso_horas.php");
			} elseif(isset($_POST['boton-lista-horas-integrante'])) {
				include_once ("horas_trabajo/lista_horas_integrante.php");
			} elseif(isset($_POST['boton-registrar-horas-trabajo'])) {
				include_once ("horas_trabajo/registrar_horas_trabajo_integrante.php");
			} elseif(isset($_POST['boton-ver-horas-trabajo-grupo'])) {
				include_once ("horas_trabajo/tabla_horas_trabajo.php");
			} elseif(isset($_POST['boton-validar-horas-trabajo'])) {
				include_once ("horas_trabajo/validar_horas_trabajo.php");
                //echo "boton-validar-horas-trabajo";
			} elseif(isset($_POST['boton-rechazar-horas-trabajo'])) {
				include_once ("horas_trabajo/rechazar_horas_trabajo.php");
                //echo "boton-rechazar-horas-trabajo";
			} else {
                echo "Algo salio mal";
            } 
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if(isset($_GET['ver_lista_horas_int'])) {
				//include_once ("horas_trabajo/lista_horas_integrante.php");
			} elseif (isset($_GET['select_grupo'])) {
				//include_once ("horas_trabajo/tabla_horas_trabajo.php");
			} elseif (isset($_GET['Validar_horas_trabajo'])) {
				//include_once ("horas_trabajo/registrar_validacion_horas.php");
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