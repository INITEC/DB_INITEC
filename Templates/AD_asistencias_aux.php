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
	
	$tarea_actual = "AD_ASISTENCIAS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST["boton-ver-reuniones"])){	
				include_once ("AD_asistencias/tabla_reuniones.php");
			} elseif(isset($_POST['boton-ver-datos-asistencia'])){
                include_once ("AD_asistencias/cuadro_datos_asistencia.php");
            } elseif(isset($_POST['boton-editar-asistencia'])){
                include_once ("AD_asistencias/AD_asistencias_marcar.php");
            } elseif(isset($_POST['boton-ver-cuadro-marcar-asistencia'])){
                include_once ("AD_asistencias/tabla_marcar_asistencia.php");
            } elseif(isset($_POST['boton-actualizar-cuadro-condicion'])){
                include_once ("AD_asistencias/actualizar_cuadro_condicion.php");
            } elseif(isset($_POST['boton-enviar-asistencia'])){
                //include_once ("AD_asistencias/actualizar_cuadro_condicion.php");
                echo "boton-enviar-asistencia";
            } elseif(isset($_POST['boton-cambiar-asistencia'])){
                //include_once ("AD_asistencias/actualizar_cuadro_condicion.php");
                echo "boton-cambiar-asistencia";
            }else {
                echo "Algo ha salido mal";
                //header("Location: AD_asistencias.php");
            }
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if (isset($_GET['estado'])) {
				//include_once ("AD_grupos/cambiar_estado_grupo.php");
			}elseif (isset($_GET['id_persona'])) {
				//include_once ("asistencias/tabla_asistencias_integrante.php");
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