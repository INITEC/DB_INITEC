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
	
	$tarea_actual = "AD_DEUDAS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST["boton-cuadro-crear-deuda"])){	
				include_once ("AD_deudas/cuadro_crear_deuda.php");
                //echo "boton-cuadro-crear-deuda";
			}elseif(isset($_POST['boton-cuadro-ver-deudas'])) {
				//include_once ("AD_deudas/cuadro_ver_deudas.php");
                echo "boton-cuadro-ver-deudas";
			}elseif(isset($_POST['boton_crear_nueva_deuda'])){
                include_once ("AD_deudas/crear_nueva_deuda.php");
                //echo "boton_crear_nueva_deuda";
            }elseif(isset($_POST['boton-editar-reunion'])){
                //include_once ("AD_reuniones/cuadro_editar_reunion.php");
            }elseif(isset($_POST['boton-guardar-cambios-reunion'])){
                include_once ("AD_reuniones/guardar_cambios_reunion.php");
                //echo "guardar_cambios_reunion";
            } else {
                echo "Algo ha salido mal";
                //header("Location: AD_reuniones.php");
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