<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
$id_temporada = $_SESSION["temporada"];
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
				$id_grupo = $_POST["id_grupo"];
				$comentario = $_POST["comentario"];
				$n_horas = $_POST["n_horas"];
				$horas_trabajo->registrar_horas_trabajo ($id_integrante,$id_grupo,$comentario,$n_horas);
				header("Location: horas_trabajo.php");
			} elseif(isset($_POST['Validar_horas_trab'])) {
				include_once ("horas_trabajo/validar_horas_trabajo.php");
			} elseif(isset($_POST['boton-cuadro-ingreso-horas'])) {
				include_once ("horas_trabajo/cuadro_ingreso_horas.php");
                //echo "boton-cuadro-ingreso-horas";
			} elseif(isset($_POST['boton-lista-horas-integrante'])) {
				//include_once ("horas_trabajo/lista_horas_integrante.php");
                echo "boton-lista-horas-integrante";
			} elseif(isset($_POST['boton-registrar-horas-trabajo'])) {
				include_once ("horas_trabajo/registrar_horas_trabajo_integrante.php");
                //echo "boton-registrar-horas-trabajo";
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